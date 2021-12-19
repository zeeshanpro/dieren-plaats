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

class InvoicePaidJob implements ShouldQueue
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
            $renewalPaymentDetails = RenewalsPaymentDetail::where( 'stripe_id', '=', $charge['charge'] )->first();
            if( $renewalPaymentDetails ) {
                $renewalPaymentDetails->subscription = $charge['lines']['data'][0]['subscription'];
                $renewalPaymentDetails->subscription_item = $charge['lines']['data'][0]['subscription_item'];
                $renewalPaymentDetails->hosted_invoice_url = $charge['hosted_invoice_url'];
                $renewalPaymentDetails->invoice_pdf = $charge['invoice_pdf'];
                $renewalPaymentDetails->productplan = $charge['lines']['data'][0]['plan']['id'];
                $renewalPaymentDetails->invoice = $charge['number'];
                $renewalPaymentDetails->save();

                $renewal = Renewal::find( $renewalPaymentDetails->renewals_id );
                $renewal->subtotal = $charge['subtotal'];
                $renewal->tax = $charge['tax'];
                $renewal->total = $charge['total'];
                $renewal->save();

                // send email to user for confirmation of the subscription here
                $total_fee = $charge['total']/100;
                $arrayToSend = array('customer' => $user->name, 'monthly_fee' => $total_fee);
                Mail::send( 'mailtemplates.subscription_started_mail' , $arrayToSend, function( $message ) use( $user ) {
                    $message->to( $user->email );
                    $message->subject( 'Je account is actief' );
                } );
            }
        } else {
            echo 'user not found';
        }
    }
}
