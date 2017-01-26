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
    .config(function ($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise('/soon');

        $stateProvider

            .state('root', {
                views: {
                    'main': {
                        template: '<div ui-view></div>'
                    },
                    'navigation': {
                        templateUrl: 'templates/nav/nav.tpl.html',
                        controller: 'NavCtrl'
                    },
                    'footer': {
                        templateUrl: 'templates/nav/footer.tpl.html',
                    }
                }
            })
            .state('root.soon', {
                url: '/soon',
                templateUrl: 'templates/soon/coming-soon.tpl.html',
                controller: 'ComingSoonCtrl'
            })

            .state('root.home', {
                url: '/home',
                templateUrl: 'templates/sidebar-page.tpl.html'
            })
            .state('root.home.welcome', {
                views: {
                    'sidebar': {
                        templateUrl: 'templates/nav/sidebar.tpl.html',
                        controller: 'SidebarCtrl'
                    },
                    'content': {
                        templateUrl: 'templates/home/welcome.tpl.html',
                        controller: 'WelcomeCtrl'
                    }
                }
            })
            .state('root.home.newfast', {
                views: {
                    'sidebar': {
                        templateUrl: 'templates/nav/sidebar.tpl.html',
                        controller: 'SidebarCtrl'
                    },
                    'content': {
                        templateUrl: 'templates/home/new-fast.tpl.html',
                        controller: 'NewFastCtrl'
                    }
                }
            })

            .state('root.about', {
                url: '/about',
                templateUrl: 'templates/about/about.tpl.html'
            })

            .state('root.account', {
                url: '/account',
                template: '<div ui-view></div>'
            })
            .state('root.account.register', {
                url: '/register',
                templateUrl: 'templates/account/register.tpl.html',
                controller: 'RegisterCtrl'
            })

            .state('root.admin', {
                url: '/',
                template: '<div ui-view></div>'
            })
            .state('root.admin.privacy', {
                url: 'privacy',
                templateUrl: 'templates/admin/privacy.tpl.html'
            })
            .state('root.admin.contact', {
                url: 'contact',
                templateUrl: 'templates/admin/contact.tpl.html'
            });
    })
    .run(['$rootScope', '$state', 'userService', function ($rootScope, $state, userService) {

        var noAuthStates = [
            'root.soon',
            'root.account.register',
            'root.about'
        ]

        $rootScope.$on('$stateChangeStart', function (event, toState) {
            if (!userService.isLoggedIn() && noAuthStates.indexOf(toState.name) === -1) {
                event.preventDefault();
                $state.go('root.soon');
            }
        });
    }])
;
