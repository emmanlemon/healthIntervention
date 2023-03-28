<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <title>Admin Dashboard</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigation')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/PSU_background.jpg'); background-size: cover;">
    <div class="text">Admin Dashboard</div>
    <div class="container-dashboard">
        <div class="card">
            <div class="card-details">
                <p class="text-title"><i class='bx bx-user' ></i> Student</p>
                <p class="text-title">{{ $student }}</p>
              {{-- <p class="text-title">{{ $student }}</p> --}}
            </div>
            <a href="{{ route('page' , 'student')}}" class="card-button">More info</a>
          </div>
          <div class="card">
            <div class="card-details">
              <p class="text-title"><i class='bx bx-folder' ></i> Survey</p>
              <p class="text-title">{{ $survey}} </p>
            </div>
            <a href="{{ route('page' , 'survey')}}" class="card-button">More info</a>
          </div>
          <div class="card">
            <div class="card-details">
            <p class="text-title"><i class='bx bxs-inbox' ></i> UserChat</p>
              <p class="text-title">{{ $userChat }}</p>
              {{-- <p class="text-body">Chat</p> --}}
            </div>
            <a href="{{ route('page' , 'inbox')}}" class="card-button">More info</a>
          </div>
    </div>
    <div class="card-survey">
        <h3>Latest Survey</h3>
        <p>Title :  {{ $surveyLatest[0]->title }}</p>
        <p>Description : {{ $surveyLatest[0]->description }}</p>  
        {{-- <p>Total Respondent : {{ $surveyResponse->count() }}</p>   --}}
        <p>Time Uploaded: {{ date('F j, Y, g:i a', strtotime($surveyLatest[0]->created_at)) }} , <span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($surveyLatest[0]->created_at)->diffForHumans() }}</p>    </div>
    {{-- <div class="container">
        <div class="card">
            <h3 class="card__title">Title
            </h3>
            <p class="card__content">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <div class="card__date">
                April 15, 2022
         </div>
         <div class="card__arrow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
         </div>
        </div>
        <div class="card">
            <h3 class="card__title">Title
            </h3>
            <p class="card__content">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <div class="card__date">
                April 15, 2022
         </div>
         <div class="card__arrow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
         </div>
        </div>
    </div> --}}
   
</section>
@endsection
<body>
</html>
