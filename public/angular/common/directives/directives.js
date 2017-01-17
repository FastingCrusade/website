angular.module('fc.directives.ng-enter', [
   'fc.services.fastService'
])
.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
})
.directive('fastCard', function () {

   var fastCardCtrl = ['$scope', '$filter', function($scope, $filter) {
      
   }];

   return {
      restrict: 'A',
      templateUrl: 'angular/common/directives/fast-card.tpl.html',
      controller: fastCardCtrl,
      scope: {
         fast: '='
      },
      controller: ['$scope', '$interval', 'fastService', function($scope, $interval, fastService) {
         
         $scope.$on('destroy', cancelInterval);
         $scope.currentTime = new Date().getTime() / 1000;
         $scope.fastCategories = fastService.fastCategories;
      
         var updateCurrentTime = $interval(function() {
            $scope.currentTime = new Date().getTime() / 1000;
         }, 1000);

         function cancelInterval() {
            if (angular.isDefined(updateCurrentTime)) {
               $interval.cancel(updateCurrentTime);
               updateCurrentTime = undefined;
            }
         }
      }]
   };

})
;
