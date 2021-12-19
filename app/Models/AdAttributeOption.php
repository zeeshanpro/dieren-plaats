<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdAttribute;
use App\Models\AdSelectedAttribute;

class AdAttributeOption extends Model
{ 
     use HasFactory;
    protected $table = 'ad_attribute_options';
    protected $fillable = [
        'title',
        'ad_attribute_id',
        'status'
    ];            
    /*
        Defining the foreign relation of local column -> ad_attribute_id on table ad_attributes
    */
    public function ad_attribute_optionAd_attribute() {
       return $this->belongsTo(AdAttribute::class, 'ad_attribute_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table ad_selected_attributes
    */
    public function ad_attribute_optionAdSelectedAttributes() {
       return $this->hasMany(AdSelectedAttribute::class, 'ad_attribute_option_id', 'id');
    } 
}

?>