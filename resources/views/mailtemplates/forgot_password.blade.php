@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}}, <br /><br />

Er was onlangs een aanvraag gedaan om het wachtwoord van je account te wijzigen.<br /><br />

Als jij de aanvraag hebt ingediend dan kan je via onderstaande knop een nieuw wachtwoord aanmaken:<br /><br />

<a href="{{route('base_url')}}/reset-password/{{$token}}">NEW PASS BUTTON</a> <br /><br />

Indien je deze aanvraag niet hebt ingediend, kan je deze email negeren en zal het wachtwoord ongewijzigd blijven.

@endsection