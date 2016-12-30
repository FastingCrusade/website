angular.module('fc', [
   'ui.router', 
   'fc.nav',
   'fc.home',
   'fc.comingSoon',
]).config(function($stateProvider, $urlRouterProvider) {
    
   $urlRouterProvider.otherwise('/soon');
    
   $stateProvider
        
      .state('soon', {
         url: '/soon',
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
      
      .state('home', {
         url: '/home',
         views: {
            'main': {
               templateUrl: 'angular/html/home.html',
               controller: 'HomeCtrl'
            },
            'navigation': {
               templateUrl: 'angular/html/nav.html',
               controller: 'NavCtrl'
            }
         }
      })
        
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
