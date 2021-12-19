<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use App\Models\ExpectedBabie;

class Race extends Model
{ 
     use HasFactory;
    protected $table = 'races';
    protected $fillable = [
        'title',
        'status'
    ];               
    /*
        Defining the foreign table relation of local column -> id on table ads
    */
    public function raceAds() {
       return $this->hasMany(Ad::class, 'race_id', 'id');
    }
     
    public function kind() {
        return $this->belongsTo(Kind::class, 'kind_id', 'id');
    }

    /*
        Defining the foreign table relation of local column -> id on table expected_babies
    */
    public function raceExpectedBabies() {
       return $this->hasMany(ExpectedBabie::class, 'race_id', 'id');
    } 
}

?>