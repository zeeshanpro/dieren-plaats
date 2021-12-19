@extends('front/layout/emailLayout')

@section('container')

Dear Admin,
{{$name}} ( {{$email}} ) has contacted us and writes : - <br />
{{$msg}}

@endsection