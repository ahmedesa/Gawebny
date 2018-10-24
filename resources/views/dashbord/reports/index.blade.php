@extends('dashbord/layouts/layout')
@section('title')
Reports
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
			<a  class="m-nav__link">
				<span class="m-nav__link-text">
					Reports
				</span>
			</a>
		</li>
	</ul>
</div>
@endsection
@section('content')
<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__body">
		<!--begin: Search Form -->
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
			<div class="row align-items-center">
				<div class="col-xl-8 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-4">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end: Search Form -->
		<!--begin: Datatable -->
		<table class="m-datatable" id="html_table" width="100%">
			<thead>
				<tr>
					<th title="Field #1">
						report ID
					</th>
					<th title="Field #8">
						reporter Name
					</th>
					<th title="Field #2">
						report type
					</th>
					<th title="Field #2">
						detailes
					</th>
					<th title="Field #2">
						sented_at
					</th>
					<th title="Field #2">
						state
					</th>
					<th title="Field #10">
						Action
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reports as $r)
				<tr>
					<td>
						{{$r->id}}
					</td>
					<td>
						<a href="{{ url('dashbord/users/'.$r->user_id) }}" >{{$r->user->name}}</a>
					</td>
					<td>
						{{$r->type}}
					</td>
					<td>
						{{str_limit($r->details ,20).'.........'}}
					</td>
					<td>
						{{$r->created_at->diffForHumans()}}
					</td>
					<td>
						@if($r->seen == false)
						<span class="m-badge  m-badge--danger m-badge--wide">
							not seen
						</span>
						@elseif($r->seen == true)
						<span class="m-badge m-badge--accent m-badge--wide">
							seen
						</span>
						@endif
					</td>
					<td>
						<span style="overflow: visible; width: 110px;">
							<a href="{{ url('/dashbord/reports/'.$r->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
								<i class="fa fa-eye"></i>
							</a>
							<a href="{{ url('/dashbord/reports/'.$r->id.'/delete') }}" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill cat-remove" data-id="1" title="Delete">
								<i class="la la-trash"></i>
							</a>
						</span>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<!--end: Datatable -->
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	var DatatableHtmlTableDemo=function(){
		var e=function(){
			$(".m-datatable").mDatatable({search:{input:$("#generalSearch")},columns:[{field:"Deposit Paid",type:"number"},{field:"Order Date",type:"date",format:"YYYY-MM-DD"}]})};return{init:function(){e()}}}();jQuery(document).ready(function(){DatatableHtmlTableDemo.init()});
</script>
@endsection