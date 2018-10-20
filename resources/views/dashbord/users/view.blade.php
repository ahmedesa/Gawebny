@extends('dashbord/layouts/layout')
@section('title')
"{{$user->name}}"
@endsection
@section('header')
@endsection
@section('contant_title')
<div class="mr-auto">
	<h3 class="m-subheader__title m-subheader__title--separator">
		Users
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
			<a href="{{ url('/dashbord/users') }}" class="m-nav__link">
				<span class="m-nav__link-text">
					Users
				</span>
			</a>
		</li>
		<li class="m-nav__separator">
			-
		</li>
		<li class="m-nav__item">
			<a  class="m-nav__link">
				<span class="m-nav__link-text">
					"{{$user->name}}"
				</span>
			</a>
		</li>
	</ul>
</div>
@endsection
@section('content')
<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__body">
		
		<div class="m-section">
			<div class="row align-items-center">
				<div class="col-xl-8 order-2 order-xl-1">
					<h3 class="m-section__heading">
						Time Line
					</h3>
				</div>
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
					<a href="{{ url('profile/'.$user->id) }}">
						<button type="button" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" >
							<span>
								<i class="fa  fa-user "></i>
								<span>
									view user profile
								</span>
							</span>
						</button>
					</a>
				</div>
			</div>
		</div>
		<div class="m-section__content">
			<!--begin::Preview-->
			<div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
				<div class="m-demo__preview">
					<div class="m-list-timeline">
						<div class="m-list-timeline__items">
							<div class="m-list-timeline__item">
								<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
								<span class="m-list-timeline__text">
									create the account
									<span class="m-badge m-badge--success m-badge--wide">
										Create Account
									</span>
								</span>
								<span class="m-list-timeline__time">
									{{$user->created_at->diffForHumans()}}
								</span>
							</div>
							@if($user->question->first())
							<div class="m-list-timeline__item">
								<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
								<span class="m-list-timeline__text">
									{{$user->question->first()->title}}
									<span class="m-badge m-badge--warning  m-badge--wide">
										First Question
									</span>
								</span>
								<span class="m-list-timeline__time">
									{{$user->question->first()->created_at->diffForHumans()}}
								</span>
							</div>
							@endif
							@if($user->answer->first())
							<div class="m-list-timeline__item">
								<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
								<span class="m-list-timeline__text">
									{{strip_tags($user->answer->first()->body)}}
									<span class="m-badge m-badge--info m-badge--wide">
										First answer
									</span>
								</span>
								<span class="m-list-timeline__time">
									{{$user->answer->first()->created_at->diffForHumans()}}
								</span>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="m-section">
			<h3 class="m-section__heading">
				Edit User
			</h3>
			<div class="m-section__content">
				<form action="{{ url('user/admin/'.$user->id) }}" method="POST">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="col-3">
							user permation
						</div>
						<div class="col-5">
							<div class="form-group m-form__group">
								<select class="form-control m-input m-input--air" name="admin">
									<option {{$user->admin == 0 ?'selected ="selected"' :''}} value="0">
										user
									</option>
									<option {{$user->admin == 1 ?'selected ="selected"' :''}} value ="1">
										admin
									</option>
								</select>
							</div>
						</div>

						<div class="col-4">
							<button type="submit" class="btn btn-accent">
								Save
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="m-section">
			<h3 class="m-section__heading">
				User Information
			</h3>
			<div class="m-section__content">
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item ">
						<a class="nav-link active" data-toggle="tab" href="#m_tabs1">
							All Questions <span class="m-badge m-badge--danger">{{$user->question->count()}}</span>
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#m_tabs2">
							All Answers <span class="m-badge m-badge--danger">{{$user->answer->count()}}</span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="m_tabs1" role="tabpanel">
						<div class="m-portlet__body">
							@foreach ($user->question as $q)
							<div class="m-widget3">
								<div class="m-widget3__item">
									<div class="m-widget3__header">
										<div class="m-widget3__user-img">
											<img class="m-widget3__img" src="{{ asset('Gawebny/img/'.$q->user->image) }}" alt="">
										</div>
										<div class="m-widget3__info">
											<span class="m-widget3__username">
												{{$q->user->name}}
											</span>
											<br>
											<span class="m-widget3__time">
												{{$q->created_at->diffForHumans()}}
											</span>
										</div>
									</div>
									<div class="m-widget3__body">
										<p class="m-widget3__text">
											<a href="{{ url('question/'.$q->id) }}">{{$q->title}}</a>
										</p>
									</div>
								</div>
							</div>
							<hr>
							@endforeach
						</div>
					</div>
					<div class="tab-pane" id="m_tabs2" role="tabpanel">
						<div class="tab-pane active" id="m_tabs1" role="tabpanel">
							<div class="m-portlet__body">
								@foreach ($user->answer as $ans)
								<div class="m-widget3">
									<div class="m-widget3__item">
										<div class="m-widget3__header">
											<div class="m-widget3__user-img">
												<img class="m-widget3__img" src="{{ asset('Gawebny/img/'.$ans->user->image) }}" alt="">
											</div>
											<div class="m-widget3__info">
												<span class="m-widget3__username">
													{{$ans->user->name}}
												</span>
												<br>
												<span class="m-widget3__time">
													{{$ans->created_at->diffForHumans()}}
												</span>
											</div>
										</div>
										<div class="m-widget3__body">
											<p class="m-widget3__text">
												<a href="{{ url('question/'.$ans->question->id) }}">
													{{str_limit($ans->body,50)}}
												</a>
											</p>
										</div>
									</div>
								</div>
								<hr>
								@endforeach
							</div>
						</div>						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end: Datatable -->
	</div>
</div>
@endsection
@section('footer')