<?php

namespace App\Http\Controllers\Front\SPWebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;
use Stripe;
//use Session;
use Exception;

class SPWebhookController extends Controller
{
    public function handleWebHookResponse( Request $request ){
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
            $endpoint_secret = 'whsec_uDIg2u3l1qDEXeQmPz8VIZUofeAaBmLX';

            $payload = @file_get_contents('php://input');
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            $event = null;

            try {
                $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
                );
            } catch(\UnexpectedValueException $e) {
                // Invalid payload
                http_response_code(400);
                exit();
            } catch(\Stripe\Exception\SignatureVerificationException $e) {
                // Invalid signature
                http_response_code(400);
                exit();
            }

            // Handle the event
            switch ($event->type) {
                case 'charge.captured':
                    $charge = $event->data->object;
                  case 'charge.expired':
                    $charge = $event->data->object;
                  case 'charge.failed':
                    $charge = $event->data->object;
                  case 'charge.pending':
                    $charge = $event->data->object;
                  case 'charge.refunded':
                    $charge = $event->data->object;
                  case 'charge.succeeded':
                    $charge = $event->data->object;
                  case 'charge.updated':
                    $charge = $event->data->object;
                  case 'charge.dispute.closed':
                    $dispute = $event->data->object;
                  case 'charge.dispute.created':
                    $dispute = $event->data->object;
                  case 'charge.dispute.funds_reinstated':
                    $dispute = $event->data->object;
                  case 'charge.dispute.funds_withdrawn':
                    $dispute = $event->data->object;
                  case 'charge.dispute.updated':
                    $dispute = $event->data->object;
                  case 'charge.refund.updated':
                    $refund = $event->data->object;
                  case 'invoice.created':
                    $invoice = $event->data->object;
                  case 'invoice.deleted':
                    $invoice = $event->data->object;
                  case 'invoice.finalization_failed':
                    $invoice = $event->data->object;
                  case 'invoice.finalized':
                    $invoice = $event->data->object;
                  case 'invoice.marked_uncollectible':
                    $invoice = $event->data->object;
                  case 'invoice.paid':
                    $invoice = $event->data->object;
                  case 'invoice.payment_action_required':
                    $invoice = $event->data->object;
                  case 'invoice.payment_failed':
                    $invoice = $event->data->object;
                  case 'invoice.payment_succeeded':
                    $invoice = $event->data->object;
                  case 'invoice.sent':
                    $invoice = $event->data->object;
                  case 'invoice.upcoming':
                    $invoice = $event->data->object;
                  case 'invoice.updated':
                    $invoice = $event->data->object;
                  case 'invoice.voided':
                    $invoice = $event->data->object;
                  case 'payment_intent.amount_capturable_updated':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.canceled':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.created':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.processing':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.requires_action':
                    $paymentIntent = $event->data->object;
                  case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                  case 'payout.canceled':
                    $payout = $event->data->object;
                  case 'payout.created':
                    $payout = $event->data->object;
                  case 'payout.failed':
                    $payout = $event->data->object;
                  case 'payout.paid':
                    $payout = $event->data->object;
                  case 'payout.updated':
                    $payout = $event->data->object;
                  // ... handle other event types
                  default:
                    echo 'Received unknown event type ' . $event->type;
            }

            if( isset( $charge ) ) {
                print_r( $charge );
            }

            if( isset( $paymentIntent ) ) {
                print_r( $paymentIntent );
            }

            if( isset( $payout ) ) {
                print_r( $payout );
            }

            if( isset( $invoice ) ) {
                print_r( $invoice );
            }

            echo 'reached the end';

            http_response_code(200);
            
            return ;
    }
}
