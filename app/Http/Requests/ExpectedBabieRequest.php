<?php 
namespace App\Http\Requests;
    
use Illuminate\Foundation\Http\FormRequest;
class ExpectedBabieRequest extends FormRequest
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
                'expected_at' => 'required',
                'desc' => 'required',
                'father' => 'required',
                'mother' => 'required',
                'father_pic' => 'required|image|mimes:jpg,jpeg,png',
                'mother_pic' => 'required|image|mimes:jpg,jpeg,png',
                'race_id' => 'required',
                'kind_id' => 'required',
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
                    'expected_at.required' => 'Please enter Expected At',
                    'desc.required' => 'Please enter Desc',
                    'father.required' => 'Please enter Father',
                    'mother.required' => 'Please enter Mother',
                    'father_pic.required' => 'Please enter Father Pic',
                    'father_pic.image' => 'Please check the file format of Father Pic and try uploading again.',
                    'mother_pic.required' => 'Please enter Mother Pic',
                    'mother_pic.image' => 'Please check the file format of Mother Pic and try uploading again.',
                    'race_id.required' => 'Please enter Race Id',
                    'kind_id.required' => 'Please enter Kind Id',
                  
        ];
    } 
}

?>