angular.module('fc.services.userService', [

])
.factory('userService', function($http) {

   var userService = {};
   userService.login = login;

   return userService;   

   function login(email, password, rememberMe) {
      console.log("Email: " + email);
      console.log("Password: " + password);
      console.log("Remember: " + rememberMe);

      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

      return $http({
         method: 'POST',
         url: '/login',
         data: { 'email': email, 'password': password, '_token': token }
      });
   }

});
