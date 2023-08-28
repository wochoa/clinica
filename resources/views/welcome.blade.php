<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro odontologico SD</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="layout-top-nav text-sm layout-fixed sidebar-collapse">
<div id="app" class="wrapper">

 



 
    @if (Auth::check())
    {{-- <Inicio ruta="{{route('inicio')}}" :usuario="{{Auth::user()?Auth::user():0}}" /> --}}
    <Paginainicio urlini="{{route('inicio')}}" :logeado="true" :usuario="{{Auth::user()?Auth::user():0}}"></Paginainicio>
    @else
    <Paginainicio urlini="{{route('inicio')}}" :logeado="false" :usuario="{{Auth::user()?Auth::user():0}}"></Paginainicio>
    @endif
    
  





</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script type="module" src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
