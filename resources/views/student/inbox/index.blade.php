<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
    <title>Student Inbox</title>
</head>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigationStudent')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/background-student.jpg'); background-size: cover;">
    <div class="text">Student Inbox <span class="glyphicon glyphicon-comment"></span></div>
    <div class="container" style="width: 90%;">
            <div class="row">
                    <div class="panel panel-primary" style="background-color: rgba(255, 255, 255, 0.89);">
                        <div class="panel-head" id="accordion">
                            <span class="glyphicon glyphicon-comment"></span> Chat with Admin
                        </div>
                        <div class="panel-body">
                            <ul class="chat">
                                @foreach ($chat as $chat)
                                    @if($chat->role == 1)
                                    <li class="clearfix left"><span class="chat-img pull-left">
                                        @if(empty($chat->profile))
                                        <img src="{{ URL::Asset('../images/default_image.png') }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                                        @else
                                        <img src="{{ URL::Asset("storage/".$chat->profile) }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                                        @endif
                                    </span>
                                        <div class="clearfix chat-body">
                                            <div class="header" style="margin-bottom: 5px;">
                                                <strong class="primary-font text-capitalize">{{ $chat->name }}</strong> 
                                                <small class="pull-right text-muted">
                                                    <span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}</small>
                                            </div>
                                            <p>
                                                {{$chat->message }}
                                                <br>
                                            </p>
                                        </div>
                                    </li>
                                    <hr>
                                    @else
                                    <li class="right"><span class="chat-img pull-right" >
                                        @if(empty($chat->profile))
                                        <img src="{{ URL::Asset('../images/default_image.png') }}" alt="User Avatar" class="img-circle" style="margin-left: 10px; width: 90px; height:90px;"/>
                                        @else
                                        <img src="{{ URL::Asset("storage/".$chat->profile) }}" alt="User Avatar" class="img-circle" style="margin-left: 10px; width: 90px; height:90px;"/>
                                        @endif
                                    </span>
                                        <div class="clearfix chat-body">
                                            <div class="header" style="margin-bottom: 5px;">
                                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}</small>
                                                <strong class="pull-right primary-font text-capitalize">{{ $chat->name }}</strong>
                                            </div>
                                            <p style="float: right">
                                                {{$chat->message }}
                                                <div class="deleteButton">
                                                    <form action='{{ url("chats/$chat->id")}}' method="post">
                                                    <input class="btn btn-danger" type="submit" value="Delete" />
                                                    @method('delete')
                                                    @csrf
                                                  </form>
                                                  </div> 
                                            </p>
                                        </div>
                                    </li>
                                    <hr>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <form action="{{ URL('/chats') }}" method="post">
                            @csrf
                            @if(Session::has('delete'))
                            <div class="alert alert-danger m-2s">{{ Session::get('delete') }}</div>
                            @elseif(Session::has('success'))
                            <div class="m-2 alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @foreach ($admin as $admin)
                            <input type="hidden" name="receiver_id" value="{{ $admin->role }}">
                            @endforeach
                            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" name="message" placeholder="Type your message here..." required/>
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
    </div>
</section>
@endsection
<body>
</html>
