angular.module('fc', [
   'templates.app',
   'ui.router', 
   'fc.common.filters',
   'fc.common.directives',
   'fc.services.userService',
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
               templateUrl: 'nav/nav.tpl.html',
               controller: 'NavCtrl'
            },
            'footer': {
               templateUrl: 'nav/footer.tpl.html',
            }
         }
      })        
      .state('root.soon', {
         url: '/soon',
         templateUrl: 'soon/coming-soon.tpl.html',
         controller: 'ComingSoonCtrl'
      })
//      .state('root.about', {
//         url: '/about',
//         templateUrl: 'about/about.tpl.html'
//      }) 
      
      .state('root.main', {
         templateUrl: 'sidebar-page.tpl.html'
      })
      .state('root.main.user', {
         views: {
            'sidebar': {
               templateUrl: 'nav/sidebar.tpl.html',
               controller: 'SidebarCtrl'
            },
            'content': {
               template: '<div ui-view></div>'
            }
         }
      })
      .state('root.main.user.welcome', {
         templateUrl: 'home/welcome.tpl.html',
         controller: 'WelcomeCtrl'
      })
      .state('root.main.user.new-fast', {  
         templateUrl: 'fasts/new-fast.tpl.html',
         controller: 'NewFastCtrl'
      })
      .state('root.main.user.full-fast', {  
         templateUrl: 'fasts/full-fast.tpl.html',
         controller: 'FullFastCtrl',
         params: {
            fast: null
         }
      })
        
      .state('root.account', {
         url: '/account',
         template: '<div ui-view></div>'
      })
      .state('root.account.register', {
         url: '/register',
         templateUrl: 'account/register.tpl.html',
         controller: 'RegisterCtrl'
      })

      .state('root.admin', {
         url: '/',
         template: '<div ui-view></div>'
      }) 
      .state('root.admin.privacy', {
         url: 'privacy',
         templateUrl: 'admin/privacy.tpl.html'
      })
      .state('root.admin.contact', {
         url: 'contact',
         templateUrl: 'admin/contact.tpl.html'
      });
})
.run(['$rootScope', '$state', 'userService', function ($rootScope, $state, userService) {

   var noAuthStates = [
      'root.soon',
      'root.account.register',
      'root.about',
      'root.admin.privacy',
      'root.admin.contact'
   ]; 

   $rootScope.$on('$stateChangeStart', function (event, toState) {
      if (!userService.isLoggedIn() && noAuthStates.indexOf(toState.name) === -1) {
         event.preventDefault();
         $state.go('root.soon');
      }
   });
}])
;
