<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Admin Survey</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigation')
@extends('components.molecule.addSurvey')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/PSU_background.jpg'); background-size: cover;">
    <div class="text"><i class='bx bxs-inbox' ></i> Admin Survey
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addSurvey">+ Add Survey</button>
    </div>
    <div class="container" style="width: 95%;">
        @if(Session::has('delete'))
        <div class="card-panel white-text red lighten-1">{{ Session::get('delete') }}</div>
        @elseif(Session::has('success'))
        <div class="card-panel white-text green lighten-1">{{ Session::get('success') }}</div>
        @endif
        <div class="row">
            <div class="panel panel-primary" style="background-color: rgba(255, 255, 255, 0.89);">
                <div class="panel-head" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Admin Survey
                </div>
                <div class="panel-body">
                    @if(empty(count($survey)))
                    <h3>No Survey Yet.</h3>
                    @else
                    @foreach ($survey as $survey)
                    <div class="clearfix chat-body">
                        <div class="header" style="margin-bottom: 5px;">
                            <strong class="primary-font text-capitalize ">Title : {{ $survey->title }}</strong>
                            <div class="pull-right deleteButton" style="margin-left: 5px;">
                                <form action='{{ url("survey/$survey->id") }}' method="post">
                                <input class="btn btn-danger" type="submit" value="Delete" />
                                @method('delete')
                                @csrf
                              </form>
                            </div>
                            <a href="{{ url("survey/$survey->id") }}" title="See Chat" class="pull-right btn btn-primary"><i class='bx bxs-right-arrow-square'></i> See Survey</a> 
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
