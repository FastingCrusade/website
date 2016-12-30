angular.module('fc', [
   'ui.router', 
   'fc.nav',
   'fc.home',
   'fc.comingSoon',
   'fc.account.register'
]).config(function($stateProvider, $urlRouterProvider) {
    
   $urlRouterProvider.otherwise('/soon');
    
   $stateProvider
        
      .state('soon', {
         url: '/soon',
         views: {
            'main': {
               templateUrl: 'angular/soon/coming-soon.html',
               controller: 'ComingSoonCtrl'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.html',
               controller: 'NavCtrl'
            }
         }
      })
      
      .state('home', {
         url: '/home',
         views: {
            'main': {
               templateUrl: 'angular/home/home.html',
               controller: 'HomeCtrl'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.html',
               controller: 'NavCtrl'
            }
         }
      })
        
      .state('about', {
         url: '/about',
         views: {
            'main': {
               templateUrl: 'angular/about/about.html'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.html',
               controller: 'NavCtrl'
            }
         }
      }) 

      .state('account', {
         url: '/account',
         views: {
            'main': {
               template: '<div ui-view></div>'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.html',
               controller: 'NavCtrl'
            }
         }
      })
      .state('account.register', {
         url: '/register',
         templateUrl: 'angular/account/register.html',
         controller: 'RegisterCtrl'
      });  
});
