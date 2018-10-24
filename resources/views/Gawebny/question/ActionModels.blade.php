<!--Edit Model -->
<div class="modal fade" id="QuestionsModel" tabindex="-1" role="dialog" aria-labelledby="QuestionsModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('question.Edit') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ url('question/'.$question->id) }}" >
          @csrf
          @method('PUT')
          <div class="form-group">
            <label  class="col-form-label">{{ trans('question.edit_body') }}</label>
            <textarea name="body" required class="form-control" id="message-text">{{$question->body}}</textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('question.Edit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Question Report Model -->
<div class="modal fade" id="ReportModel" tabindex="-1" role="dialog" aria-labelledby="ReportModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.Report') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ url('/reprot') }}" >
          @csrf
          <div class="form-group">
            <label  class="col-form-label">{{ trans('profile.Report_Details') }}</label>
            <textarea name="details" required class="form-control"></textarea>
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <input type="hidden" name="type" value="question">
            <input type="hidden" name="reported_id" value="{{$question->id}}">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('profile.Report') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Answer Report Model -->
<div class="modal fade" id="ReportAnsModel" tabindex="-1" role="dialog" aria-labelledby="ReportAnsModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.Report') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ url('/reprot') }}" >
          @csrf
          <div class="form-group">
            <label  class="col-form-label">{{ trans('profile.Report_Details') }}</label>
            <textarea name="details" required class="form-control"></textarea>
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <input type="hidden" name="type" value="answer">
            <input type="hidden" id="AnsId" name="reported_id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('profile.Report') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>