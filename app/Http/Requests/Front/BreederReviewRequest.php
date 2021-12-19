<?php 
namespace App\Http\Requests\Front;
    
use Illuminate\Foundation\Http\FormRequest;
use App\Models\BreederReview;
use App\Models\Breeder;
use Illuminate\Support\Facades\Auth;

class BreederReviewRequest extends FormRequest
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
            if ($this->ifAlreadyReviewed( $this->request->get( 'uid' ) )) {
                $validator->errors()->add('msg', 'You have already reviews this seller.');
            }
        });
    }

    public function ifAlreadyReviewed( $uid ){
        $breederRec = Breeder::where( 'user_id', '=', $uid )->first();
        if( BreederReview::where( 'breeder_id' , '=', $breederRec->id )
                                ->where('user_id', '=', Auth::id() )->exists() ){
            return true;
        } 
        return false;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [ 
                'stars' => 'required|numeric',
                'comment' => 'required',
                'uid' => 'required|exists:users,id',
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
                    'stars.required' => 'Please enter Rating',
                    'stars.numeric' => 'Please enter Rating in number only.',
                    'comment.required' => 'Please enter Opinion',
                    'uid.required' => 'Please enter Breeder Id',
                    'uid.unique' => 'The Breeder is not in the system.',
                  
        ];
    } 
}

?>