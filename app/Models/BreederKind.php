<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Breeder;
use App\Models\Kind;

class BreederKind extends Model
{ 
     use HasFactory;
    protected $table = 'breeder_kinds';
    protected $fillable = [
        'breeder_id',
        'kind_id',
        'race_id'
    ];            
    /*
        Defining the foreign relation of local column -> breeder_id on table breeders
    */
    public function breeder_kindBreeder() {
       return $this->belongsTo(Breeder::class, 'breeder_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> kind_id on table kinds
    */
    public function breeder_kindKind() {
       return $this->belongsTo(Kind::class, 'kind_id', 'id');
    } 

    /*
        Defining the foreign relation of local column -> race_id on table races
    */
    public function breeder_kindRace() {
        return $this->belongsTo(Race::class, 'race_id', 'id');
     } 
}

?>