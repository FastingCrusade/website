angular.module('fc.services.userService', [

])
.factory('userService', function($http) {

   var userService = {};
   userService.login = login;

   return userService;   

   function login(username, password, rememberMe) {
      console.log("Username: " + username);
      console.log("Password: " + password);
      console.log("Remember: " + rememberMe);
   }

});
