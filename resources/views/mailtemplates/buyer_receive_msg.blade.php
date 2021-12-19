@extends('front/layout/emailLayout')

@section('container')

Hoi {{$buyer_name}},<br /><br />

Je hebt een antwoord ontvangen over de volgende advertentie: <br /><br />

{{$title_of_add}} ( {{$link}} )<br />

Bericht: <br />

{{$msg}}<br /><br />

Klik hier om naar de chat te gaan. {{$link_to_message_back}}

@endsection