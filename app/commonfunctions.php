<?php
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File; 
//thuis function creates pagination
//https://www.youtube.com/watch?v=nsHS1e5QOYw
// composer dump-autoload 
function arrayPaginatorWithRequest($array, $request)
{
    $page = $request->get('page', 1);
    $perPage = 1;
    $offset = ($page * $perPage) - $perPage;
    return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
        ['path' => $request->url(), 'query' => $request->query()]);
}

function deleteImage( $fileName, $pathAfterPublicWithoutSlashes ){
    @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/'. $fileName );
    @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'. $fileName );
}

function uploadImage( Request $req, $fileKey, $pathAfterPublicWithoutSlashes, $existingImageIfAny = '' ){
    $lastTwo = substr( $fileKey, -2 );
    if( ( $lastTwo == '[]') ){
        $key = substr( $fileKey, 0, -2 );
        $files = $req->file( $key );
        if( $req->hasFile( $key ) )
        {
            $fileNamesArray = array();
            foreach ( $files as $file) {
                $fileNames = time().'_'.$file->getClientOriginalName();
                $dir = storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb');
                if( ! \File::isDirectory($dir) ) 
                {
                    \File::makeDirectory($dir, 493, true);
                }
                $filePath = $file->storeAs( $pathAfterPublicWithoutSlashes , $fileNames, 'public');
                sleep(2);
                $img = Image::make( $file->getRealPath())->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save(storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'.$fileNames));
                
                $fileNamesArray[] = $fileNames;
                if( $existingImageIfAny != '' ){
                    @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/'. $existingImageIfAny );
                    @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'. $existingImageIfAny );
                }
            }
            return $fileNamesArray;
        }

    } else if( $fileKey != '' ){
        $fileName = time().'_'.$req->file( $fileKey )->getClientOriginalName();
        $dir = storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb');
        if( ! \File::isDirectory($dir) ) 
        {
            \File::makeDirectory($dir, 493, true);
        }
        $filePath = $req->file( $fileKey )->storeAs( $pathAfterPublicWithoutSlashes , $fileName, 'public');
        sleep(2);
        $img = Image::make($req->file( $fileKey )->getRealPath())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(storage_path('app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'.$fileName));
        
        if( $existingImageIfAny != '' ){
            @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/'. $existingImageIfAny );
            @unlink( 'storage/app/public/'.$pathAfterPublicWithoutSlashes.'/thumb/'. $existingImageIfAny );
        }
        return $fileName;
    } else {
        return 0;
    }
}

define('REC_PER_PAGE', 21); 
//Stripe plan for subcsription 
define('STRIPE_SHELTER_PLAN', 'price_1K7HkBBuir1vjVYcdajeTyy7'); 
define('STRIPE_BREEDER_PLAN', 'price_1K7HkuBuir1vjVYcJwPCY5Yq'); 
//Stripe plan for paying and promoting the ad 
define('STRIPE_AD_PROMOTION_PLAN', 'price_1K7HiwBuir1vjVYc0o5mQ0l6'); 

?>