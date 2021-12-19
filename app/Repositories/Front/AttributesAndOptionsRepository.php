<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\KindInterface;
use App\Models\AdAttribute;

class AttributesAndOptionsRepository //implements KindInterface
{
    public function list( $kind_id ){
        $data['result'] = AdAttribute::where('kind_id', '=', $kind_id)->where('status','=', 1)
                                ->with('ad_attributeAdAttributeOptions')
                                ->orderBy('title', 'ASC')
                                ->get();
        $data['code'] = 200;
        //dd($data['result']);
        return $data;
    }
}
