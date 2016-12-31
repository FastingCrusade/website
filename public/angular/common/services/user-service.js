angular.module('fc.services.userService', [

])
.factory('userService', function($http) {

   var userService = {};
   userService.login = login;
   userService.register = register;

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
      });
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

});
