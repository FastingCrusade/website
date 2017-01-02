angular.module('fc.services.fastService', [

])
.factory('fastService', function($rootScope, $state, $http) {

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
      
      $http({
         method: 'GET',
         url: '/api/user/' + $rootScope.user.id + '/fasts'
      }).then(function(response) {
         fastService.fasts = response.data;
         return fastService.fasts;
      }, function(error) {
         console.log('Error retrieving fasts: ' + error.statusText);
      });
   }

   function addFast(newFast) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

/*
      // TODO: Remove when backend is hooked up.
      fastService.fasts.push(newFast);
      return fastService.fasts;
*/    
      $http.defaults.headers.common['Authorization'] = 'Bearer ' + token;
      $http({
         method: 'POST',
         url: '/api/fasts',
         data: { 
            'user_id': $rootScope.user.id,
            'category_id': newFast.category_id,
            'subtype': newFast.subtype,
            'start': newFast.start / 1000,
            'end': newFast.end / 1000,
            'description': newFast.description,
            'api_token': token
         }
      }).then(function(response) {
         fastService.fasts.push(newFast);
         $state.go('home.welcome');
      }, function(error) {
         console.log('Error adding fast: ' + error.statusText);
      });
   }
});
