<?php 
namespace App\Http\Requests;
    
use Illuminate\Foundation\Http\FormRequest;
class KindRequest extends FormRequest
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
                'title' => 'required|unique:kinds',
                'status' => '',
                'kindImage' => 'required|mimes:jpeg,jpg,png|max:5200'
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
                    'title.unique' => 'The Title is already registered in the system.',
                    'kindImage.required' => 'Please upload image for kind in JPG format',
                  
        ];
    } 
}

?>