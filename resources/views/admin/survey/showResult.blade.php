<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
                    <title>Admin Result Survey</title>
                </head>
                @extends('components.atom.index')
                @extends('components.molecule.sideBarNavigation')
                @section('sideBarNavigation')
                <section class="home-section" style="background-image: url('../images/PSU_background.jpg'); background-size: cover;">
                    <div class="text">Admin Result Survey<i class='bx bx-bar-chart'></i>
                        <a href="{{ url('/page/printresult/survey/'.$survey->id) }}" class="btn btn-primary" target="_blank"><i class='bx bx-printer'></i> Print Result Survey</a>
                    </div>
                    <div class="container" style="width: 95%; background-color: white; padding: 10px; box-shadow: 1px 1px 1px black; border-radius: 10px;">
                        <div class="header-response">
                            <h3>Title: {{ $survey->title }}</h3>
                            <h3>Description: {{ $survey->description }}</h3>
                            <h3>Created At: {{ date('F j, Y, g:i a', strtotime($survey->created_at)) }} , {{ \Carbon\Carbon::parse($survey->created_at)->diffForHumans() }}</h3>
                            <h3>Respondent : {{ $surveyResponse->count() }} Students</h3>
                        </div>
                    <h4>Questions:</h4>
                    @foreach ($answer as $day => $students_list)
                    <div class="container-survey" style="background-color: #f4f6fc93; padding:5px; margin: 10px; text-transform:capitalize; box-shadow: 1px 1px 1px black; border-radius: 5px;">
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
                      <table class="table-response">
                        
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
                </div>
                </section>
                @endsection
                <body>
                </html>
                