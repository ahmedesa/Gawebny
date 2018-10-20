<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('contact.contact') }}
@endsection
@section('header')
@endsection
@section('content')
<div class="container-custom">
	<div class="ui-block">
		<div class="container contact-form">
			<div class="contact-image">
				<img src="{{ asset('Gawebny/img/rocket_contact.png') }}" alt="rocket_contact"/>
			</div>
			<form method="post" action="{{ url('/contact') }}">
				@csrf
				<h3>{{ trans('contact.Drop_Us_a_Message') }}</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="{{ trans('contact.Your_Name') }}" value="" />
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="{{ trans('contact.Your_Email') }}" value="" />
						</div>
						<div class="form-group">
							<input type="submit" class="btnContact" value="{{ trans('contact.Send_Message') }}" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<textarea name="message" class="form-control" placeholder="{{ trans('contact.Your_Message') }}" style="width: 100%; height: 150px;"></textarea>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section('footer')
@endsection