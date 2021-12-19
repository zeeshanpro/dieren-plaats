<?php

namespace App\Jobs\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Models\User;
use App\Models\Renewal;
use App\Models\RenewalsPaymentDetail;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::where( 'stripe_id', '=', $charge['customer'] )->first();
        if( $user ){
            // change user type if needed here. 
            if( $charge['amount_captured'] == 100 ){
                $user->usertype = 'Shelter';
                $user->save();
            } else if( $charge['amount_captured'] == 495 ){
                $user->usertype = 'Breeder';
                $user->save();
            }

            $nextMonthDate = date('Y-m-d', strtotime("+1 months", strtotime( date('Y-m-d') ) ) );
            $type = $charge['payment_method_details']['type'];
            $renewal = Renewal::create([
                            'user_id' => $user->id,
                            'date_of_transaction' => date('Y-m-d'),
                            'renewal_date' => $nextMonthDate,
                            'subtotal' => '',
                            'tax' => '',
                            'total' => $charge['amount_captured']
                    ]);
            if( $renewal ) {
                // the remaining fields will be filled in Invoice paid response 
                if( $type == 'sepa_debit' ){
                    $mandate = $charge['payment_method_details'][$type]['mandate'];
                } else {
                    $mandate = $charge['payment_method_details'][$type]['brand'];
                }

                $renewalPayment = RenewalsPaymentDetail::create( [
                    'renewals_id' => $renewal->id,
                    'stripe_id' => $charge['id'],
                    'payment_intent' =>  $charge['payment_intent'],
                    'payment_method' =>  $charge['payment_method'],
                    'payment_method_type' => $type,
                    'fingerprint' =>  $charge['payment_method_details'][$type]['fingerprint'],
                    'mandate' =>  $mandate,
                    'subscription' =>  '',
                    'subscription_item' =>  '',
                    'hosted_invoice_url' => '',
                    'invoice_pdf' =>  '',
                    'productplan' =>  $charge['payment_method'],
                    'invoice' =>  $charge['invoice']
                ] );
            }         
        }
    }
}
