<?php

namespace App\Http\Controllers\Front\EmailSubscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSubscribe;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\DB;

class EmailSubscribeController extends Controller
{
    public function create( Request $request ){
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), 
                [ 
                    'email' => 'required|email|unique:email_subscribe'
                ]); 
            if ($validator->fails()) { 
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();;
                return $data;
            }
            
            DB::beginTransaction();   
            try {   
                    $newEmailSubscribe = new EmailSubscribe;
                    $newEmailSubscribe->email = $request->email;
                    $newEmailSubscribe->save();
            
                    DB::commit();

                    $data['code'] = 201;
                    $data['msg'] = 'Subscribed Successfully!!';
                    $data['error'] = false;
                    Session::flash('message', "Thanks for subscribing with us.");
                    return $data;
            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['msg'] = $e->getMessage();
                $data['error'] = true;
                Session::flash('message', $e->getMessage());
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['msg'] = 'Invalid call';
            Session::flash('message', 'Invalid call');
            $data['error'] = true;
            return $data;
        }
    }
}
