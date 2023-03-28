<div class="modal fade" id="addSurvey" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Survey</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/survey') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <h3 for="">Header:</h3>
                <input type="text" name="title">
                <h5 for="">Description:</h5>
                <input type="text" name="description">
                @csrf
                <div class="col s12" x-data = "{questionsNumber:2}">
                    <template x-for="i in questionsNumber">
                        <div class="col">
                            <h4>Title:
                                <button x-on:click="questionsNumber > 2 ? questionsNumber-- : alert('Survey must has at least 2 question')" type="button" class="btn btn-danger">
                                    Remove
                                </button>
                            </h4>
                                <input type="text" name="questions[][question]" required>
                    <div class="col s12">
                        <p>
                            <label>
                                <input name="options[]" type="radio"/>
                                <span>Strongly Not Agree</span>
                            </label>
                            </p>
                            <p>
                            <label>
                                <input name="options[]" type="radio" />
                                <span>Not Agree</span>
                            </label>
                             </p>
                            <p>
                            <label>
                                <input name="options[]" type="radio"  />
                                 <span>Nuetral</span>
                            </label>
                            </p>
                            <p>
                            <label>
                                <input name="options[]" type="radio"/>
                                <span>Agree</span>
                            </label>
                            </p>
                            <p>
                                <label>
                                    <input name="options[]" type="radio"/>
                                    <span>Strongly Agree</span>
                                </label>
                                </p>
                    </div> 
            
                            {{-- <div class="col s12" x-data = "{optionsNumber:2}">
                                <h4>Options</h4>
                                <template x-for="i in optionsNumber">
                                    <div class="col">
                                        <input type="text" name="options[][content]">
                                        <button x-on:click="optionsNumber > 2 ? optionsNumber-- : alert('poll must has at least 2 options')" type="button" class="btn btn-info">
                                            Remove
                                        </button>
                                    </div>
                                </template>       
                                <button x-on:click="optionsNumber++" type="button" class="btn btn-info"> Add Option </button>
                               </div> --}}
                        </div>
                     </template>
                     <div class="col" style="padding-top: 30px; padding-bottom: 10px; float:left;">
                        <button x-on:click="questionsNumber++" type="button" class="btn btn-info"> Add Question </button>
                        <button type="submit" id="save" type="button" class="btn btn-info"> Submit</button>
                     </div>
                 </div>
            
                 {{-- <div class="row col s12" x-data = "{optionsNumber:2}">
                     <h4>Options</h4>
                     <template x-for="i in optionsNumber">
                         <div class="col ">
                             <input type="text" name="options[][content]">
                             <button x-on:click="optionsNumber > 2 ? optionsNumber-- : alert('poll must has at least 2 options')" type="button" class="btn btn-info">
                                 Remove
                             </button>
                         </div>
                     </template>
            
                     <button x-on:click="optionsNumber++" type="button" class="btn btn-info"> Add Button </button>
                     <button type="submit" id="save" type="button" class="btn btn-info"> Submit</button>
                     <button type="reset" name="reset" type="button" class="btn btn-danger"> Reset</button>
                    </div> --}}
            
             </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
