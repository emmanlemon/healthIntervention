<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>   
<link rel="stylesheet" style="text/css" href="{{ url('css/sidebarNavigation.css') }}">
<link rel="stylesheet" style="text/css" href="{{ url('css/dashboard_card.css') }}">
<link rel="stylesheet" style="text/css" href="{{ url('css/chat.css') }}">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@yield('index')