<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\UserInterface;
use App\Http\Requests\Front\UserRequest;
use App\Models\User;
use App\Models\Ad;
use App\Models\Race;
use App\Models\Renewal;
use Illuminate\Support\Facades\Validator;
use App\Models\Breeder;
use App\Models\BreederKind;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserRepository implements UserInterface
{
    public function ifUserIsAllowedToCreateAds(){
        $result = array();
        $userId = Auth::id();
        $userRec = User::find( $userId );
        if( $userRec->usertype == 'Normal' ){

            $ads = Ad::where('user_id', '=', $userId)
                        ->where( 'status', '=', 1 )
                        ->where( 'expires_on' , '>=' , date('Y-m-d') )
                        ->get()->count();
            
            if( $ads < 3 ){
                $result['code'] = 200;
                $result['OkToProceed'] = true;
                $result['msg'] = 'You may please proceed with creating the Ad';
            } else {
                $result['code'] = 422;
                $result['OkToProceed'] = false;
                $result['msg'] = 'Sorry!! You already have 3 active Ads.';
            }         
        } else if( $userRec->usertype == 'Shelter' or $userRec->usertype == 'Breeder' ){
            $renewalRec = Renewal::where( 'user_id', '=', $userId )
                        ->where( 'renewal_date', '>=', date('Y-m-d') )->first();
            if( $renewalRec ){
                $result['code'] = 200;
                $result['OkToProceed'] = true;
                $result['msg'] = 'You may please proceed with creating the Ad';
            } else {
                $result['code'] = 422;
                $result['OkToProceed'] = false;
                $result['msg'] = 'Sorry!! Please proceed to become a paid subscriber.';
            }
        }

        return $result;
    }

    public function getBreeders( $limit = 4 ){
        $data['result'] = User::select('name', 'id')
                                ->where('usertype' , '=' , 'Breeder')
                                ->withCount(['userAds','userExpectedBabies'])
                                ->with(['Breeder', 'Breeder.breederKinds.breeder_kindKind'])
                                ->limit( $limit )->get();
        $data['code'] =  200;
        return $data;
    }

    public function getBreedersBySearchAndPaginate(Request $request){
        $kindId = $request->kind;
        
        if( isset( $request->rating ) and is_numeric( $request->rating ) )
            $rating = $request->rating;
        else 
            $rating = 0 ;

        $sql = User::select('name', 'id');
        if( $kindId != '' and is_numeric( $kindId ) and $kindId > 0 ){
            $sql = $sql->whereHas( 'Breeder.breederKinds' , function( $query ) use( $kindId ) 
                        {
                            $query->where( 'kind_id', '=', $kindId ); 
                        } );
        }

        if( $rating > 0 ){
            $sql = $sql->whereHas( 'Breeder.breederReviews', function( $query ) use( $rating ) {
                    if( $rating > 0  and $rating <= 5 ){
                        $query->groupBy( 'breeder_id' );
                        $query->havingRaw('AVG(rating) >= ? and AVG(rating) <= ? ', [ ($rating - 0.49) , ( $rating + 0.5 ) ] );
                    }
                } );  
        }
        $data['result'] = $sql->where('usertype' , '=' , 'Breeder')
        ->withCount( ['userAds','userExpectedBabies'] )
        ->with( ['Breeder', 'Breeder.breederKinds.breeder_kindKind', 'Breeder.breederKinds.breeder_kindRace', 'Breeder.avgRating' ] )
        ->paginate( REC_PER_PAGE );

        //dd($data['result']);

        $data['code'] =  200;
        return $data;
    }

    public function searchUsers(Request $request)
    {
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = User::where('name', 'like', '%'.$query.'%')
                ->where('usertype' , '!=' , 'Admin')
                ->withCount(['userAds','userExpectedBabies'])
                ->with('Breeder')
                ->paginate(REC_PER_PAGE);

            $data['code'] = 200; 
            return $data;
        }
    }

    public function viewUser( $userId ){
        $data = array();
        if( $userId != '' and is_numeric( $userId ) ) {
            $data['data'] = User::select('id','name','email','usertype','created_at','status')->where('id', '=', $userId )  
                                ->with(['userAds','Breeder','userBreederReviews','userExpectedBabies'])
                                ->first();
        
            $data['code'] = 200;
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors()->first();
        }
        
        
        return $data;
    }

    public function createUser( UserRequest $request ){
        
        DB::beginTransaction();   
        try {
                $emailOTP = rand(1,9).rand(0,9).rand(0,9).rand(0,9); 
                $newUser = new User;
                $newUser->name = $request->name;
                $newUser->email = $request->email;
                $newUser->password = bcrypt($request->password);
                $newUser->usertype = $request->usertype;
                $newUser->email_otp = $emailOTP;
                //todo update the code below to supply the stripe product id here instead.
                if( $request->usertype == 'Shelter' )
                    $newUser->stripe_product_id = STRIPE_SHELTER_PLAN;
                else if( $request->usertype == 'Breeder')
                    $newUser->stripe_product_id = STRIPE_BREEDER_PLAN;
                else
                    $newUser->stripe_product_id = '';

                $newUser->save();
                
                    $newBreeder = new Breeder;
                    $newBreeder->owner_name = $request->name;
                    $newBreeder->company_name = $request->name;
                    $newBreeder->user_id = $newUser->id;
                    if( $request->usertype == 'Shelter' or $request->usertype == 'Breeder' ){
                        $newBreeder->street = $request->street;
                        $newBreeder->city = $request->city;
                        $newBreeder->postal_code = $request->postal_code;
                        $newBreeder->country = $request->country;
                    }
                    $newBreeder->save();

                // based on user type send welcome email
                switch( $newUser->usertype ){
                    case 'Normal':
                        $arrayToSend = array('email'=>$newUser->email,'FORGETLINK' => $newUser->email_otp,'name' => $newUser->name);
                        Mail::send( 'mailtemplates.welcome_normal' , $arrayToSend, function( $message ) use( $newUser ) {
                            $message->to( $newUser->email );
                            $message->subject( 'Welkom bij Dieren-plaats Door baasjes , voor baasjes' );

                        } );
                        break;

                    case 'Shelter':
                        $arrayToSend = array('email'=>$newUser->email,'FORGETLINK' => $newUser->email_otp,'name' => $newUser->name);
                        Mail::send( 'mailtemplates.welcome_shelter' , $arrayToSend, function( $message ) use( $newUser ) {
                            $message->to( $newUser->email );
                            $message->subject( 'Welkom bij Dieren-plaats Door baasjes , voor baasjes' );

                        } );
                        break; 

                    case 'Breeder':
                        $arrayToSend = array('email'=>$newUser->email,'FORGETLINK' => $newUser->email_otp,'name' => $newUser->name);
                        Mail::send( 'mailtemplates.welcome_breeder' , $arrayToSend, function( $message ) use( $newUser ) {
                            $message->to( $newUser->email );
                            $message->subject( 'Welkom bij Remora services Door baasjes , voor baasjes' );

                        } );
                        break;        
                }

                // send mail script here
                $arrayToSend = array('email'=>$newUser->email,'otp' => $newUser->email_otp,'name' => $newUser->name);
                Mail::send( 'mailtemplates.registerOTPMail' , $arrayToSend, function( $message ) use( $newUser ) {
                    $message->to( $newUser->email );
                    $message->subject(  config("app.name") . ': OTP Verification '.$newUser->email_otp );

                } );
                // send mail script ends

                DB::commit();
                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'User created successful';
                return $data;

        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }
    } 

    public function loginUserManual( Request $request ){
        $data = array();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->email)
                    ->where(function ($query) {
                        $query->where('usertype', 'Normal')
                            ->orWhere('usertype', 'Shelter')
                            ->orWhere('usertype', 'Breeder');
                    })->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    if( $user->email_verified_at == null ){
                        $data['emailverified'] = false;
                        $data['msg'] = 'Login successful but please verify email by entering OTP';
                    } else {
                        $data['emailverified'] = true;
                        $data['msg'] = 'Login successful';
                    }
                    $data['code'] = 201;
                    return $data;
                    //return redirect()->intended('dashboard')
                                //->withSuccess('Signed in');
                }
            } else {
                $data['code'] = 422;
                $data['msg'] = 'Password mismatch';
                return $data;
                //return response($response, 422);
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'User with this email does not exists in the system';
            return $data;
        }
    }

    public function updateUser(Request $request) {
        $hasError = false;
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'email' => 'required',
                    'kind' => 'sometimes|numeric'
                ]); 

        $validator->after(function ($validator) use( $request ) {
            if( $request->kind != '' and $request->race != '' ){
                if( is_numeric($request->kind) and is_numeric( $request->race ) and $request->kind > 0 and $request->race > 0  ){
                    $raceCount = Race::where( 'kind_id', '=', $request->kind )
                                ->where( 'id' , '=' , $request->race )->where('status', '=', 1)->count();
                    if( $raceCount < 1 ){
                        $validator->errors()->add('race', 'Please check the selected options and try again.');
                        $hasError = true;
                    }
                } else {
                    $validator->errors()->add('race', 'Please check the selected options and try again.');
                    $hasError = true;
                }
            }
        });  

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }

            $validator->validate();
        }

        DB::beginTransaction();   
        try {
                $isClean = true;
                $userId = Auth::id();
                $userRec = User::find( $userId );
                $userRec->email = $request->email;
                if( $request->status == 1 ){
                    $userRec->status = 1;
                } else {
                    $userRec->status = 0;
                }
                
                if( $userRec->isDirty() )
                {
                    $userRec->save();
                    $isClean = false;
                }
                
                $breederRec = Breeder::where('user_id', '=', $userId )->first();
                if( $breederRec != null ){
                    $breederRec->company_name = $request->company_name;
                    $breederRec->owner_name = $request->owner_name;
                    $breederRec->company_about = $request->company_about;
                    $breederRec->street = $request->street;
                    $breederRec->city = $request->city;
                    $breederRec->country = $request->country;
                    $breederRec->website = $request->website;
                    //missing
                    $breederRec->phone = $request->phone; 
                    $breederRec->fb_url = $request->fb_url;
                    $breederRec->insta_url = $request->insta_url;
                    $breederRec->linkedin_url = $request->linkedin_url;

                    if($request->file()) {
                        if( $request->hasFile('companylogo') ) { 
                            $fileName = uploadImage( $request, 'companylogo', 'uploads/users', $breederRec->logo );
                            $breederRec->logo = $fileName;
                        }
                    }

                    if( $breederRec->isDirty() )
                    {
                        $breederRec->save();
                        $isClean = false;
                    }
                }

                $breederKindRec = BreederKind::where('breeder_id', '=', $breederRec->id )->first();
                if( $breederKindRec ){
                    $breederKindRec->kind_id = $request->kind;
                    $breederKindRec->race_id = $request->race;
                    if( $breederKindRec->isDirty() )
                    {
                        $breederKindRec->save();
                        $isClean = false;
                    }
                } else {
                    $breederKindRec = new BreederKind;
                    $breederKindRec->kind_id = $request->kind;
                    $breederKindRec->race_id = $request->race;
                    $breederKindRec->breeder_id = $breederRec->id;
                    $breederKindRec->save();
                    $isClean = false;
                }

                DB::commit();

                if( $isClean == true ){
                    $data['code'] = 304;
                    $data['error'] = false;
                    $data['msg'] = 'Data Not Changed';
                    return $data;
                }

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Profile information update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }

    public function validateEmailVerification( Request $request ){
        $data = array();
        $request->validate([
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric'
        ]);
        $userRec = User::where('email', '=', $request->email )->first();
        if( $userRec ) {
            if( $userRec->email_verified_at == null ){
                if( $userRec->email_otp == ($request->otp1.$request->otp2.$request->otp3.$request->otp4) ){
                    // login user on success because we are proceeding for the payment processing next.
                    Auth::login($userRec, true);
                    $userRec->email_verified_at = date('Y-m-d H:i:s');
                    $userRec->update();
                    $data['code'] = 201;
                    $data['msg'] = 'Email verified';
                    return $data;
                } else {
                    $data['code'] = 422;
                    $data['msg'] = 'OTP mismatch';
                    return $data;
                }
            } else {
                $data['code'] = 201;
                $data['msg'] = 'Email already verified';
                return $data;    
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'Unable to verify. Please try later.';
            return $data;
        }
    }

    public function saveforlater( Request $request ){} 

    public function update_logindetails( Request $request ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'currentpass' => 'required',
                    'newpass' => 'required|confirmed|min:6|max:15'
                ]); 

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }

            $validator->validate();
        }
        DB::beginTransaction();   
        try {
                $isClean = true;
                $userId = Auth::id();
                $userRec = User::find( $userId );
                if (Hash::check($request->currentpass, $userRec->password)){
                    $userRec->password = bcrypt( $request->newpass );
                    $userRec->save();
                    $data['code'] = 201;
                    $data['error'] = false;
                    $data['msg'] = 'Login details update successful';
                } else {
                    $data['code'] = 422;
                    $data['error'] = true;
                    $data['msg'] = 'Please check details again and try.';
                }   
               
                DB::commit();
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }

    //for Google and facebook users lets create function to update the details
    public function completeRegistration(Request $request) {
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'usertype' => 'required'
                ]); 
        

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }
            //$validator->validate();
            
        } else {
            $hasError = false;
            if( $request->usertype == 'Breeder' or $request->usertype == 'Shelter' or $request->usertype == 'Normal' ){
                // its fine
            } else {
                $validator->errors()->add('usertype', 'Please select a valid user type.');
                $hasError = true;
            }

            if( $request->usertype == 'Breeder' or $request->usertype == 'Shelter' ){
                if( $request->street == '' ){
                    $validator->errors()->add('street', 'Please provide street.');
                    $hasError = true;
                }
                if( $request->city == '' ){
                    $validator->errors()->add('city', 'Please enter city.');
                    $hasError = true;
                }
                if( $request->postal_code == '' ){
                    $validator->errors()->add('postal_code', 'Please provide postal code.');
                    $hasError = true;
                }
            }

            if( $request->terms == 'agree' ){
                $validator->errors()->add('terms', 'Please tick the box to agree before proceeding.');
                $hasError = true;
            }

            if( $hasError == true ){
                $data['code'] = 423;
                $data['error'] = true;
                $data['validator'] = $validator;
                $data['msg'] = 'Encountered error while processing request';
                return $data;
            }
        }

        DB::beginTransaction();   
        try {
                $isClean = true;
                $userId = Auth::id();
                $userRec = User::find( $userId );
                $userRec->name = $request->name;
                if( $userRec->usertype != 'Breeder' and $userRec->usertype != 'Shelter' and $userRec->usertype != 'Normal' ) {
                    $userRec->usertype = $request->usertype;
                }
                
                if( $userRec->isDirty() )
                {
                    $userRec->save();
                    $isClean = false;
                }
                
                $breederRec = Breeder::where('user_id', '=', $userId )->first();
                if( $breederRec != null ){
                    $breederRec->owner_name = $request->name;
                    $breederRec->street = $request->street;
                    $breederRec->city = $request->city;
                    $breederRec->country = $request->country;
                    if( $breederRec->isDirty() )
                    {
                        $breederRec->save();
                        $isClean = false;
                    }
                } else {
                    $breederRec = new Breeder;
                    $breederRec->owner_name = $request->name;
                    $breederRec->street = $request->street;
                    $breederRec->city = $request->city;
                    $breederRec->country = $request->country;
                    $breederRec->user_id = $userId;
                    $breederRec->save();
                    $isClean = false;
                }

                DB::commit();

                if( $isClean == true ){
                    $data['code'] = 304;
                    $data['error'] = false;
                    $data['msg'] = 'Data Not Changed';
                    return $data;
                }

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Profile information update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }

    public function getAllSubscriptions(){
        $data['result'] = Renewal::where( 'user_id', '=', Auth::id() )
                                    ->with('paymentDetails')
                                    ->orderByDesc('date_of_transaction','DESC')
                                    ->get();
        $data['code'] =  200;
        
        return $data;
    }

}
