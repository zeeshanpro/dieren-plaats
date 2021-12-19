<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\KindInterface;
use App\Http\Requests\KindRequest;
use App\Models\Kind;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;

class KindRepository implements KindInterface
{
    public function listKinds(){
        $data['result'] = Kind::where('status', '=', 1)
                                ->with('kindAdAttributes')
                                ->withCount(['kindBreederKinds','kindExpectedBabies','kindAds'])
                                ->paginate(REC_PER_PAGE);
        $data['code'] = 200;
        return $data;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output = "";
            $data['result'] = Kind::where('status', '=', 1)
                                            ->where('title', 'like', '%'.$query.'%')
                                            ->withCount(['kindBreederKinds','kindExpectedBabies', 'kindAds'])
                                            ->paginate(REC_PER_PAGE);
            
            $data['code'] = 200; 
            return $data;
        }
    }

    // public function uploadImage( Request $req, $fileKey, $pathAfterPublicWithoutSlashes, $existingImageIfAny = '' ){
    //     if( $fileKey != '' ){
    //         $fileName = time().'_'.$req->file( $fileKey )->getClientOriginalName();
    //         $dir = storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb');
    //         if( ! \File::isDirectory($dir) ) 
    //         {
    //             \File::makeDirectory($dir, 493, true);
    //         }
    //         $filePath = $req->file( $fileKey )->storeAs( $pathAfterPublicWithoutSlashes , $fileName, 'public');
    //         sleep(2);
    //         $img = Image::make($req->file( $fileKey )->getRealPath())->resize(300, null, function ($constraint) {
    //             $constraint->aspectRatio();
    //             })->save(storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'.$fileName));
            
    //         if( $existingImageIfAny != '' ){
    //             @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/'. $existingImageIfAny );
    //             @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'. $existingImageIfAny );
    //         }
    //         return $fileName;
    //     } else {
    //         return 0;
    //     }
    // }

    public function update_Kind( Request $req ){
        $validator = Validator::make($req->all(), 
                [ 
                    'kindid' => 'required', 
                    'title' => 'required',
                    'kindImage' => 'sometimes|required|mimes:jpeg,jpg,png|max:5200',
                    'kindIconImage' => 'sometimes|required|mimes:jpeg,jpg,png|max:5200'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }
        
        if( Kind::find($req->kindid)->exists() ) {
            if($req->file()) {
                $updateArray = array();   
                $updateArray[] = [ 'title' => ucwords($req->title) ] ;

                $titleSlug = Str::slug($req->title);
                $kindObj = Kind::where( 'title_slug', '=', $titleSlug )->where( 'id', '!=', $req->kindid );
                if( $kindObj->count() > 0 ){
                    $counter = 1;
                    do {  
                        $testSlug = $titleSlug . '-'.$counter;
                        $kindObj = Kind::where( 'title_slug', '=', $testSlug );
                    } while( $kindObj->count() > 0 );
                    $titleSlug = $testSlug;
                }

                $kindRecord = Kind::find($req->kindid);
                $kindRecord->title = ucwords($req->title);
                $kindRecord->title_slug = $titleSlug;
                if( $req->hasFile('kindImage') ) { 
                    $fileName = uploadImage( $req, 'kindImage', 'uploads/kind', $kindRecord->image );
                    $kindRecord->image = $fileName;
                }
                
                if( $req->hasFile('kindIconImage') ) { 
                    $fileName = uploadImage( $req, 'kindIconImage', 'uploads/kindicon', $kindRecord->icon );
                    $kindRecord->icon = $fileName;
                }
                $kindRecord->update();
            } else {
                Kind::find($req->kindid)
                            ->update([ 'title' => ucwords($req->title) ]);
            }
            
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'This kind does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Kind Saved Successfully';
        return $data;
    } 

    public function delete_Kind( Request $req ){
        $validator = Validator::make($req->all(), 
                [ 
                    'kindid' => 'required'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }
        
        if( Kind::where('id', '=', $req->kindid)->exists() ) {
            Kind::where('id', '=', $req->kindid)
                            ->update([ 'status' => 0 ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'This Kind does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Kind Removed Successfully';
        return $data;
    } 

    public function createKind( Request $request ){
        
        $validator = Validator::make($request->all(), 
                [ 
                    'title' => 'required|unique:kinds',
                    'status' => '',
                    'kindImage' => 'required|mimes:jpeg,jpg,png|max:5200',
                    'kindIconImage' => 'required|mimes:jpeg,jpg,png|max:5200'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors()->first();;
            return $data;
        }
        

        DB::beginTransaction();   
        try {
                if($request->file()) {
                    $fileName = time().'_'.$request->file('kindImage')->getClientOriginalName();
                    $dir = storage_path('app/public/uploads/kind/thumb');
                    if( ! \File::isDirectory($dir) ) 
                    {
                        \File::makeDirectory($dir, 493, true);
                    }
                    $filePath = $request->file('kindImage')->storeAs('uploads/kind', $fileName, 'public');
                    sleep(2);
                    $img = Image::make($request->file('kindImage')->getRealPath())->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                        })->save(storage_path('app/public/uploads/kind/thumb/'.$fileName));
                    

                    $kindIconImageName = time().'_'.$request->file('kindIconImage')->getClientOriginalName();
                    $dir = storage_path('app/public/uploads/kindicon/thumb');
                    if( ! \File::isDirectory($dir) ) 
                    {
                        \File::makeDirectory($dir, 493, true);
                    }
                    $filePath = $request->file('kindIconImage')->storeAs('uploads/kindicon', $fileName, 'public');
                    sleep(2);
                    $img = Image::make($request->file('kindIconImage')->getRealPath())->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                        })->save(storage_path('app/public/uploads/kindicon/thumb/'.$fileName));
                    
                    $titleSlug = Str::slug($request->title);
                    $kindObj = Kind::where( 'title_slug', '=', $titleSlug );
                    if( $kindObj->count() > 0 ){
                        $counter = 1;
                        do {  
                            $testSlug = $titleSlug . '-'.$counter;
                            $kindObj = Kind::where( 'title_slug', '=', $testSlug );
                        } while( $kindObj->count() > 0 );
                        $titleSlug = $testSlug;
                    }    

                    $newKind = new Kind;
                    $newKind->title = $request->title;
                    $newKind->title_slug = $titleSlug;
                    $newKind->status = 1;
                    $newKind->image = $fileName;
                    $newKind->icon = $kindIconImageName;
                    $newKind->save();
                    DB::commit();
                    $data['code'] = 201;
                    $data['insertId'] = $newKind->id;
                    $data['error'] = false;
                    $data['msg'] = 'Kind Saved Successfully';
                    return $data;
                } else {
                    $data['code'] = 422;
                    $data['error'] = true;
                    $data['msg'] = 'File upload or multi-part is missing';
                    return $data;
                }

        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 201;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
            //$this->error($e->getMessage(), $e->getCode());
        }
    } 
}
