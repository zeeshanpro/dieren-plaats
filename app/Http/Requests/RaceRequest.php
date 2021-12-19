<?php 
namespace App\Http\Requests;
    
use Illuminate\Foundation\Http\FormRequest;
class RaceRequest extends FormRequest
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
                'title' => 'required|unique:races,title',
                'kindid' => 'required|numeric',
                'status' => ''
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
                    'title.required' => 'Please enter Title',
                    'kindid.required' => 'Please select kind from options'
                  
        ];
    } 
}

?>