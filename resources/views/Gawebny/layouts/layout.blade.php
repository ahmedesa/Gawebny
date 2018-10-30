<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')|{{\App\SiteSetting::name()}}</title>
<link rel="icon" href="{{ asset('Gawebny/img/'.Setting('logo')) }}">
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
	<script type="text/javascript">
		$(document).ready(function() {
			$(".NotList").click(function(){
                $.ajax({
                  url: '{{ url('/MarkAsREad') }}',
                  success: function() {
                    $(".NotCount").attr('data-count', '0');
                }
            });
            });

		});	
	</script>

 <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
 <script type="text/javascript">
    var notificationsWrapper   = $('.notificationsWrapper');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('.notification');
    var channelName             = {{Auth::id()}};
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('b948a1dfc499f62a98af', {
            cluster: 'eu',
            encrypted: true
        });
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('Notify');
        // Bind a function to a Event (the full Laravel class)
        channel.bind('send-message'+channelName, function(data) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `

            <a href="`+data.link+`" class="dropdown-item unRead">
            `+data.message+`

            <small> `+data.created_at+` </small>
            </a>

            `;
            notifications.html(newNotificationHtml + existingNotifications);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });
    </script>
    @yield('footer')
    @include('Gawebny.layouts.fmessage')
</body>
</html>