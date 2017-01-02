angular.module('fc.services.fastService', [

])
.factory('fastService', function($http) {

   var fastService = {};
   fastService.getFasts = getFasts;
   fastService.addFast = addFast;
   fastService.fasts = [];

   return fastService;   

   function getFasts(user) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;
      
      // TODO: Remove when backend is hooked up
      if (fastService.fasts.length <= 0 ) {
         fastService.fasts.push({
            'name': 'First Fast',
            'daysActive': 11
         });
         fastService.fasts.push({
            'name': 'Fast #2',
            'daysActive': 2
         });
         fastService.fasts.push({
            'name': 'Fast Third Time',
            'daysActive': 23
         });
         fastService.fasts.push({
            'name': 'Fast AGAIN?',
            'daysActive': 4555
         });
      }
      return fastService.fasts;
/*
      $http({
         method: 'POST',
         url: '/login',
         data: { 
            'user': user,
            '_token': token 
         }
      }).then(function(response) {
         fasts = response.data;
         return fasts;
      }, function(error) {
         console.log('Error retrieving fasts for user ' + user + ': ' + error.statusText);
      });
*/
   }

   function addFast(newFast) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

      // TODO: Remove when backend is hooked up.
      fastService.fasts.push(newFast);
      return fastService.fasts;
      
/*
      $http({
         method: 'POST',
         url: '/register',
         data: { 
            'email': email, 
            'password': password, 
            'name': name, 
            '_token': token 
         }
      }).then(function(response) {
         fasts.push(newFast);
         return fasts;
      }, function(error) {
         console.log('Error adding fast for user ' + user + ': ' + error.statusText);
      });
*/
   }
});
