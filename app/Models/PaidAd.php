<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use App\Models\User;

class PaidAd extends Model
{ 
    use HasFactory;
    protected $table = 'paid_ads';
                
    /*
        Defining the foreign relation of local column -> ad_id on table ads
    */
    public function ad() {
       return $this->belongsTo(Ad::class, 'ad_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function user() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    } 
}

?>