<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kind;
use App\Models\AdAttributeOption;

class AdAttribute extends Model
{ 
     use HasFactory;
    protected $table = 'ad_attributes';
    protected $fillable = [
        'title',
        'kind_id',
        'status'
    ];            
    /*
        Defining the foreign relation of local column -> kind_id on table kinds
    */
    public function ad_attributeKind() {
       return $this->belongsTo(Kind::class, 'kind_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table ad_attribute_options
    */
    public function ad_attributeAdAttributeOptions() {
       return $this->hasMany(AdAttributeOption::class, 'ad_attribute_id', 'id');
    } 
}

?>