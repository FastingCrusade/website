<!DOCTYPE html>
<html>
<head>

    <!-- 3rd Party CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css"> 
    <link rel="stylesheet" type="text/css" href="angular/bower_components/slick-carousel/slick/slick.css"> 
    <link rel="stylesheet" type="text/css" href="angular/bower_components/slick-carousel/slick/slick-theme.css"> 
    <link rel="stylesheet" type="text/css" href="angular/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"> 

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="angular/common/directives/fast-card.css">
    <link rel="stylesheet" type="text/css" href="angular/common/directives/comment-area.css">
    <link rel="stylesheet" type="text/css" href="angular/account/register.css">
    <link rel="stylesheet" type="text/css" href="angular/about/about.css">
    <link rel="stylesheet" type="text/css" href="angular/admin/privacy.css">
    <link rel="stylesheet" type="text/css" href="angular/home/welcome.css">
    <link rel="stylesheet" type="text/css" href="angular/fasts/new-fast.css">
    <link rel="stylesheet" type="text/css" href="angular/fasts/full-fast.css">
    <link rel="stylesheet" type="text/css" href="angular/nav/nav.css">
    <link rel="stylesheet" type="text/css" href="angular/nav/sidebar.css">
    <link rel="stylesheet" type="text/css" href="angular/nav/footer.css">
    <link rel="stylesheet" type="text/css" href="angular/main.css">
   
    <!-- 3rd Party JS -->
    <script src="angular/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
    <script src="https://unpkg.com/angular-ui-router@0.3.2/release/angular-ui-router.min.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.4.0.js"></script>
    <script src="angular/bower_components/slick-carousel/slick/slick.js"></script>
    <script src="angular/bower_components/angular-slick-carousel/dist/angular-slick.min.js"></script>
    <script src="angular/bower_components/moment/min/moment.min.js"></script>
    <script src="angular/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Custom JS -->
    <script src="angular/common/filters.js"></script>
    <script src="angular/common/constants.js"></script>
    <script src="angular/common/directives/directives.js"></script>
    <script src="angular/common/services/user-service.js"></script>
    <script src="angular/common/services/fast-service.js"></script>
    <script src="angular/common/services/news-service.js"></script>
    <script src="angular/account/register.js"></script>
    <script src="angular/soon/coming-soon.js"></script>
    <script src="angular/about/about.js"></script>
    <script src="angular/home/welcome.js"></script>
    <script src="angular/fasts/new-fast.js"></script>
    <script src="angular/fasts/full-fast.js"></script>
    <script src="angular/nav/nav.js"></script>
    <script src="angular/nav/sidebar.js"></script>
    <script src="angular/app.js"></script>

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
