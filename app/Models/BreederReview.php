<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Breeder;
use App\Models\User;

class BreederReview extends Model
{ 
     use HasFactory;
    protected $table = 'breeder_reviews';
    protected $fillable = [
        'breeder_id',
        'user_id',
        'rating',
        'opinion'
    ];    
           
    /*
        Defining the foreign relation of local column -> breeder_id on table breeders
    */
    public function breeder_reviewBreeder() {
       return $this->belongsTo(Breeder::class, 'breeder_id', 'id');
    }
                
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function breeder_reviewUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    } 
}

?>