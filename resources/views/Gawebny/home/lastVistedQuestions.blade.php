@if ($history_questions)
	<div class="panel panel-default">
        <div class="panel-body">
            Recent viewed questions:
            @foreach ($history_questions as $hs)
            
            	<a href="{{ url($hs->slug) }}">{{$hs->title}}</a>
            @endforeach
        </div>
    </div>
@endif