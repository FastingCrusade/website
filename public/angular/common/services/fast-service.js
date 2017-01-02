angular.module('fc.services.fastService', [

])
.factory('fastService', function($http) {

   var fastService = {};
   fastService.getFasts = getFasts;
   fastService.addFast = addFast;
   fastService.fasts = [];

   fastService.fastCategories = [];
   var categoryList = [
      'Candy',
      'Soda',
      'Fast Food',
      'Junk Food',
      'Dairy',
      'Pizza',
      'Meat',
      'Smoking',
      'Alcohol',
      'Addiction',
      'Bad Habit',
      'Specific Sin',
      'Negativity',
      'Phone',
      'TV',
      'Computer',
      'Video Games',
      'Staying Up Late',
      'Being Lazy'
   ];
   for (var i = 0; i < categoryList.length; ++i) {
      fastService.fastCategories.push({
         'name': categoryList[i],
         'id': i
      });
   }

   return fastService;   

   function getFasts(user) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;
      
      // TODO: Remove when backend is hooked up
      if (fastService.fasts.length <= 0 ) {
         fastService.fasts.push({
            'category': fastService.fastCategories[2],
            'subtype': 'First Fast',
            'start': new Date() - 100,
            'end': new Date() - 0 + 1000000,
            'description': 'This is the first fast.'
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
