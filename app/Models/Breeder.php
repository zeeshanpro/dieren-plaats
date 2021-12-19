<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BreederKind;
use App\Models\BreederReview;

class Breeder extends Model
{ 
     use HasFactory;
    protected $table = 'breeders';
    protected $fillable = [
        'street',
        'city',
        'country',
        'user_id',
        'postal_code'
    ];              
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function breederUser() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table breeder_kinds
    */
    public function breederKinds() {
       return $this->hasMany(BreederKind::class, 'breeder_id', 'id');
    }
       
    public function breederKind() {
        return $this->hasOne(BreederKind::class, 'breeder_id', 'id');
    }

    /*
        Defining the foreign table relation of local column -> id on table breeder_reviews
    */
    public function breederReviews() {
       return $this->hasMany(BreederReview::class, 'breeder_id', 'id');
    } 

    public function avgRating()
    {
        return $this->breederReviews()
        ->selectRaw('TRUNCATE(avg(rating),1) as aggregate, breeder_id')
        ->groupBy('breeder_id');
    }
}

?>