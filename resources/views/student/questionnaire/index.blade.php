<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Student Survey</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigationStudent')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/background-student.jpg'); background-size: cover;">
    <div class="text"><i class='bx bx-bar-chart'></i>Student Survey</div>
    <div class="container" style="width: 95%;">
        <div class="row">
            <div class="panel panel-primary" style="background-color: rgba(255, 255, 255, 0.89);">
                <div class="panel-head" id="accordion">
                    <i class='bx bx-bar-chart'></i> Student Survey
                </div>
                <div class="panel-body">
                    @if(empty(count($survey)))
                    <p>No Survey Yet.</p>
                    @else
                    @foreach ($survey as $survey)
                    <div class="clearfix chat-body">
                        <div class="header" style="margin-bottom: 5px;">
                            <strong class="primary-font text-capitalize ">Title : {{ $survey->title }}</strong>
                            <a href="{{ url("survey/$survey->id") }}" title="See Chat" class="pull-right btn btn-primary"><i class='bx bxs-right-arrow-square'></i> Take Survey</a> 
                        </div>
                        <p>
                            Description : {{ $survey->description }}
                            <br>
                            <small class="bg-slate-400"><span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($survey->created_at)->diffForHumans() }}</small>
                        </p>
                    </div>
                    <hr>
                @endforeach
                    @endif
                </div>
    </div>
</section>
@endsection
<body>
</html>
