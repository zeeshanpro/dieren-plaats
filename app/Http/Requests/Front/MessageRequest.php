<?php 
namespace App\Http\Requests\Front;
    
use Illuminate\Foundation\Http\FormRequest;
class MessageRequest extends FormRequest
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
                    'msg' => 'required',
                    'receiver_id' => 'required',
                    'sender_id' => '',
                    'isread' => ''
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
                    'msg.required' => 'Please enter Msg',
                    'receiver_id.required' => 'Please enter Receiver Id',
                  
        ];
    }
    /* After validation function below */
    /*
    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {
            if ($this->validateFun( $this->request->get( 'GetKey' ) )) {
                $validator->errors()->add('GetKey', 'Custom message on fail.');
            }
        });
    }
    public function validateFun( $key ){
        return true or false as the case may be
    }
    */
    
     
}

