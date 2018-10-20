<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('layout.terms') }}
@endsection
@section('header')
@endsection
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@section('content')
<div class="container-custom">
  <div class="ui-block">
    <h6 class="my-4">{{ trans('layout.all_terms') }}</h6>
    <hr>
    <div class="my-4"> 
      {{\App\SiteSetting::Terms()}}
    </div>
  </div>
</div>

@endsection
@section('footer')
@endsection