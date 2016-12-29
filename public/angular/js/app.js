angular.module('fcApp', [
   'ui.router', 
   'fc.nav',
   'fc.comingSoon'
]).config(function($stateProvider, $urlRouterProvider) {
    
   $urlRouterProvider.otherwise('/home');
    
   $stateProvider
        
      // HOME STATES AND NESTED VIEWS ========================================
      .state('home', {
         url: '/home',
         views: {
            'main': {
               templateUrl: 'angular/html/soon.html',
               controller: 'ComingSoonCtrl'
            },
            'navigation': {
               templateUrl: 'angular/html/nav.html',
               controller: 'NavCtrl'
            }
         }
      })
        
      // ABOUT PAGE AND MULTIPLE NAMED VIEWS =================================
      .state('about', {
         url: '/about',
         views: {
            'main': {
               templateUrl: 'angular/html/about.html'
            },
            'navigation': {
               templateUrl: 'angular/html/nav.html',
               controller: 'NavCtrl'
            }
         }
      });  
});
