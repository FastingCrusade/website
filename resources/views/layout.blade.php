<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>{{ $title or "Fasting Crusade" }}</title>

    @section('fonts')
    @endsection

    @section('styles')
        {{-- TODO Gulp these into one file. --}}
        <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    @show

    @section('top-scripts')
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    @show
</head>
<body>
<div class="flex-center position-ref full-height" id="app">
    <div>
        <navigation user="{{ $current_user->fullName() }}" admin="{{ $current_user->is_admin }}">@include('navigation')</navigation>
        <log-in></log-in>
        <sign-up></sign-up>
        <div class="ui container" id="main-content">
            @yield('content')
        </div>
    </div>
</div>
@section('bottom-scripts')
    {{-- TODO Gulp these into one file. --}}
    <script src="/semantic/dist/semantic.min.js"></script>
    <script src="/js/app.js"></script>
@show
</body>
</html>
