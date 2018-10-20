<footer class="footer">
	<div class="container">
		<ul class="foote_bottom_ul_amrc">
			<li><a href="{{ url('/terms') }}">{{ trans('layout.terms') }}</a></li>
			<li><a href="{{ url('/contact ') }}">{{ trans('layout.Contact_Us') }}</a></li>
		</ul>
		<!--foote_bottom_ul_amrc ends here-->
		<p class="text-center">Copyright 2018  |  {{\App\SiteSetting::CopyRight()}} </p>

		<ul class="social_footer_ul">
			<li><a href="{{\App\SiteSetting::where('name' ,'facebook')->first()->value}}"><i class="fa fa-facebook"></i></a></li>
			<li><a href="{{\App\SiteSetting::where('name' ,'twitter')->first()->value}}"><i class="fa fa-twitter"></i></a></li>
		</ul>
		<!--social_footer_ul ends here-->
	</div>

</footer>
