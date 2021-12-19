<?php 
namespace App\Http\Controllers\Admin\AdAttribute;
use App\Http\Controllers\Controller;
use App\Interfaces\AdAttributeInterface;
use App\Http\Requests\AdAttributeRequest;
use Illuminate\Http\Request;

class AdAttributeController extends Controller
{ 
    protected $ad_attributeInterface;
    public function __construct(AdAttributeInterface $ad_attributeInterface)
    {
        $this->ad_attributeInterface = $ad_attributeInterface;
    }

    public function create(AdAttributeRequest $request){
        return $this->ad_attributeInterface->createAdAttribute( $request );
    }  

    public function search( Request $req ){
        $data = $this->ad_attributeInterface->searchAttributes($req);
        return view('admin.settings.attributes_table_data',$data)->render();
    } 

    public function add_options( Request $req ){
        $data = $this->ad_attributeInterface->add_options($req);
        return $data;
    }

    public function update_option( Request $req ){
        $data = $this->ad_attributeInterface->update_option($req);
        return $data;
    }

    public function delete_option( Request $req ){
        $data = $this->ad_attributeInterface->delete_options($req);
        return $data;
    }

    public function delete_attribute( Request $req ){
        $data = $this->ad_attributeInterface->delete_attribute($req);
        return $data;
    }

    public function update_attribute(Request $req){
        $data = $this->ad_attributeInterface->update_attribute($req);
        return $data;
    }

    public function list(){
        $data = $this->ad_attributeInterface->listAttributes();
        return view('admin.settings.attributes' , $data);
    } 

}
