@extends('dashbord/layouts/layout')
@section('title')
"{{str_limit($report->details ,10).'.......'}}"
@endsection
@section('header')
@endsection
@section('contant_title')
<div class="mr-auto">
	<h3 class="m-subheader__title m-subheader__title--separator">
		Reports
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
			<a href="{{ url('/dashbord/reports') }}" class="m-nav__link">
				<span class="m-nav__link-text">
					Reports
				</span>
			</a>
		</li>
		<li class="m-nav__separator">
			-
		</li>
		<li class="m-nav__item">
			<a  class="m-nav__link">
				<span class="m-nav__link-text">
					"{{str_limit($report->details ,10).'.......'}}"
				</span>
			</a>
		</li>
	</ul>
</div>
@endsection
@section('content')
<div class="m-portlet">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					From :<a href="{{ url('/dashbord/users/'.$report->user_id) }}"></a> {{$report->user->name}}
					<br>
					Type : {{$report->type}}
					<small >{{$report->created_at->diffForHumans()}}</small>
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="m-scrollable" data-scrollable="true" data-max-height="200">
			<p>
				{{$report->details}}
			</p>
			<div class="row">
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
					<a href="{{ $report->link() }}">
						<button type="button" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill " >
							<span>
								<i class="fa  fa-user "></i>
								<span>
									@if($report->type == 'user')
									view user profile
									@elseif($report->type == 'answer')
									view the answer
									@elseif($report->type == 'question')
									view the question
									@endif
								</span>
							</span>
						</button>
					</a>
				</div>
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
					<a href="{{ $report->delete() }}">
						<button type="button" class="btn btn-danger  m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill " >
							<span>
								<i class="la la-trash"></i>
								<span>

									@if($report->type == 'user')
									delete user profile
									@elseif($report->type == 'answer')
									delete the answer
									@elseif($report->type == 'question')
									delete the question
									@endif
								</span>
							</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection