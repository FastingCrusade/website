angular.module('fc.services.fastService', [
   'fc.common.constants',
   'fc.services.userService'
])
.factory('fastService', ['$state', '$http', 'constants', 'userService', 
   function($state, $http, constants, userService) {

   var fastService = {};
   fastService.getFasts = getFasts;
   fastService.addFast = addFast;

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

   function getFasts() {
      
      return $http({
         method: 'GET',
         url: '/api/user/' + userService.user.id + '/fasts'
      });
   }

   function addFast(newFast) {
      var token = angular.element(document.querySelector('#csrf_token'))[0].content;

      $http.defaults.headers.common['Authorization'] = 'Bearer ' + userService.user.api_token;
      $http({
         method: 'POST',
         url: '/api/fasts',
         data: { 
            'user_id': userService.user.id,
            'category_id': newFast.category_id,
            'subtype': newFast.subtype,
            'start': newFast.start / 1000,
            'end': newFast.end / 1000,
            'description': newFast.description
         }
      }).then(function(response) {
         $state.go(constants.states.welcome);
      }, function(error) {
         console.log('Error adding fast: ' + error.statusText);
      });
   }
}]);
