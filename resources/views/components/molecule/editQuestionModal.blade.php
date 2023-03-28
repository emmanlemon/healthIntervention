<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Survey</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url("survey/edit/".$surveys[0]->survey_id) }}" method="post" enctype="multipart/form">
              @method('PUT')
              @csrf
                <div class="form-group">
                  <label>Title:</label>
                  <input type="text" name="title" value="{{ $surveys[0]->title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Decription:</label>
                    <input type="text" name="description" value="{{ $surveys[0]->description }}" class="form-control">
                  </div>
                <div class="form-group">
                    <label for="">Choices:</label>
                    @foreach($surveyQuestion->questions as $key => $question)
                    <input name="questionId[]" type="hidden" value="{{ $question->id }}"> 
                    {{-- {{ $key + 1 }}. --}}
                    <input type="text" name="question[]" value="{{ $question->question }}" class="form-control" style="margin-top: 8px;">
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
              </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>