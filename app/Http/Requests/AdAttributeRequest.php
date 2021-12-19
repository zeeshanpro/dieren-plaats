<?php 
namespace App\Http\Requests;
    
use Illuminate\Foundation\Http\FormRequest;
class AdAttributeRequest extends FormRequest
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
                'title' => 'required',
                'kind_id' => 'required|numeric',
                'options' => 'required',
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
                    'kind_id.required' => 'Please enter Kind',
                    'kind_id.numeric' => 'Please enter Kind in number only.',
                    'options.required' => 'Please enter options along with attribtue title.',
                  
        ];
    } 
}

?>