@extends('front/layout/emailLayout')

@section('container')

Hoi {{$seller_name}},<br /><br />

Iemand heeft je een vraag gesteld over de volgende advertentie: <br /><br />

{{ $title_of_add }} ( {{ $link }} )

Bericht: <br /><br />

{{$msg}}
<br /><br />
Klik hier om een bericht terug te sturen {{ $link_to_message_back }}

@endsection