@extends('layouts.main')
@section('title','Home')

@section('content')

@auth
@include('partials/home-auth')
@endauth

@guest

 @include('partials/home-guest')
@endguest

@endsection
    