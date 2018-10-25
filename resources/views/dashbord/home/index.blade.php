@extends('dashbord/layouts/layout')
@section('title')
Dashboard
@endsection
@section('header')
@endsection
@section('contant_title')
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">
			Dashboard
			</h3>
		</div>
		<div>
			<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
				<span class="m-subheader__daterange-label">
					<span class="m-subheader__daterange-title">Today:</span>
					<span class="m-subheader__daterange-date m--font-brand"> {{\Carbon\Carbon::now()->format('d M')}}</span>
				</span>
			</span>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="m-portlet ">
	<div class="m-portlet__body  m-portlet__body--no-padding">
		<div class="row m-row--no-padding m-row--col-separator-xl">
			<div class="col-md-12 col-lg-6 col-xl-4">
				<!--begin::New Feedbacks-->
				<div class="m-widget24">
					<div class="m-widget24__item">
						<h4 class="m-widget24__title">
						All Useres
						</h4>
						<br>
						<span class="m-widget24__stats m--font-info">
							{{$allUser}}
						</span>
						<div class="m--space-10"></div>
					</div>
				</div>
				<!--end::New Feedbacks-->
			</div>
			<div class="col-md-12 col-lg-6 col-xl-4">
				<!--begin::New Orders-->
				<div class="m-widget24">
					<div class="m-widget24__item">
						<h4 class="m-widget24__title">
						All Answers
						</h4>
						<br>
						<span class="m-widget24__stats m--font-danger">
							{{$allAnswer}}
						</span>
						<div class="m--space-10"></div>
					</div>
				</div>
				<!--end::New Orders-->
			</div>
			<div class="col-md-12 col-lg-6 col-xl-4">
				<!--begin::New Users-->
				<div class="m-widget24">
					<div class="m-widget24__item">
						<h4 class="m-widget24__title">
						All Questions
						</h4>
						<br>
						<span class="m-widget24__stats m--font-success">
							{{$allQuestion}}
						</span>
						<div class="m--space-10"></div>
					</div>
				</div>
				<!--end::New Users-->
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-7">
		<!--begin:: Widgets/Support Tickets -->
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
						Last Questions
						</h3>
					</div>
				</div>
			</div>
			{{-- expr --}}
			<div class="m-portlet__body">
				@foreach ($lastQuestions as $q)
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
							@if ($q->answer->count() != 0)
							<span class="m-widget3__status m--font-info">
								{{$q->answer->count()}}Answers
							</span>
							@else
							<span class="m-widget3__status m--font-danger">
								NoAnswers
							</span>
							@endif
							
						</div>
						<div class="m-widget3__body">
							<p class="m-widget3__text">
								{{$q->title}}
							</p>
						</div>
					</div>
				</div>
				<hr>
				@endforeach
			</div>
		</div>
		<!--end:: Widgets/Support Tickets -->
	</div>
	<div class="col-xl-5">
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
						New Users
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="m_widget4_tab1_content">
						<!--begin::Widget 14-->
						<div class="m-widget4">
							@foreach($lastUsers as $user)
							<div class="m-widget4__item">
								<div class="m-widget4__img m-widget4__img--pic">
									<img src="{{ asset('Gawebny/img/'.$user->image) }}" alt="">
								</div>
								<div class="m-widget4__info">
									<span class="m-widget4__title">
										{{$user->name}}
									</span>
									<br>
									<span class="m-widget4__sub">
										{{$user->jop}}
									</span>
								</div>
								<div class="m-widget4__ext">
									<a href="{{ url('dashbord/users/'.$user->id) }}" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
										view
									</a>
								</div>
							</div>
							@endforeach
						</div>
						<!--end::Widget 14-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6">
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
						Top Caegories
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="m_widget11_tab1_content">
						<div class="m-widget11">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<td class="m-widget11__app">
												category
											</td>
											<td class="m-widget11__sales">
												question count
											</td>
										</tr>
									</thead>
									<tbody>
										@foreach($TopCategories as $cat )
										<tr>
											<td>
												<span class="m-widget11__title">
													{{$cat->name_en}}
												</span>
											</td>
											<td>
												{{$cat->question_count}}
											</td>
											
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="m-widget11__action m--align-right">
								<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
								View All
								</button>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_widget11_tab2_content">
						<!--begin::Widget 11-->
						<div class="m-widget11">
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table">
									<!--begin::Thead-->
									<thead>
										<tr>
											<td class="m-widget11__label">
												#
											</td>
											<td class="m-widget11__app">
												Application
											</td>
											<td class="m-widget11__sales">
												Sales
											</td>
											<td class="m-widget11__change">
												Change
											</td>
											<td class="m-widget11__price">
												Avg Price
											</td>
											<td class="m-widget11__total m--align-right">
												Total
											</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
													<input type="checkbox">
													<span></span>
												</label>
											</td>
											<td>
												<span class="m-widget11__title">
													Loop
												</span>
												<span class="m-widget11__sub">
													CRM System
												</span>
											</td>
											<td>
												19,200
											</td>
											<td>
												$63
											</td>
											<td>
												$11,300
											</td>
											<td class="m--align-right m--font-brand">
												$34,740
											</td>
										</tr>
										<tr>
											<td>
												<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
													<input type="checkbox">
													<span></span>
												</label>
											</td>
											<td>
												<span class="m-widget11__title">
													Selto
												</span>
												<span class="m-widget11__sub">
													Powerful Website Builder
												</span>
											</td>
											<td>
												24,310
											</td>
											<td>
												$39
											</td>
											<td>
												$14,700
											</td>
											<td class="m--align-right m--font-brand">
												$46,010
											</td>
										</tr>
										<tr>
											<td>
												<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
													<input type="checkbox">
													<span></span>
												</label>
											</td>
											<td>
												<span class="m-widget11__title">
													Jippo
												</span>
												<span class="m-widget11__sub">
													The Best Selling App
												</span>
											</td>
											<td>
												9,076
											</td>
											<td>
												$105
											</td>
											<td>
												$8,400
											</td>
											<td class="m--align-right m--font-brand">
												$67,800
											</td>
										</tr>
										<tr>
											<td>
												<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
													<input type="checkbox">
													<span></span>
												</label>
											</td>
											<td>
												<span class="m-widget11__title">
													Verto
												</span>
												<span class="m-widget11__sub">
													Web Development Tool
												</span>
											</td>
											<td>
												11,094
											</td>
											<td>
												$16
											</td>
											<td>
												$12,500
											</td>
											<td class="m--align-right m--font-brand">
												$18,520
											</td>
										</tr>
									</tbody>
									<!--end::Tbody-->
								</table>
								<!--end::Table-->
							</div>
							<div class="m-widget11__action m--align-right">
								<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
								Generate Report
								</button>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_widget11_tab3_content"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-6">
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
						Site Information
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="m-widget13">
					<div class="m-widget13__item">
						<span class="m-widget13__desc m--align-right">
							Website Name :
						</span>
						<span class="m-widget13__text m-widget13__text-bolder">
							{{$settings->where('name' ,'sitename_en')->first()->value}}
						</span>
					</div>
					<div class="m-widget13__item">
						<span class="m-widget13__desc m--align-right">
							Website Discreption :
						</span>
						<span class="m-widget13__text">
							{{$settings->where('name' ,'dis_en')->first()->value}}
						</span>
					</div>
					<div class="m-widget13__item">
						<span class="m-widget13__desc m--align-right">
							Emal:
						</span>
						<span class="m-widget13__text">
							{{$settings->where('name' ,'email')->first()->value}}
						</span>
					</div>
					<div class="m-widget13__item">
						<span class="m-widget13__desc m--align-right">
							Facebook:
						</span>
						<span class="m-widget13__text m-widget13__number-bolder m--font-brand">
							{{$settings->where('name' ,'facebook')->first()->value}}
						</span>
					</div>
					<div class="m-widget13__action m--align-right">
						<a href="{{ url('/dashbord/setting') }}">
							<button type="button" class="btn m-btn--pill    btn-secondary">
							Update
							</button>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Company Summary-->
	</div>
</div>
<div class="m-portlet m-portlet--tab">
	<div class="m-portlet m-portlet--tab">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon m--hide">
						<i class="la la-gear"></i>
					</span>
					<h3 class="m-portlet__head-text">
					Categories share percantage
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
		<center>	all Questions : {{$allQuestion}} </center>
			<div id="m_flotcharts_9" style="height: 500px;"></div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript" src="{{ asset('assets/vendors/custom/flot/flot.bundle.js') }}" ></script>
<!--script type="text/javascript" src="{{-- asset('assets/app/js/dashboard.js') --}}" ></script-->
<script type="text/javascript">
	
	jQuery(document).ready(function () {
		$.plot($("#m_flotcharts_9"),[
			@foreach (\App\Category::percantage() as $key =>$cat)
			{
				label: '{{$cat['name']}}',
				data: {{$cat['value']}}
			},
			@endforeach
			], {
				series: {
					pie: {
						show: !0
					}
				},
				legend: {
					show: !1
				}
			})
	});
</script>
@endsection