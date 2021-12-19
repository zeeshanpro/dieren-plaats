<?php 
namespace App\Http\Requests;
    
use Illuminate\Foundation\Http\FormRequest;
class AdRequest extends FormRequest
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
                'desc' => 'required',
                'amount' => 'required',
                'race_id' => 'required|numeric',
                'kind_id' => 'required|numeric',
                'user_id' => ''
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
                    'desc.required' => 'Please enter Desc',
                    'amount.required' => 'Please enter Amount',
                    'race_id.required' => 'Please enter Race',
                    'race_id.numeric' => 'Please enter Race in number only.',
                    'kind_id.required' => 'Please enter Kind',
                    'kind_id.numeric' => 'Please enter Kind in number only.',
                  
        ];
    } 
}

?>