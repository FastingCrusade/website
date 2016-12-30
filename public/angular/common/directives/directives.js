angular.module('fc.directives.ng-enter', [
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

   var fastCardCtrl = ['$scope', function($scope) {
      
   }];

   return {
      restrict: 'E',
      templateUrl: 'angular/html/directives/fast-card.tpl.html',
      controller: fastCardCtrl,
      scope: {
         fast: '='
      }
   };

})
;
