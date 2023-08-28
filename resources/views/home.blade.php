@extends('layouts.plantilla')

@section('content')
@if (Auth::check())
<Inicio ruta="{{route('home')}}" :usuario="{{Auth::user()?Auth::user():0}}" />

@endif
@endsection
