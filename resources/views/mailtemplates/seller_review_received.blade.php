@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}},<br /><br />

Iemand heeft een review voor je achtergelaten: <br /><br />

Review sterren: {{$stars}}<br />

Review bericht {{$msg}}<br /><br />

Klik hier je profiel te bekijken op onze site. {{$seller_profile_link}}

@endsection