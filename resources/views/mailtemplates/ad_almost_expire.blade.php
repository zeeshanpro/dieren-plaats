@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}},<br /><br />

Je advertentie wordt binnenkort offline gehaald<br /><br />

{{$Title_of_add}} ( {{$link}} ) <br /><br />

Wanneer dit niet klopt dan kan je via onderstaande knop de advertentie gratis verlengen<br /><br />

Advertentie verlengen -link to renew the ad-<br /><br />

Wil je de advertentie direct offline halen ? Klik dan hier {{$my_ads}}<br />


@endsection