<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expected_babie;
use App\Models\User;

class ExpectedBabiesSubscribe extends Model
{ 
     use HasFactory;
    protected $table = 'expected_babies_subscribe';
                
    /*
        Defining the foreign relation of local column -> expected_babies_id on table expected_babies
    */
    public function expected_babies_subscribeExpected_babie() {
       return $this->belongsTo(Expected_babie::class, 'expected_babies_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function expected_babies_subscribeUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    } 
}

