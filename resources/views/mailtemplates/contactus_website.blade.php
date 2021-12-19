@extends('front/layout/emailLayout')

@section('container')

Hoi admin,<br /><br />

Er is een bericht verstuurd<br /><br />

Klantnaam: {{$name}} <br />
Datum: {{$date}} <br />
Email: {{$email}} <br />
Bericht: {{$msg}} <br />

@endsection