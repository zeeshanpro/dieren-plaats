<?php 
namespace App\Http\Requests\Front;
    
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{ 

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [ 
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'company' => '',
                'country' => '',
                'phone' => '',
                'email_verified_at' => '',
                'email_otp' => '',
                'password' => 'required|min:8',
                'usertype' => 'required|in:Normal,Shelter,Breeder',
                'remember_token' => ''
            ];
    }
    
    
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
                    'name.required' => 'Please enter Name',
                    'email.required' => 'Please enter Email Address',
                    'email.email' => 'Please check the format of Email Address and try again.',
                    'email.unique' => 'The Email Address is already registered in the system.',
                    'usertype.required' => 'Please enter Usertype',
                  
        ];
    } 
}

?>