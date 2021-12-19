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

class InvoicePaymentSucceededJob implements ShouldQueue
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

            $nextMonthDate = date('Y-m-d', $charge['lines']['data'][0]['period']['end'] );
            $dateOfTransaction = date('Y-m-d', $charge['lines']['data'][0]['period']['start'] );
            $renewalExistsCount = Renewal::where( 'user_id', '=', $user->id )
                    ->where( 'date_of_transaction', '=', $dateOfTransaction )
                    ->where( 'renewal_date', '=', $nextMonthDate )
                    ->count();
            if( $renewalExistsCount < 1 ) {
                $type = 'Renewal';
                $renewal = Renewal::create([
                                'user_id' => $user->id,
                                'date_of_transaction' => $dateOfTransaction,
                                'renewal_date' => $nextMonthDate,
                                'subtotal' => '',
                                'tax' => '',
                                'total' => $charge['amount_paid']
                            ]);
                if( $renewal ) {
                    // the remaining fields will be filled in Invoice paid response 
                    $renewalPayment = RenewalsPaymentDetail::create( [
                        'renewals_id' => $renewal->id,
                        'stripe_id' => $charge['charge'],
                        'payment_intent' =>  $charge['payment_intent'],
                        'payment_method' =>  '', //$charge['payment_method']
                        'payment_method_type' => $type,
                        'fingerprint' =>  '', //$charge['payment_method_details'][$type]['fingerprint'] lastdid
                        'mandate' =>  '', //$charge['payment_method_details'][$type]['mandate'],
                        'subscription' =>  $charge['subscription'],
                        'subscription_item' =>  $charge['lines']['data'][0]['subscription_item'],
                        'hosted_invoice_url' => $charge['hosted_invoice_url'],
                        'invoice_pdf' =>  $charge['invoice_pdf'],
                        'productplan' =>  $charge['lines']['data'][0]['plan']['id'],
                        'invoice' =>  $charge['number']
                    ] );
                }  
            }       
        }
    }
}
