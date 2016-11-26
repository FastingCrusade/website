<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title or "Fasting Crusade" }}</title>

    @section('fonts')
    @endsection

    @section('styles')
        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
    @show

    @section('top-scripts')
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    @show
</head>
<body>
<div class="flex-center position-ref full-height" id="app">
    <div>
        <navigation user="{{ $user }}" admin="{{ $admin }}">@include('navigation')</navigation>
        <log-in csrf-token="{{ csrf_token() }}"></log-in>
        <sign-up csrf-token="{{ csrf_token() }}"></sign-up>
        <div class="ui container" id="main-content">
            @yield('content')
        </div>
    </div>
</div>
@section('bottom-scripts')
    <script src="semantic/dist/semantic.min.js"></script>
    <script src="js/app.js"></script>
@show
</body>
</html>
