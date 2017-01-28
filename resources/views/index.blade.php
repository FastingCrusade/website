<!DOCTYPE html>
<html>
<head>

    <!-- 3rd Party CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/bower.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
   
    <!-- 3rd Party JS -->
    <script src="{{ elixir('js/bower.js') }}"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.4.0.js"></script>

    <!-- Custom JS -->
    <script src="{{ elixir('js/templates.js') }}"></script>
    <script src="{{ elixir('js/all.js') }}"></script>

    <!-- Page title and favicon -->
    <title>Fasting Crusade</title>
    <link rel="icon" href="{{ asset('img/c-logo-webred.svg') }}img/c_logo.svg">

    <!-- CSRF Token for Authentication -->
    <meta id="csrf_token" content="{{ csrf_token() }}">
<head> 
    

</head> 
<body ng-app="fc" class="fc-main-app" style="background: url(img/shore-town-slate.jpg) no-repeat center center fixed;">

<!-- NAVIGATION -->
<div ui-view="navigation"></div>

<!-- MAIN CONTENT -->
<div ui-view="main"></div>

<div ui-view="footer"></div>

</body> 
</html>
