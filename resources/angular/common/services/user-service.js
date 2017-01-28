angular.module('fc.services.userService', [

])
.factory('userService', function($http) {

   var userService = {};
   userService.login = login;
   userService.isLoggedIn = isLoggedIn;
   userService.logout = logout;
   userService.register = register;

   userService.user = null;

   return userService;   

   function login(email, password, rememberMe) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

      return $http({
         method: 'POST',
         url: '/login',
         data: { 
            'email': email, 
            'password': password, 
            '_token': token 
         }
      }).then(function(response) {
         userService.user = JSON.parse(response.data.data);
         $http.defaults.headers.common['Authorization'] = 'Bearer ' + userService.user.api_token;
      });
   }

   function isLoggedIn() {
      return !!userService.user;
   }

   function register(email, password, name) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

      return $http({
         method: 'POST',
         url: '/register',
         data: { 
            'email': email, 
            'password': password, 
            'name': name, 
            '_token': token 
         }
      });
   }

   function logout() {
      return $http({
         method: 'GET',
         url: '/logout'
      }).then(function(data) {
         userService.user = null;
      });
   }

});
