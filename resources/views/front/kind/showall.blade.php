@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endsection
@section('container')

@include( 'front.layout.components.middlemenu', [ 'iconstyle' => true, 'hideViewAll' => true ] )

@endsection