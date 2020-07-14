<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('')}}">
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="admin_asset/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="admin_asset/css/animate.css">
    
    <link rel="stylesheet" href="admin_asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="admin_asset/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="admin_asset/css/magnific-popup.css">

    <link rel="stylesheet" href="admin_asset/css/aos.css">

    <link rel="stylesheet" href="admin_asset/css/ionicons.min.css">

    <link rel="stylesheet" href="admin_asset/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="admin_asset/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="admin_asset/css/flaticon.css">
    <link rel="stylesheet" href="admin_asset/css/icomoon.css">
    <link rel="stylesheet" href="admin_asset/css/style.css">

    @yield('csslink')

    @yield('style')

</head>
<body>
	{{-- menu --}}
	@include('layouts.menu')
	{{-- end menu --}}

	{{-- content --}}
	@yield('content')
	{{-- end content --}}

	{{-- footer --}}
	@include('layouts.footer')
	{{-- end footer --}}

	{{-- loader --}}
	@include('layouts.loader')
	{{-- end loader --}}

  <script src="admin_asset/js/jquery.min.js"></script>
  <script src="admin_asset/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="admin_asset/js/popper.min.js"></script>
  <script src="admin_asset/js/bootstrap.min.js"></script>
  <script src="admin_asset/js/jquery.easing.1.3.js"></script>
  <script src="admin_asset/js/jquery.waypoints.min.js"></script>
  <script src="admin_asset/js/jquery.stellar.min.js"></script>
  <script src="admin_asset/js/owl.carousel.min.js"></script>
  <script src="admin_asset/js/jquery.magnific-popup.min.js"></script>
  <script src="admin_asset/js/aos.js"></script>
  <script src="admin_asset/js/jquery.animateNumber.min.js"></script>
  <script src="admin_asset/js/bootstrap-datepicker.js"></script>
  <script src="admin_asset/js/jquery.timepicker.min.js"></script>
  <script src="admin_asset/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="admin_asset/js/google-map.js"></script>
  <script src="admin_asset/js/main.js"></script>

  {{-- script --}}
  @yield('script')
  {{-- script --}}
  
</body>
</html>