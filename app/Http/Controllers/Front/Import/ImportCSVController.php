<?php

namespace App\Http\Controllers\Front\Import;

use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdAttribute;
use App\Models\Race;
use App\Models\User;
use App\Models\Kind;
use App\Models\Breeder;
use App\Models\Ad;
use App\Models\AdImage;
use App\Models\AdSelectedAttribute;
use App\Models\AdAttributeOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Mail;

class ImportCSVController extends Controller
{
    public function testScript(){
        $ads = Ad::whereNull( 'expires_on')->get();
        foreach( $ads as $ad ){
            $adRec = Ad::find( $ad->id );
            $dateofcreation = date('Y-m-d', strtotime($adRec->created_at) );
            $dateofexpiry = date('Y-m-d', strtotime("+6 months", strtotime( $dateofcreation ) ) );
            $adRec->expires_on = $dateofexpiry;
            $adRec->save();
            echo ''.$dateofcreation.' - '.$dateofexpiry .' <br />' ;
        }
    }

    public function processImages(){
        //$dr = File::allFiles( storage_path('app/public/uploads/ads') );
        $dir = storage_path('app/public/uploads/ads/thumb/');
        $ads = AdImage::with('ad_imageAd')->skip(199)->take(90)->orderBy('id', 'ASC')->get(); //skip(5)-> before take 
        $counter = 1;
        foreach( $ads as $ad ){
            echo '===================================<br />';
            echo 'Processing '.$dir.$ad->filename.'<br />'; 
            if( file_exists( $dir.$ad->filename ) ){
                $image = \Image::make( $dir.$ad->filename ); // Building an Intervention Image obje
                if( $image->width() > 400 )
                {
                    echo 'processed<br />';
                    $image = $image->widen(400);    
                    $image->save( $dir.$ad->filename , 60);
                }
            } else {
                echo '======missing file====<br />';
            }
            
            echo $counter . '. '.$ad->id.' -> '.$ad->ad_imageAd->title_slug.' , filename ->'.$dir.$ad->filename.'<br />';
            echo 'path: https://dieren-plaats.nl/storage/app/public/uploads/ads/thumb/'.$ad->filename.'<br />';
            $counter++;
            echo '===================================<br />';
        }
        
        // foreach($dr as $path)
        // {
        //         $pathDestination = pathinfo($path)['dirname'] .'';
        //     // echo ( $path . basename($path) . " === ".  $pathDestination ."<br/>");
        //         if( !File::isDirectory( $pathDestination ) )
        //         {
        //             File::makeDirectory($pathDestination, 0777, true, true);
        //         }
            
        // //File::makeDirectory($path, 0777, true, true)
        //     if(!File::isDirectory($path))
        //     {
        //         $image = Image::make($path); // Building an Intervention Image obje
        //         if($image->width() >400)
        //         {
        //             $image = $image->widen(400);    
        //             $image->save($pathDestination.'/'.basename($path), 60);
        //         }
        //     }
        
        //     echo "<img src='".url(str_replace("D:\\xampp\htdocs\hoppie\public\\","",$pathDestination)).'/'.basename($path)."' style='padding:15px; float:left;width:150px'/>";
        // }
        
        return ;
    }

    public function makeslug(){
        $ads = AdAttributeOption::all();
        foreach( $ads as $ad ){
            if( $ad->title_slug == '' or strlen( $ad->title_slug ) < 3 ){
                $adToUpdate = AdAttributeOption::where('id', '=', $ad->id)->first();
                $adToUpdate->title_slug = Str::slug($ad->title);
                $adToUpdate->save();
            }
        }
    }

    public function import( Request $request ){
        $collection = (new FastExcel)->import( public_path( 'export-sellers-USED.xlsx' ) );
        $firstIteration = true;
        DB::beginTransaction();   
        try {
                $insert = array();
                foreach( $collection as $record ){
                    $counter = 0;
                    $name = '';
                    $email = '';
                    $phone = '';
                    $olduserid = 0;
                    foreach( $record as $key => $value ){
                        if( $counter == 0 ){
                            $olduserid = $value;
                        } else if( $counter == 1 ){
                            $name = $value;
                        } else if( $counter == 2 ){
                            $email = $value;
                        } else if( $counter == 3 ){
                            $phone = $value;
                        }
                        $counter++;
                    }

                    $userExisting = User::where( 'email' , '=', $email )->count();
                    if( $userExisting < 1 ){
                        echo 'new user -> '.$email.'<br />';
                        $newUser = new User;
                        $newUser->name = $name;
                        $newUser->email = $email;
                        $newUser->usertype = 'Normal';
                        $newUser->olduserid = $olduserid;
                        $newUser->password = bcrypt('laura123');
                        $newUser->save();
                        
                        $newBreeder = new Breeder;
                        $newBreeder->owner_name = $name;
                        $newBreeder->company_name = $name;
                        $newBreeder->user_id = $newUser->id;
                        if( $phone != '' and strlen($phone) > 2 ){
                            $newBreeder->phone = $phone;
                        }
                        $newBreeder->save();
                    } else {
                        echo 'existing user -> '.$email.'<br />';
                    }
                }
                DB::commit();
            } catch(\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
                return $data;
            }
    }

    public function sellerToAds(){
        $collection = (new FastExcel)->import( public_path( 'seller-ad-id-list-USED.xlsx' ) );
        $firstIteration = true;
        DB::beginTransaction();   
        try {
                $insert = array();
                foreach( $collection as $record ){
                    $counter = 0;
                    $adId = '';
                    $sellerId = '';
                    foreach( $record as $key => $value ){
                        if( $counter == 0 ){
                            $adId = $value;
                        } else if( $counter == 1 ){
                            $sellerId = $value;
                        }
                        $counter++;
                    }
                    $record = [
                        'adid' => $adId,
                        'sellerid' => $sellerId,
                    ];
                    $insert[] = $record;
                }
                DB::table('selleradconnection')->insert($insert);
                
                DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return $data;
        }
    }

    public function xlsx( Request $request ){
        $collection = (new FastExcel)->import( public_path( 'catalog_products-USED.xlsx' ) );
        DB::beginTransaction();   
        try {
                $mainCounter = 1;
                $emptyOptionAds = 0;
                foreach( $collection as $record ){
                        $counter = 0;
                        $adDesc = '';
                        $adTitle = '';
                        $adPrice = '';
                        $raceId = 0;
                        $kind = '';
                        $kindId = 0;
                        $adId = 0;
                        $userId = 0;
                        $optionsIds = array();
                        foreach( $record as $key => $value ){
                            //echo $counter.' - '.$value.'<br />';
                            if( $counter == 0 ){
                                $adId = $value;
                                $userRec = DB::select( 'select t1.sellerid, t2.id as userid from selleradconnection as t1, users as t2 
                                         where t1.adid = "'.$adId.'" and t2.olduserid = t1.sellerid ' );
                                if( count( $userRec ) > 0 ){
                                    $userId = $userRec[0]->userid;
                                } 
                            } else if( $counter == 1 ){
                                $kindObj = Kind::where('title', '=', $value);
                                if( $kindObj->count() > 0 ){
                                    $kindRec = $kindObj->first();
                                    $kindId = $kindRec->id;
                                } else {
                                    echo 'Kind missing '. $value.'<br />';
                                }
                            } else if( $counter == 2 ){
                                $adDesc = $value;
                            } else if( $counter == 9 ){
                                $imagePath = substr( $value , 1 );
                            } else if( $counter == 13 ){
                                $adTitle = $value;
                            } else if( $counter == 15 ){
                                $value = str_replace( ',', '', $value );
                                $adPrice = substr($value , 0 , -4 );
                            } else if( $counter == 16 or $counter == 17 or $counter == 20 or $counter == 22 or $counter == 25 ){ //its race
                                if( $value != '' and strlen( $value ) > 2 ){
                                    $raceObj = Race::where( 'title', '=', $value );
                                    if( $raceObj->count() > 0 ){
                                        $raceRec = $raceObj->first();
                                        $raceId = $raceRec->id;
                                        //$kindId = $raceRec->kind_id;
                                    } else {
                                        echo 'Race -> "'. $value. '" - not found <br /> ';
                                    }
                                }
                            } else if( $counter != 18 ){
                                if( $value != '' and strlen( $value ) > 2 ) {
                                    $optionsObj = AdAttributeOption::where( 'title', '=', $value );
                                    if( $optionsObj->count() > 0 ){
                                        $optRec = $optionsObj->first();
                                        $optionsIds[] = $optRec->id;
                                    } else {
                                        $optionsArray = explode( ',', $value );
                                        foreach( $optionsArray as $optionsSingle ){
                                            $optionsObj = AdAttributeOption::where( 'title', '=', trim($optionsSingle) );
                                            if( $optionsObj->count() > 0 ){
                                                $optRec = $optionsObj->first();
                                                $optionsIds[] = $optRec->id;
                                            } else {
                                                echo 'Option -> "'.$optionsSingle.'" - not found <br />';
                                            }
                                        }
                                        
                                    }
                                }
                            }

                            // $attrObj = AdAttribute::where( 'title', '=', $key );
                            // if( $attrObj->count() > 0 ){
                            //     echo 'found<br />';
                            // } else {
                            //     echo 'not found '. $key. ' <br /> ';
                            // }

                            $counter++;
                        } // foreach internal
                    //echo 'race-> '.$raceId.' - '.$kindId.'<br />';
                    if( $raceId > 0 and $kindId > 0 and $userId > 0) {

                        $newAd = new Ad;
                        $newAd->title = $adTitle;
                        $newAd->title_slug = Str::slug( $adTitle );
                        $newAd->desc = $adDesc;
                        $newAd->amount = $adPrice;
                        $newAd->race_id = $raceId;
                        $newAd->kind_id = $kindId;
                        $newAd->user_id = $userId;
                        $newAd->expires_on = date('Y-m-d', strtotime("+6 months", strtotime( date('Y-m-d' ) ) ) );
                        $newAd->status = 1;
                        $newAd->save();

                        $adImage = new AdImage;
                        $adImage->ad_id = $newAd->id;
                        $adImage->filename = $imagePath;
                        $adImage->save();

                        if( count( $optionsIds ) ) {
                            foreach( $optionsIds as $optionId ){
                                $adSelectedAttribute = new AdSelectedAttribute;
                                $adSelectedAttribute->ad_id = $newAd->id;
                                $adSelectedAttribute->ad_attribute_option_id = $optionId;
                                $adSelectedAttribute->save();
                            }
                        }
                    }
                    
                    $optionsIds = (array) null;
                } // ending foreach main
                DB::commit();
            } catch(\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }       
    }
}
