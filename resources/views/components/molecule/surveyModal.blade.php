<form action="{{ url('/survey') }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <h3 for="">Header:</h3>
    <input type="text" name="title">
    <h5 for="">Description:</h5>
    <input type="text" name="description">
    @csrf
    <div class="row col s12" x-data = "{questionsNumber:2}">
        <template x-for="i in questionsNumber">
            <div class="col ">
                <h4>Title:</h4>
                <input type="text" name="questions[][question]">
        <div class="col s12">
            <p>
                <label>
                    <input name="options[]" type="radio"/>
                    <span>Red</span>
                </label>
                </p>
                <p>
                <label>
                    <input name="options[]" type="radio" />
                    <span>Yellow</span>
                </label>
                 </p>
                <p>
                <label>
                    <input name="options[]" type="radio"  />
                     <span>Green</span>
                </label>
                </p>
                <p>
                <label>
                    <input name="options[]" type="radio"/>
                    <span>Brown</span>
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
         <div class="col" style="margin-top: 15px; float:right;">
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