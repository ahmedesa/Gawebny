<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')|{{\App\SiteSetting::name()}}</title>
<link rel="icon" href="{{ asset('Gawebny/img/'.\App\SiteSetting::where('name' ,'logo')->first()->value) }}">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<link href="{{ asset('Gawebny/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet">
<link href="{{ asset('Gawebny/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/froala_editor.pkgd.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/froala_style.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

@if( Session::has('applocale') )
@if(Session::get('applocale') == 'ar') 
<link href="{{ asset('Gawebny/css/app_ar.css') }}" rel="stylesheet">
@endif 
@endif


<!-- Include Editor style. -->

<link href="{{ asset('css/default.min.css') }}" rel="stylesheet">
@yield('header')
<body>
	<!-- Navigation -->
	@include('Gawebny.layouts.nav')
	@include('Gawebny.home.askmodel')
	@yield('content')
	@include('Gawebny.layouts.footer')

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/alertify.min.js') }}"></script>
	<script src="{{ asset('js/froala_editor.min.js') }}"></script>
	<script src="{{ asset('js/froala_editor.pkgd.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.category-multiple').select2();
		});
	</script> 
	@yield('footer')
	@include('Gawebny.layouts.fmessage')
</body>
</html>