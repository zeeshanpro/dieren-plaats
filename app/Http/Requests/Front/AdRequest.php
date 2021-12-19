<?php 
namespace App\Http\Requests\Front;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kind;
use App\Models\Race;
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

    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {
            if ($this->validateKind( $this->request->get( 'kind' ) )) {
                $validator->errors()->add('kind', 'Please choose the correct kind again.');
            }
            if ($this->validateRace( $this->request->get( 'race' ) )) {
                $validator->errors()->add('race', 'Please choose the correct race again.');
            }
        });
    }

    public function validateKind( $kindId ){
        if( Kind::find( $kindId ) ){
            return false;
        } 
        return true;
    }

    public function validateRace( $raceId ){
        if( Race::find( $raceId ) ){
            return false;
        } 
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
                'race' => 'required|numeric',
                'kind' => 'required|numeric',
                'filename' => 'required',
                'filename.*' => 'required'
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
                    'race.required' => 'Please select Race',
                    'race.numeric' => 'Please select Race from options only.',
                    'kind.required' => 'Please choose Kind',
                    'kind.numeric' => 'Please choose a valid Kind only.',
                    'filename.required' => 'Please upload at least one image to continue'
                  
        ];
    } 
}

?>