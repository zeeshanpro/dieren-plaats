<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use App\Models\User;

class AdView extends Model
{ 
     use HasFactory;
    protected $table = 'ad_views';
    protected $fillable = [
        'ad_id',
        'user_id',
        'count_views',
        'like_ad'
    ];              
    /*
        Defining the foreign relation of local column -> ad_id on table ads
    */
    public function ad_viewAd() {
       return $this->belongsTo(Ad::class, 'ad_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function ad_viewUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    } 
}

?>