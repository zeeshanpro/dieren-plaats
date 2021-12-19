<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Ad;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            //Email user 2 days prior the ad expiry
            $dateOfExpire = date('Y-m-d', strtotime(date('Y-m-d'). ' + 2 days'));
            $ads = Ad::where( 'expires_on', '=', $dateOfExpire )->with(['adUser','adKind'])->get();
            $myads = route( 'showMyAds' );
            foreach( $ads as $ad ){
                $adLink = route('ad_detail_page_slug', [ 'adId' => $ad->id, 'title' => $ad->title_slug, 'kind' => $ad->adKind->title_slug ] );
                
                $arrayToSend = array('customer' => $ad->adUser->name, 'Title_of_add' => $ad->title, 
                                            'link' => $adLink, 'my_ads' => $myads );
                Mail::send( 'mailtemplates.ad_almost_expire' , $arrayToSend, function( $message ) use( $ad ) {
                    $message->to( $ad->adUser->email );
                    $message->subject( 'Deze advertentie gaat binnenkort offline' );
                } );
            }

            // now send ad to those whose Ad has expired now.
            $dateOfExpire = date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
            $ads = Ad::where( 'expires_on', '=', $dateOfExpire )->with(['adUser','adKind'])->get();
            $ad_new = route( 'createad_showkinds' );
            foreach( $ads as $ad ){
                $adLink = route('ad_detail_page_slug', [ 'adId' => $ad->id, 'title' => $ad->title_slug, 'kind' => $ad->adKind->title_slug ] );
                $arrayToSend = array('customer' => $ad->adUser->name, 'Title_of_add' => $ad->title, 
                                            'link' => $adLink, 'ad_new' => $ad_new );
                Mail::send( 'mailtemplates.ad_expired' , $arrayToSend, function( $message ) use( $ad ) {
                    $message->to( $ad->adUser->email );
                    $message->subject( 'Deze advertentie is offline' );
                } );
            }

        })->daily();

        // below for testing
        // $schedule->call(function () { 
        //     $arrayToSend = array('title_of_add' => 'test title', 'seller_name' => 'seller name');
        //     Mail::send( 'mailtemplates.testtemplate' , $arrayToSend, function( $message ) {
        //         $message->to( 'sunny.sahijwani@gmail.com' );
        //         $message->subject( 'cron mail every minute' );
        //     } );
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
