<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <link rel="stylesheet" style="text/css" href="{{ url('css/print.css') }}">
    <title>Print Survey</title>
</head>
<div class="container">
    <div class="header" style="display:flex; align-items:cente; justify-content:center">
        <img src="{{ url("../images/PSU_logo.png") }}" alt="" style="width: 80px; height: 80px; margin-right: 10px;">
        <div class="header-text" style="">
            <p>PANGASINAN STATE UNIVERSITY</p>
            <p>(SAN CARLOS CITY CAMPUS)</p>
            <p>Roxas Blvd. San Carlos City, Pangasinan</p>
        </div>
    </div>
    <section>
        <div class="header-survey" style="margin-bottom: 5px;">
            <h4>Name(Optional):</h4>
            <h4>Email(Optional):</h4>
            <h3>Title: {{ $printSurvey[0]->title }}</h3>
            <h4>Description: {{ $printSurvey[0]->description }}</h4>
            <h4>Created By: {{ $printSurvey[0]->name }}</h4>
            <h5>Created At: {{ date('F j, Y, g:i a', strtotime($printSurvey[0]->created_at)) }} , {{ \Carbon\Carbon::parse($printSurvey[0]->created_at)->diffForHumans() }}</h5>
        </div> 
        @foreach ($printSurvey as $key => $question)
        <div class="survey">
            
        </div>
        <div class="card-header" style="text-transform: capitalize;">
          {{ $key + 1 }}.
          {{ $question->question }}
        </div>
        <div class="radioQuestion">
          <label>
            <input style="font-size: 1em; color:black;" name="response[{{ $key }}][answer]" type="radio" value="Strongly Not Agree" required/>
            <span>Strongly Not Agree</span>
          </label>

          <label>
            <input name="response[{{ $key }}][answer]" type="radio" value="Not Agree" required/>
            <span>Not Agree</span>
          </label>

          <label>
            <input name="response[{{ $key }}][answer]" type="radio" value="Nuetral" required/>
            <span>Nuetral</span>
          </label>

          <label>
            <input name="response[{{ $key }}][answer]" type="radio" value="Agree" required/>
            <span>Agree</span>
          </label>

          <label>
            <input name="response[{{ $key }}][answer]" type="radio" value="Strongly Agree" required/>
            <span>Strongly Agree</span>
          </label>
        </div>
        @endforeach
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
           window.print();
});
</script>