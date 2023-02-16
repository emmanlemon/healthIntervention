<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <title>Admin Inbox</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigation')
@section('sideBarNavigation')
<section class="home-section">
    <div class="text"><i class='bx bxs-inbox' ></i>Admin Inbox</div>
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-head" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Student Messages
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        @foreach ($userChat as $userChat)
                        <li class="left clearfix"><span class="chat-img pull-left">
                            @if(empty($userChat->profile))
                            <img src="{{ URL::Asset('../images/default_image.png') }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                            @else
                            <img src="{{ URL::Asset("storage/".$userChat->profile) }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                            @endif
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header" style="margin-bottom: 5px;">
                                    <strong class="primary-font text-capitalize "><u>{{ $userChat->name }}</u></strong>
                                    <a href="{{ url("chats/$userChat->sender_id") }}" title="See Chat" class="pull-right btn btn-primary"><i class='bx bxs-right-arrow-square'></i> See Chat</a> 
                                </div>
                                <p>
                                    <i class='bx bx-subdirectory-right'></i>
                                    {{ $userChat->message }}
                                    <br>
                                    <small class="bg-slate-400"><span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($userChat->created_at)->diffForHumans() }}</small>
                                </p>
                            </div>
                        </li>
                        <hr>
                        @endforeach
                    </ul>
                </div>
        </div>
    </div>
</section>
@endsection
<body>
</html>
