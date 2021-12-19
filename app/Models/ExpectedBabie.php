<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kind;
use App\Models\Race;
use App\Models\User;

class ExpectedBabie extends Model
{ 
     use HasFactory;
    protected $table = 'expected_babies';
    protected $fillable = [
        'user_id',
        'expected_at',
        'father',
        'mother',
        'father_pic',
        'mother_pic',
        'race_id',
        'kind_id'
    ];             
    /*
        Defining the foreign relation of local column -> kind_id on table kinds
    */
    public function expected_babieKind() {
       return $this->belongsTo(Kind::class, 'kind_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> race_id on table races
    */
    public function expected_babieRace() {
       return $this->belongsTo(Race::class, 'race_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function expected_babieUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    } 

    /*
        Defining the foreign table relation of local column -> id on table expected_babies_subscribe
    */
    public function expected_babieExpectedBabiesSubscribe() {
        return $this->hasMany(ExpectedBabiesSubscribe::class, 'expected_babies_id', 'id');
     } 
}

?>