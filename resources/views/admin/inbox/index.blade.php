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
<section class="home-section" style="background-image: url('../images/PSU_background.jpg'); background-size: cover;">
    <div class="text">Admin Inbox <span class="glyphicon glyphicon-comment"></span></div>
    <div class="container">
        @if(Session::has('delete'))
        <div class="m-5 alert alert-danger">{{ Session::get('delete') }}</div>
        @endif
        <div class="row">
            <div class="panel panel-primary" style="background-color: rgba(255, 255, 255, 0.89);">
                <div class="panel-head" id="accordion">
                    {{-- <span class="glyphicon glyphicon-comment"></span> --}}
                     Student Messages
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        @foreach ($userChat as $userChat)
                        <li class="clearfix left"><span class="chat-img pull-left">
                            @if(empty($userChat->profile))
                            <img src="{{ URL::Asset('../images/default_image.png') }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                            @else
                            <img src="{{ URL::Asset("storage/".$userChat->profile) }}" alt="User Avatar" class="img-circle" style="margin-right: 10px; width: 90px; height:90px;"/>
                            @endif
                        </span>
                            <div class="clearfix chat-body">
                                <div class="header" style="margin-bottom: 5px;">
                                    <strong class="primary-font text-capitalize "><u>{{ $userChat->name }}</u></strong>
                                    <div class="pull-right deleteButton" style="margin-left: 5px;">
                                        <form action='{{ url("chats/$userChat->sender_id") }}' method="post">
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                        @method('delete')
                                        @csrf
                                      </form>
                                    </div>
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
</div>
</section>
@endsection
<body>
</html>
