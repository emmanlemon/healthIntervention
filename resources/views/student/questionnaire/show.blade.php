<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Student Survey</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigationStudent')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/background-student.jpg'); background-size: cover;">
  <div class="text">Student Survey<i class='bx bx-bar-chart'></i>   
        {{-- <a href="{{ url('/page/print/survey/answer/'.$surveys[0]->survey_id) }}"target="_blank" class="printPage pull-right btn btn-primary"><i class='bx bxs-printer'></i> Print Answer</a> --}}
     </div>
    <div class="container" style="width: 95%; background-color: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 2px 2px 2px black;">
        <div class="row" style="padding: 20px;">
            <div class="header" style="margin-bottom: 30px;">
            <h3 class="text-capitalize">Title: {{ $surveys[0]->title }}</h3>
            <h4 class="text-capitalize">Description: {{ $surveys[0]->description }}</h4>
            <h4 class="text-capitalize">Created By: {{ $surveys[0]->name }}</h4>
            <h5 class="text-capitalize">Created At: {{ date('F j, Y, g:i a', strtotime($surveys[0]->created_at)) }} , {{ \Carbon\Carbon::parse($surveys[0]->created_at)->diffForHumans() }}</h5>
        </div>
        @if(Session::has('success'))
        <div class="m-5 alert alert-success">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
        <div class="m-5 alert alert-danger">{{ Session::get('error') }}</div>
        @endif
          <form action="{{ url('answer') }}" method="post" enctype="multipart/form">
            @csrf
            @foreach ($surveys as $key => $question)
            <input type="hidden" name="response[{{ $key }}][user_id]" value="{{ auth()->user()->id }}">
            <input type="hidden" name="response[{{ $key }}][survey_id]" value="{{ $question->survey_id }}">
            <input type="hidden" name="response[{{ $key }}][question_id]" value="{{ $question->id }}">
            <div class="card-header" style="text-transform: capitalize; font-size: 1.2em; ">
              {{ $key + 1 }}.
              {{ $question->question }}
            </div>
            <div class="radio" id="radio">
              <label>
                <input name="response[{{ $key }}][answer]" type="radio" value="Strongly Not Agree" required/>
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
                <div class="footer-btn" style="margin-top: 20px;">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                <button class="btn btn-primary" type="reset" name="submit">Reset</button>
                </div>
          </form>
        </div>
    </div>
</section>
@endsection
<body>
</html>
