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
use Mail;

class InvoicePaymentFailedJob implements ShouldQueue
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
            $arrayToSend = array('email'=>$user->email,'name' => $user->name);
                Mail::send( 'mailtemplates.registerOTPMail' , $arrayToSend, function( $message ) use( $user ) {
                $message->to( $user->email );
                $message->subject(  config("app.name") . ': Subscription renewal failed');
            } );
        } else {
            $arrayToSend = array('email'=> 'sunny.sahijwani@gmail.com','otp' => '12345', 'name' => 'name here');
            Mail::send( 'mailtemplates.registerOTPMail' , $arrayToSend, function( $message ) {
                $message->to( 'sunny.sahijwani@gmail.com' );
                $message->subject(  config("app.name") . ': Subscription renewal failed');
            } );
        }
    }
}
