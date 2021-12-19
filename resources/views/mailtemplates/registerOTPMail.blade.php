@extends('front/layout/emailLayout')

@section('container')

Hello, {{$name}} 

Your OTP for Email verification is {{$otp}}

@endsection