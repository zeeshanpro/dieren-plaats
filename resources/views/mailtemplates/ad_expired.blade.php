@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}},<br /><br />

Hierbij bevestigen we dat je advertentie offline is. <br /><br />

{{$Title_of_add}} ( {{$link}} ) <br /><br />

Wanneer je graag een niewue advertentie plaats klik dan hier. {{$ad_new}}<br />

@endsection