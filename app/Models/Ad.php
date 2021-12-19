<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kind;
use App\Models\Race;
use App\Models\User;
use App\Models\AdImage;
use App\Models\AdSelectedAttribute;
use App\Models\AdView;

class Ad extends Model
{ 
     use HasFactory;
    protected $table = 'ads';
    protected $fillable = [
        'title',
        'desc',
        'amount',
        'race_id',
        'kind_id',
        'user_id',
        'expires_on',
        'status'
    ];             
    /*
        Defining the foreign relation of local column -> kind_id on table kinds
    */
    public function adKind() {
       return $this->belongsTo(Kind::class, 'kind_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> race_id on table races
    */
    public function adRace() {
       return $this->belongsTo(Race::class, 'race_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function adUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table ad_images
    */
    public function adImages() {
       return $this->hasMany(AdImage::class, 'ad_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table ad_selected_attributes
    */
    public function adSelectedAttributes() {
       return $this->hasMany(AdSelectedAttribute::class, 'ad_id', 'id');
    }
    
    /*
        Defining the foreign table relation of local column -> id on table ad_views
    */
    public function adViews() {
       return $this->hasMany(AdView::class, 'ad_id', 'id');
    } 

    
}

?>