<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{ 
     use HasFactory;
    protected $table = 'messages';
    protected $fillable = [
        'msg',
        'ad_id',
        'user_id',
        'isread',
        'ifsent'
    ];              
    /*
        Defining the foreign relation of local column -> ad_id on table ads
    */
    public function messageAd() {
        return $this->belongsTo(Ad::class, 'ad_id', 'id');
     }
                 
     /*
         Defining the foreign relation of local column -> user_id on table users
     */
     public function messageUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
     } 
}

?>