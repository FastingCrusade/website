angular.module('fc', [
   'ui.router', 
   'fc.nav',
   'fc.home.welcome',
   'fc.home.newFast',
   'fc.comingSoon',
   'fc.account.register'
])
.config(function($stateProvider, $urlRouterProvider) {
    
   $urlRouterProvider.otherwise('/soon');
    
   $stateProvider
        
      .state('soon', {
         url: '/soon',
         views: {
            'main': {
               templateUrl: 'angular/soon/coming-soon.tpl.html',
               controller: 'ComingSoonCtrl'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.tpl.html',
               controller: 'NavCtrl'
            }
         }
      })
      
      .state('home', {
         url: '/home',
         views: {
            'main': {
               template: '<div ui-view></div>'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.tpl.html',
               controller: 'NavCtrl'
            }
         }
      })
      .state('home.welcome', {
         templateUrl: 'angular/home/welcome.tpl.html',
         controller: 'WelcomeCtrl'
      })
      .state('home.newfast', {  
         templateUrl: 'angular/home/new-fast.tpl.html',
         controller: 'NewFastCtrl'
      })
        
      .state('about', {
         url: '/about',
         views: {
            'main': {
               templateUrl: 'angular/about/about.tpl.html'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.tpl.html',
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
               templateUrl: 'angular/nav/nav.tpl.html',
               controller: 'NavCtrl'
            }
         }
      })
      .state('account.register', {
         url: '/register',
         templateUrl: 'angular/account/register.tpl.html',
         controller: 'RegisterCtrl'
      });  
});
