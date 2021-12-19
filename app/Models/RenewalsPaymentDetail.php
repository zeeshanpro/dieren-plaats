<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Renewal;

class RenewalsPaymentDetail extends Model
{ 
     use HasFactory;
    protected $table = 'renewals_payment_details';
    protected $fillable = [
        'stripe_id',
        'renewals_id',
        'payment_intent',
        'payment_method',
        'payment_method_type',
        'fingerprint',
        'mandate',
        'subscription',
        'subscription_item',
        'hosted_invoice_url',
        'invoice_pdf',
        'productplan',
        'invoice'
    ];           
    /*
        Defining the foreign relation of local column -> renewals_id on table renewals
    */
    public function renewal() {
       return $this->belongsTo(Renewal::class, 'renewals_id', 'id');
    } 
}

?>