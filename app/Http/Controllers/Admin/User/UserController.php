<?php 
namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{ 
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function list(){
        $data = $this->userInterface->listUsers();
        return view('admin.user.list',$data);
    } 

    public function search( Request $req ){
        $data = $this->userInterface->searchUsers($req);
        return view('admin.user.table_data',$data)->render();
    } 


    public function create(UserRequest $request){
        $data = $this->userInterface->createUser( $request );
        return view('admin.user.list',$data);
    }  

    public function viewUser( $userId ){
        $data = $this->userInterface->viewUser( $userId );
        return view('admin.user.userdetail',$data);
    }

    public function updateUser( Request $request ){
        $data = $this->userInterface->update( $request );
        if( $data['code'] == 201 )
        {
            Session::flash('message', "Data Updated Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect('/admin/view_user/'.$request->userId)
                        ->withErrors($data['msg']);
        }else if( $data['code'] == 304 ){
            Session::flash('message', "Update is not required as data is same.");
        }

        return redirect('/admin/view_user/'.$request->userId)
                        ->withInput();
    }

    public function deleteUser( Request $request ){
        $data = $this->userInterface->delete( $request );
        return $data;
        // if( $data['code'] == 201 )
        // {
        //     Session::flash('message', "User Deleted Successfuly");
        // } else if( $data['code'] == 422 ){
        //     return redirect('/admin/listusers')
        //                 ->withErrors($data['msg']);
        // }else if( $data['code'] == 304 ){
        //     Session::flash('message', "Update is not required as data is same.");
        // }

        // return redirect('/admin/listusers')
        //                 ->withInput();
    }

    public function showSettingsForm(){
        $user_id = Auth::id();
        $user['admin'] = User::find( $user_id )->with('Breeder')->first();
        if( $user ){
            
            return view('admin.settings', $user );
        } else {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
    }

    public function saveSettingsForm( Request $request ){
        $data = $this->userInterface->updateAdmin( $request );
        if( $data['code'] == 201 )
        {
            Session::flash('message', "Information Updated Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }else if( $data['code'] == 304 ){
            Session::flash('message', "Update is not required as data is same.");
        }

        return redirect()->back()
                        ->withInput();
    }

}