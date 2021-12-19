@extends('front/layout/emailLayout')

@section('container')

Hoi {{$name}},<br /><br />

Welkom bij Dieren-Plaats.nl! Leuk dat jullie je aansluiten bij onze database. <br />

Om in te loggen op onze website, gebruik je deze gegevens:<br /><br />

E-mail: {{$email}}<br />
Wachtwoord: Opgegeven wachtwoord tijdens aanmaken van account<br /><br />

Wachtwoord vergeten? Klik <a href="{{$FORGETLINK}}">hier</a> om het opnieuw in te stellen.<br /><br />

@endsection