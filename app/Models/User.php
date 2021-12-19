<?php 
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use App\Models\Ad;
use App\Models\AdView;
use App\Models\Breeder;
use App\Models\BreederReview;
use App\Models\ExpectedBabie;
use Laravel\Cashier\Billable;
use App\Models\ExpectedBabiesSubscribe;
use App\Models\Message;
use App\Models\Renewal;

class User extends Authenticatable
{ 
    use HasFactory;
    use Billable;
    use Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'status',
        'email_otp',
        'password',
        'stripe_product_id',
        'google_id'
    ];              
    /*
        Defining the foreign table relation of local column -> id on table ads
    */
    public function userAds() {
       return $this->hasMany(Ad::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table ad_views
    */
    public function userAdViews() {
       return $this->hasMany(AdView::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table breeders
    */
    public function userBreeders() {
       return $this->hasMany(Breeder::class, 'user_id', 'id');
    }
     
    public function Breeder() {
        return $this->hasOne(Breeder::class, 'user_id', 'id');
    }

    /*
        Defining the foreign table relation of local column -> id on table breeder_reviews
    */
    public function userBreederReviews() {
       return $this->hasMany(BreederReview::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table expected_babies
    */
    public function userExpectedBabies() {
       return $this->hasMany(ExpectedBabie::class, 'user_id', 'id');
    }

    /*
        Defining the foreign table relation of local column -> id on table expected_babies_subscribe
    */
    public function userExpectedBabiesSubscribe() {
        return $this->hasMany(ExpectedBabiesSubscribe::class, 'user_id', 'id');
    }

    /*
        Defining the foreign table relation of local column -> id on table messages
    */
    public function userMessages() {
        return $this->hasMany(Message::class, 'user_id', 'id');
     }
                 
     /*
         Defining the foreign table relation of local column -> id on table renewals
     */
     public function userRenewals() {
        return $this->hasMany(Renewal::class, 'user_id', 'id');
     }

    public function latestRenewal()
    {
        return $this->hasOne('App\Models\Renewal')->latest();
    }
}
