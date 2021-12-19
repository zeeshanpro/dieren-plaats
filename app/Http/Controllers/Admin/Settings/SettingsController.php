<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function get_user_data(Request $req)
    {   $user_id = Auth::id();
        $user = User::find( $user_id );
        if( $user ){
            //$user['filePath'] = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            return view('admin.settings', $user);
        } else {
            // redirec to login
        }
        // $data['result'] = DB::select('select * from users ');
        // return view('admin.settings',$data);
    }


     public function fileUpload(Request $req){
        $user_id = Auth::id();
        $user = User::find( $user_id );
        if($user){
            $validator = $req->validate([
                'profileImge' => 'max:5200|mimes:jpg,jpeg,png'
                ]);
                if($req->file()) {
                    $fileName = time().'_'.$req->file('profileImge')->getClientOriginalName();
                    $dir = storage_path('app/public/uploads/thumb');
                    if( ! \File::isDirectory($dir) ) 
                    {
                        \File::makeDirectory($dir, 493, true);
                    }
                    // return response()->json(['success'=>$fileName]);
                    $filePath = $req->file('profileImge')->storeAs('uploads', $fileName, 'public');
                    sleep(2);
                    // $fileName="thumb_".$fileName;
                    $img = Image::make($req->file('profileImge')->getRealPath())->resize(300, null, function ($constraint) {
                         $constraint->aspectRatio();
                        })->save(storage_path('app/public/uploads/thumb/'.$fileName));
                    $user->pic = $fileName;
                    $user->save();
                    // return $img->response('jpg');
                    return response()->json(['success'=>'Successfully uploaded.']);
                }
                return response()->json(['success'=>'Failed TO upload.']);
        } else {
            return response()->json(['success'=>'Invalid call.']);
        }
   }
}
