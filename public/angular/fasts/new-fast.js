angular.module('fc.home.newFast', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.services.fastService'
])
.controller('NewFastCtrl', ['$scope', '$state', 'constants', 'fastService',
   function($scope, $state, constants, fastService) {
   
   $scope.createFast = createFast;
   $scope.fastCategories = fastService.fastCategories;
  
   $('#startTimePicker').datetimepicker();
   $('#endTimePicker').datetimepicker({
      useCurrent: false
   });
   $('#startTimePicker').on('dp.change', function(e) {
      $('#endTimePicker').data('DateTimePicker').minDate(e.date);
      $scope.start = $('#startTimePicker').data().date;
   });
   $('#endTimePicker').on('dp.change', function(e) {
      $('#startTimePicker').data('DateTimePicker').maxDate(e.date);
      $scope.end = $('#endTimePicker').data().date;
   });

   function createFast() {
      var newFast = {};
      newFast.category_id = $scope.selectedCategory.id;
      newFast.subtype = $scope.subtype;
      newFast.start = new Date($scope.start);
      newFast.end = new Date($scope.end);
      newFast.description = $scope.description;

      fastService.addFast(newFast);
      $state.go(constants.states.welcome);
   }

}]);
