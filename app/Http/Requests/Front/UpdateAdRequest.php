<?php 
namespace App\Http\Requests\Front;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kind;
use App\Models\Race;
use App\Models\AdImage;

class UpdateAdRequest extends FormRequest
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
            if (!$this->validateIfImagePresent( $this->request->get( 'adId' ) ) ) {
                $validator->errors()->add('filename', 'Please upload at least one image to continue');
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

    public function validateIfImagePresent( $adId ){
        $OkayToProceed = true;
        $adImages = AdImage::where( 'ad_id', '=', $adId )->get();
        
        if( $adImages->count() > 0 ){
            if( $this->request->has('delete_file_id') ){
                $deleteFileIds = $this->request->get('delete_file_id');
                if( $deleteFileIds != '' ){
                    $arrOfFileIds = explode( ',', $deleteFileIds );
                    if( count( $arrOfFileIds ) >= $adImages->count() ){
                        if( ( $this->request->has('filename') ) ) {
                            foreach($this->request->get('filename') as $key => $val)
                            {
                                return true;
                            }
                        }
                        return false;
                    }
                }
            }
            return true;
        } else {
            foreach($this->request->get('filename') as $key => $val)
            {
                return true;
            }
            return false;
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [ 
                'adId' => 'required|numeric',
                'title' => 'required',
                'desc' => 'required',
                'amount' => 'required',
                'race' => 'required|numeric',
                'kind' => 'required|numeric',
                // 'filename' => 'required',
                // 'filename.*' => 'required'
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
                    'adId.required' => 'Please refresh the page and try again',
                    'title.required' => 'Please enter Title',
                    'desc.required' => 'Please enter Desc',
                    'amount.required' => 'Please enter Amount',
                    'race.required' => 'Please select Race',
                    'race.numeric' => 'Please select Race from options only.',
                    'kind.required' => 'Please choose Kind',
                    'kind.numeric' => 'Please choose a valid Kind only.',
                    //'filename.required' => 'Please upload at least one image to continue'
                  
        ];
    } 
}

?>