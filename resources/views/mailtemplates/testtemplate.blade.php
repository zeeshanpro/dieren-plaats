@extends('front/layout/emailLayout')

@section('container')

This Is Title Too Add "{{$title_of_add??''}}"
<br/>

My Name As A Seller Is {{$seller_name??''}}
@endsection