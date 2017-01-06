angular.module('fc.services.news', [

])
.factory('newsService', function($http) {

   var newsService = {};
   newsService.subscribe = subscribe;

   return newsService;   

   function subscribe(email) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;
   
      return $http({
         method: 'POST',
         url: '/api/newsletters/subscription',
         data: {
            'email': email,
            '_token': token
         }
      });
   }

});
