<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RenewalsPaymentDetail;

class Renewal extends Model
{ 
     use HasFactory;
    protected $table = 'renewals';
    protected $fillable = [
        'user_id',
        'date_of_transaction',
        'renewal_date',
        'subtotal',
        'tax',
        'total'
    ]; 
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function user() {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }
                
    /*
        Defining the foreign table relation of local column -> id on table renewals_payment_details
    */
    public function paymentDetails() {
       return $this->hasOne(RenewalsPaymentDetail::class, 'renewals_id', 'id');
    } 
}

?>