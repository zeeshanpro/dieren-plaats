<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\ExpectedBabie;
use App\Models\User;
use App\Models\Renewal;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(){
        $result['adCount'] = Ad::get()->count();
        $result['expectedBabieCount'] = ExpectedBabie::get()->count();
        $result['userCount'] = User::whereIn( 'usertype', [ 'Normal', 'Shelter', 'Breeder' ] )->get()->count();
        $result['renewalCount'] = Renewal::get()->count();
        $result['ads'] = Ad::where('status', '=', 1)->with(['adKind','adRace','adUser'])->orderByDesc('id')->take(10)->get();
        return view('admin.dashboard', $result );
    }
}
