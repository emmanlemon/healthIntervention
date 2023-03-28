<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <link rel="stylesheet" style="text/css" href="{{ url('css/print.css') }}">
    <title>Print Survey Result</title>
</head>
<style>
    @page {
    size: landscape;
  }
</style>
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
            <h3>Title: {{ $survey->title }}</h3>
            <h3>Description: {{ $survey->description }}</h3>
            <h3>Created At: {{ date('F j, Y, g:i a', strtotime($survey->created_at)) }} , {{ \Carbon\Carbon::parse($survey->created_at)->diffForHumans() }}</h3>
            <h3>Respondent : {{ $surveyResponse->count() }} Students</h3>
        </div>
    <h4>Questions:</h4>
    @foreach ($answer as $day => $students_list)
    <div class="container-survey" style="padding:5px; margin: 10px; text-transform:capitalize; box-shadow: 1px 1px 1px black; border-radius: 5px;">
        <h3>{{ $day }}</h3>
           @foreach ($students_list as $student)
                    @if(!empty($student->answer))
                    <p>{{ $student->answer}} - {{ $student->answerCount}}</p>
                    @else
                    <p>No One Answer this Question.</p>
                    @endif
            @endforeach    
    </div>
    @endforeach
    <table class="table-response" width="100%">
        @if(empty(count($surveyResponse)))
        <h4>No one answered the survey.</h4>
        @else
        <h4>Response : </h4>
        <thead>
            <tr>
                <th>Name</th>
                @foreach ($survey->questions as $question)
                <th>{{ $question->question }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
                @foreach ($surveyResponse as $user => $surveyResponse)
                <tr>
                    <td>{{ $user }}</td>
                    @foreach ($surveyResponse as $response)
                    <td>{{ $response->answer }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        @endif
    </table>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
           window.print();
});
</script>