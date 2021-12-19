<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile(Request $req){
        $user_id = Auth::id();
        $user = User::find( $user_id )->with('transactions.userSender:id,name','transactions.userReceiver:id,name')->first();
        return response()->json(['profile' => $user ], 200);
    }
}
