angular.module('fc.home.newFast', [
   'ui.bootstrap',
   'fc.services.fastService'
])
.controller('NewFastCtrl', ['$scope', '$state', 'fastService',
   function($scope, $state, fastService) {
   
   $scope.createFast = createFast;
   $scope.fastCategories = fastService.fastCategories;
  
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

   function createFast() {
      var newFast = {};
      newFast.userId = 1;               // TODO: Get user id
      newFast.category_id = $scope.selectedCategory.id;
      newFast.subtype = $scope.subtype;
      newFast.start = new Date($('#startTimePicker').data().date);
      newFast.end = new Date($('#endTimePicker').data().date);
      newFast.description = $scope.description;

      fastService.addFast(newFast);
      $state.go('home.welcome');
   }

}]);
