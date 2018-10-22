@extends('dashbord/layouts/layout')
@section('title')
Site Settings
@endsection
@section('header')
@endsection
@section('contant_title')
<div class="mr-auto">
	<h3 class="m-subheader__title m-subheader__title--separator">
		Site Settings
	</h3>
	<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
		<li class="m-nav__item m-nav__item--home">
			<a href="{{ url('/dashbord') }}" class="m-nav__link m-nav__link--icon">
				<i class="m-nav__link-icon la la-home"></i>
			</a>
		</li>
		<li class="m-nav__separator">
			-
		</li>
		<li class="m-nav__item">
			<a href="#" class="m-nav__link">
				<span class="m-nav__link-text">
					Site Settings
				</span>
			</a>
		</li>
	</ul>
</div>
@endsection
@section('content')
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	@foreach ($errors->all() as $error)
	<div>{{ $error }}</div>
	@endforeach
</div>
@endif
<div class="m-portlet">
	
	<!--begin::Form-->
	<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" method="Post" action="{{ url('dashbord/setting') }}" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="m-portlet__body">
			<div class="form-group m-form__group row ">
				<label class="col-lg-2 col-form-label">
					Site main Language:
				</label>
				<div class="col-lg-10">
					<select class="form-control m-input m-input--air" name="lang">
						<option {{Setting('lang') == 'en' ?'selected ="selected"' :''}} value="en">
							english
						</option>
						<option {{Setting('lang') == 'ar' ?'selected ="selected"' :''}} value ="ar">
							arabic
						</option>
					</select>
					@if ($errors->has('lang'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('lang') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row ">
				<label class="col-lg-2 col-form-label">
					Site Name In English:
				</label>
				<div class="col-lg-10">
					<input class="form-control m-input m-input--air" required type="text" name="sitename_en" value="{{Setting('sitename_en')}}">
					@if ($errors->has('sitename_en'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('sitename_en') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Name In Arabic:
				</label>
				<div class="col-lg-10">
					<input class="form-control m-input m-input--air" type="text" required  name="sitename_ar" value="{{Setting('sitename_ar')}}" >
					@if ($errors->has('sitename_ar'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('sitename_ar') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Discrebtion In English
				</label>
				<div class="col-lg-10">
					<textarea required class="form-control m-input m-input--air" rows="3" name="dis_en" >{{Setting('dis_en')}} </textarea>
					<span class="m-form__help">
						when someone search for the site
					</span>
					@if ($errors->has('dis_en'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('dis_en') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Discrebtion In Arabic
				</label>
				<div class="col-lg-10">
					<textarea required class="form-control m-input m-input--air" rows="3"  name="dis_ar" >{{Setting('dis_ar')}}</textarea>
					<span class="m-form__help">
						when someone search for the site
					</span>
					@if ($errors->has('dis_ar'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('dis_ar') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Email:
				</label>
				<div class="col-lg-10">
					<input class="form-control m-input m-input--air" required  type="email" name="email" value="{{Setting('email')}}">
					<span class="m-form__help">
						website Main Email
					</span>
					@if ($errors->has('email'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Copyrights In English:
				</label>
				<div class="col-lg-10">
					<input required class="form-control m-input m-input--air" type="text" name="copyrights_en" value="{{Setting('copyrights_en')}}">
					@if ($errors->has('copyrights_en'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('copyrights_en') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Copyrights In Arabic:
				</label>
				<div class="col-lg-10">
					<input required class="form-control m-input m-input--air" type="text" name="copyrights_ar" value="{{Setting('copyrights_ar')}}">
					@if ($errors->has('copyrights_ar'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('copyrights_ar') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					FacebookLink:
				</label>
				<div class="col-lg-10">
					<input required class="form-control m-input m-input--air" type="text" name="facebook" value="{{Setting('facebook')}}">
					@if ($errors->has('facebook'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('facebook') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					TwitterLink:
				</label>
				<div class="col-lg-10">
					<input required class="form-control m-input m-input--air" type="text" name="twitter" value="{{Setting('twitter')}}">
					@if ($errors->has('twitter'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('twitter') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Terms In English
				</label>
				<div class="col-lg-10">
					<textarea class="summernote" name ="terms_en"> {{Setting('terms_en')}}</textarea>
					@if ($errors->has('terms_en'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('terms_en') }}</strong>
					</span>
					@endif
					
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Terms In Arabic
				</label>
				<div class="col-lg-10">
					<textarea required class="summernote" name ="terms_ar"> {{Setting('terms_ar')}}</textarea>
					@if ($errors->has('terms_ar'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('terms_ar') }}</strong>
					</span>
					@endif
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-10">
					<img style="max-width: 100px !important;" src="{{ asset('Gawebny/img/'.Setting('logo')) }}">
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-lg-2 col-form-label">
					Site Logo
				</label>
				<div class="col-lg-4">
					<input type="file" name="logo"  class="custom-file-input form-control m-input m-input--ai ">
					<span class="custom-file-control"></span>
					@if ($errors->has('logo'))
					<span class="form-control-feedback m--font-danger">
						<strong>{{ $errors->first('logo') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions--solid">
				<div class="row">
					<div class="col-lg-10">
						<button type="submit" class="btn btn-success">
							Save
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!--end::Form-->
</div>
@endsection
@section('footer')
<script src="{{ asset('/assets/demo/default/custom/components/forms/widgets/summernote.js') }}"></script>
@endsection