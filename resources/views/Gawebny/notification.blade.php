<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('notification.notifications') }}
@endsection
@section('header')
@endsection
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@section('content')
<div class="container-custom">
  <div class="ui-block">
    <h6 class="my-4">{{ trans('notification.all_notifications') }}</h6>
    <hr>
    
    @if(!Auth::user()->notifications->isEmpty())

    @foreach (Auth::user()->notifications()->take(5)->get()  as $n)
    @if ($n->type == 'App\Notifications\NewAnswer')
    <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item">
     <strong> {{ trans('layout.new_question') }} {{str_limit($n->data['title'] , 10)}} </strong>  
     <small> {{$n->created_at->diffForHumans()}} </small>
   </a>
   @endif
   @if ($n->type == 'App\Notifications\NewUser')
   <a class="dropdown-item">{{ trans('layout.wellcome') }}</a>
   @endif
   @if ($n->type == 'App\Notifications\NewQUpvote')
   <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item">
     <strong> {{ trans('layout.new_upvote') }} {{str_limit($n->data['title'] , 10)}} </strong>  
     <small> {{$n->created_at->diffForHumans()}} </small>
   </a>          
   @endif
   @if ($n->type == 'App\Notifications\NewMention')
   <a href="{{ url('/question/'.$n->data['question_id'].'#comment'.$n->data['id'] )}}" class="dropdown-item">
     <strong> {{\App\User::find($n->data['user_id'])->name}} {{ trans('layout.new_mention') }} {{strip_tags(str_limit($n->data['body'] , 10))}} </strong>  
     <small> {{$n->created_at->diffForHumans()}} </small>
   </a>          
   @endif
   @endforeach
   @else
   <a class="dropdown-item">{{ trans('layout.no_notification') }}</a>
   @endif
 </div>
</div>
<!-- /.container -->
<!-- The Modal -->
@endsection
@section('footer')
@endsection