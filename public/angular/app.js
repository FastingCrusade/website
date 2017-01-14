angular.module('fc', [
   'ui.router', 
   'fc.common.filters',
   'fc.nav',
   'fc.sidebar',
   'fc.home.welcome',
   'fc.home.newFast',
   'fc.comingSoon',
   'fc.account.register'
])
.config(function($stateProvider, $urlRouterProvider) {
    
   $urlRouterProvider.otherwise('/soon');
    
   $stateProvider

      .state('root', {
         views: {
            'main': {
               template: '<div ui-view></div>'
            },
            'navigation': {
               templateUrl: 'angular/nav/nav.tpl.html',
               controller: 'NavCtrl'
            },
            'footer': {
               templateUrl: 'angular/nav/footer.tpl.html',
            }
         }
      })        
      .state('root.soon', {
         url: '/soon',
         templateUrl: 'angular/soon/coming-soon.tpl.html',
         controller: 'ComingSoonCtrl'
      })
      
      .state('root.home', {
         url: '/home',
         templateUrl: 'angular/sidebar-page.tpl.html'
      })
      .state('root.home.welcome', {
         views: {
            'sidebar': {
               templateUrl: 'angular/nav/sidebar.tpl.html',
               controller: 'SidebarCtrl'
            },
            'content': {
               templateUrl: 'angular/home/welcome.tpl.html',
               controller: 'WelcomeCtrl'
            }
         }
      })
      .state('root.home.newfast', {  
         views: {
            'sidebar': {
               templateUrl: 'angular/nav/sidebar.tpl.html',
               controller: 'SidebarCtrl'
            },
            'content': {
               templateUrl: 'angular/home/new-fast.tpl.html',
               controller: 'NewFastCtrl'
            }
         }
      })
        
      .state('root.about', {
         url: '/about',
         templateUrl: 'angular/about/about.tpl.html'
      }) 

      .state('root.account', {
         url: '/account',
         template: '<div ui-view></div>'
      })
      .state('root.account.register', {
         url: '/register',
         templateUrl: 'angular/account/register.tpl.html',
         controller: 'RegisterCtrl'
      })

      .state('root.admin', {
         url: '/',
         template: '<div ui-view></div>'
      }) 
      .state('root.admin.privacy', {
         url: 'privacy',
         templateUrl: 'angular/admin/privacy.tpl.html'
      })
      .state('root.admin.contact', {
         url: 'contact',
         templateUrl: 'angular/admin/contact.tpl.html'
      });
});
