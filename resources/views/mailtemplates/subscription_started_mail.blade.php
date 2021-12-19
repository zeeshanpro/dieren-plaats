@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}}, <br /><br />

Bedankt voor je aanmelding op onze site.<br /><br />

Samen creeren we veilig platform voor het vinden van de juiste baasjes. <br />
En uiteraard voor de baasjes de juiste verkopers. <br /><br />

Geniet van de voordelen van onze site: <br />
- Onbeperkt aantal advertenties<br />
- Database van beoordeelde Fokkers<br />
- Wachtlijst optie <br /><br />

Abonnement wordt maandelijk vernieuwd voor een vast bedrag a €{{$monthly_fee}} p.m.

@endsection