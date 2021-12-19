@extends('front/layout/emailLayout')

@section('container')

Hoi {{$customer}},<br /><br />

Je advertentie staat online.  <br />

{{$title_of_add}}  {{$link}}<br /><br />

Wanneer je graag een niewue advertentie plaats klik dan hier. {{$link_to_new_ad}} <br />

Bekijk je profiel en je berichten via deze link {{$link_to_profile}}<br />

@endsection