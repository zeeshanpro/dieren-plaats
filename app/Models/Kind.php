<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use App\Models\AdAttribute;
use App\Models\BreederKind;
use App\Models\ExpectedBabie;
use App\Models\Race;

class Kind extends Model
{ 
     use HasFactory;
    protected $table = 'kinds';
    protected $fillable = [
        'title',
        'status',
        'image',
        'icon'
    ];               
    /*
        Defining the foreign table relation of local column -> id on table ads
    */
    public function kindAds() {
       return $this->hasMany(Ad::class, 'kind_id', 'id');
    }
    
    /*
        Defining the foreign table relation of local column -> id on table race
    */
    public function races() {
        return $this->hasMany(Race::class, 'kind_id', 'id')->orderBy('title');;
     }

    /*
        Defining the foreign table relation of local column -> id on table ad_attributes
    */
    public function kindAdAttributes() {
       return $this->hasMany(AdAttribute::class, 'kind_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table breeder_kinds
    */
    public function kindBreederKinds() {
       return $this->hasMany(BreederKind::class, 'kind_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table expected_babies
    */
    public function kindExpectedBabies() {
       return $this->hasMany(ExpectedBabie::class, 'kind_id', 'id');
    } 
}

?>