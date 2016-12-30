<!DOCTYPE html>
<html>
<head>

    <!-- 3rd Party CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css"> 

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="angular/css/main.css">
    <link rel="stylesheet" type="text/css" href="angular/css/nav.css">

    <!-- 3rd Party JS -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
    <script src="https://unpkg.com/angular-ui-router@0.3.2/release/angular-ui-router.min.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.0.3.js"></script>

    <!-- Custom JS -->
    <script src="angular/js/directives/ng-enter.js"></script>
    <script src="angular/js/services/user-service.js"></script>
    <script src="angular/js/coming-soon.js"></script>
    <script src="angular/js/home.js"></script>
    <script src="angular/js/nav.js"></script>
    <script src="angular/js/app.js"></script>

    <!-- Page title and favicon -->
    <title>Coming Soon!</title>
    <link rel="icon" href="../../public/img/c_logo.png">

    <!-- CSRF Token for Authentication -->
    <meta id="csrf_token" content="{{ csrf_token() }}">
<head> 
    

</head> 
<body ng-app="fc" class="fc-main-app">

<!-- NAVIGATION -->
<div ui-view="navigation"></div>

<!-- MAIN CONTENT -->
<div class="container">
    <div ui-view="main"></div>
</div>

</body> 
</html>
