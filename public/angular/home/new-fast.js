angular.module('fc.home.newFast', [
   'ui.bootstrap',
   'fc.services.fastService'
])
.controller('NewFastCtrl', ['$scope', '$state', 'fastService',
   function($scope, $state, fastService) {
   
   $scope.createFast = createFast;
   $scope.fastCategories = [];
  
   $('#startTimePicker').datetimepicker();
   $('#endTimePicker').datetimepicker({
      useCurrent: false
   });
   $('#startTimePicker').on('dp.change', function(e) {
      $('#endTimePicker').data('DateTimePicker').minDate(e.date);
   });
   $('#endTimePicker').on('dp.change', function(e) {
      $('#startTimePicker').data('DateTimePicker').maxDate(e.date);
   });
 
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
      $scope.fastCategories.push({
         'name': categoryList[i],
         'id': i
      });
   }   

   function createFast() {
      var newFast = {};
      newFast.userId = 1;               // TODO: Get user id
      newFast.category_id = $scope.selectedCategory.id;
      newFast.subtype = $scope.subtype;
      newFast.start = $scope.start / 1000;
      newFast.end = $scope.end / 1000;
      newFast.description = $scope.description;

      fastService.createFast(newFast);
      $state.go('home.welcome');
   }

}]);
