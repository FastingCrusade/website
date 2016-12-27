<!DOCTYPE html>
<html>
<head>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css"> 
    <link rel="stylesheet" type="text/css" href="angular/css/main.css">

    <!-- JS -->
    <script src="http://code.angularjs.org/1.2.13/angular.js"></script>
    <script src="https://unpkg.com/angular-ui-router@0.3.2/release/angular-ui-router.min.js"></script>
    <script src="angular/js/app.js"></script>
    <script src="angular/js/comingSoon.js"></script>

    <!-- Page title and favicon -->
    <title>Coming Soon!</title>
    <link rel="icon" href="../../public/img/c_logo.png">
<head> 
    

</head> 
<body ng-app="fcApp" class="fc-main-app">

<!-- NAVIGATION -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand custom-brand" ui-sref="home"><img src="/img/full-logo.png"/></a>
    </div>
    <ul class="nav navbar-nav">
        <li><a ui-sref="home">Home</a></li>
        <li><a ui-sref="about">About</a></li>
    </ul>
</nav>

<!-- MAIN CONTENT -->
<div class="container">
    
    <div ui-view></div>

</div>

</body> 
</html>
