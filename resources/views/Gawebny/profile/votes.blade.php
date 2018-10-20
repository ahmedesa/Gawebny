@extends('Gawebny.profile.layout')
@section('profile_content')
{{--
@foreach($saved_questions as $q)
<div class="ui-block alert alert-dismissible fade show" >
	<article class="hentry post">
		<div class="m-link">
			<a href="{{ url('/question/'.$q->id.'/'.str_slug($q->title)) }}"  >
				<h4>{{$q->title}}</h4>
			</a>
			<div class="more">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="post-additional-info inline-items">
			<div class="container" >
				<div class="row">
					<div class="col-sm-4">
						<div class="row">
							<div class="col-sm-3" >
								<div>
									{{$q->views}}<br>
									views
								</div>
							</div>
							<div class="col-sm-3">
								<div>
									{{$q->votes}}<br>
									votes
								</div>
							</div>
							<div class="col-sm-3">
								<div>
									{{$q->answer->count()}}<br>
									answers
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						@foreach ($q->category as $cat)
						<button class="btn  btn-default btn-sm"  style=" color: #3490dc;" onclick="location.href = '{{ url('/category/'.$cat->name) }}';">{{$cat->name}}</button>
						@endforeach
					</div>
					<div class="col-sm-3">
						<small> {{$q->created_at->diffForHumans()}} 
							by   <a class=" post__author-name fn" 
							href="{{$q->anonymous == 1 ? '#' : url('profile/'.$q->user->id)  }}">
							{{$q->anonymous == 1 ? 'anonymous' : $q->user->name }}
						</a>
					</small>

				</div>          
			</div>
		</div>
	</div>
</article>
</div>
@endforeach
--}}
aaaaaaaaaaaaaaaaadskj
@endsection