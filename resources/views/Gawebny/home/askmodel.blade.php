    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ trans('layout.ask_question') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="Post" action="{{ url('question') }}" >
              @csrf
              <div class="form-group">
                <label for="recipient-name" required class="col-form-label">{{trans('layout.title')}}</label>
                <input name="title" type="text" required class="form-control" id="recipient-name" >
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">{{trans('layout.body')}}</label>
                <textarea name="body" required class="form-control" id="message-text"></textarea>
              </div>
              <div class="form-group">
                <label for="category-text" class="col-form-label">{{trans('layout.category')}}</label>
                <br>
                <select style="width: 300px" required class="category-multiple form-control " name="category[]" multiple="multiple">
                  @foreach ($categories as $cat)
                      <option value="{{$cat->id}}">{{$cat->name()}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="anonymous" value="1" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">   {{trans('layout.ask_anonymous')}}
                </label>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{trans('layout.ask')}}</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    