<?php 
namespace App\Http\Controllers\Admin\Kind;
use App\Http\Controllers\Controller;
use App\Interfaces\KindInterface;
use App\Http\Requests\KindRequest;
use Illuminate\Http\Request;

class KindController extends Controller
{ 
    protected $kindInterface;
    public function __construct(KindInterface $kindInterface)
    {
        $this->kindInterface = $kindInterface;
    }

    public function create(Request $request){
        return $this->kindInterface->createKind( $request );
    }  

    public function list(){
        $data = $this->kindInterface->listKinds();
        return view('admin.settings.kind', $data);
    } 

    public function update(Request $request){
        return $this->kindInterface->update_Kind( $request );
    } 
    
    public function delete(Request $request){
        return $this->kindInterface->delete_Kind( $request );
    } 
    
    public function search( Request $req ){
        $data = $this->kindInterface->search($req);
        return view('admin.settings.kind_table_data',$data)->render();
    }
}

?>