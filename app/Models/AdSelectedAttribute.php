<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdAttributeOption;
use App\Models\Ad;

class AdSelectedAttribute extends Model
{ 
     use HasFactory;
    protected $table = 'ad_selected_attributes';
                
    /*
        Defining the foreign relation of local column -> ad_attribute_option_id on table ad_attribute_options
    */
    public function ad_selected_attributeAd_attribute_option() {
       return $this->belongsTo(AdAttributeOption::class, 'ad_attribute_option_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> ad_id on table ads
    */
    public function ad_selected_attributeAd() {
       return $this->belongsTo(Ad::class, 'ad_id', 'id');
    } 
}

?>