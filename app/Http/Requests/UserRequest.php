<?php 
namespace App\Http\Requests;
    
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
                'email' => 'required|unique:users',
                'email_verified_at' => '',
                'email_otp' => '',
                'password' => 'required',
                'usertype' => '',
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
                    'email.unique' => 'The Email Address is already registered in the system.',
                    'password.required' => 'Please enter Password',
                  
        ];
    } 
}

?>