<?php

namespace App\Http\Controllers\API\GiftType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftType;

class GiftTypeController extends Controller
{
    public function __invoke(){
        $giftTypes = GiftType::all();
        return response($giftTypes, 200);
    }
}
