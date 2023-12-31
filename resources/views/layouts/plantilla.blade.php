<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador</title>

  {{-- <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm" style="padding: 0px !important;">
<div class="wrapper" id="app">
  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}




   @yield('content')



  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
{{-- <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script> --}}
<script type="text/javascript">
  window.Laravel = {
      csrfToken: "{{ csrf_token() }}",
      jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}
  }
</script>

<script type="module" src="{{ mix('js/app.js') }}" ></script>
{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
{{-- <script type="module" src="{{ asset('js/lib/jquery.min.js') }}" ></script> --}}
{{-- <script src="{{ asset('js/jquery.commits-graph.js') }}" ></script> --}}



</body>
</html>
