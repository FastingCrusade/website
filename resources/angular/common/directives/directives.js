angular.module('fc.common.directives', [
   'fc.common.constants',
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

   return {
      restrict: 'A',
      templateUrl: 'common/directives/fast-card.tpl.html',
      scope: {
         fast: '='
      },
      controller: ['$scope', '$state', '$interval', 'constants', 'fastService', 
         function($scope, $state, $interval, constants, fastService) {
         
         $scope.$on('destroy', cancelInterval);
         $scope.currentTime = new Date().getTime() / 1000;
         $scope.fastCategories = fastService.fastCategories;
   
         $scope.openFast = openFast;
      
         var updateCurrentTime = $interval(function() {
            $scope.currentTime = new Date().getTime() / 1000;
         }, 1000);

         function openFast(fast) {
            $state.go(constants.states.fullFast, { fast: fast });
         }

         function cancelInterval() {
            if (angular.isDefined(updateCurrentTime)) {
               $interval.cancel(updateCurrentTime);
               updateCurrentTime = undefined;
            }
         }
      }]
   };
})
.directive('fastCardSmall', function () {

   return {
      restrict: 'A',
      templateUrl: 'common/directives/fast-card-small.tpl.html',
      scope: {
         fast: '='
      },
      controller: ['$scope', '$state', '$interval', 'constants', 'fastService', 
         function($scope, $state, $interval, constants, fastService) {

         $scope.$on('destroy', cancelInterval);
         $scope.currentTime = new Date().getTime() / 1000;
         $scope.fastCategories = fastService.fastCategories;

         $scope.openFast = openFast;

         var updateCurrentTime = $interval(function() {
            $scope.currentTime = new Date().getTime() / 1000;
         }, 1000);

         function cancelInterval() {
            if (angular.isDefined(updateCurrentTime)) {
               $interval.cancel(updateCurrentTime);
               updateCurrentTime = undefined;
            }
         }

         function openFast(fast) {
            $state.go(constants.states.fullFast, { fast: fast });
         }
      }]
   };
})
.directive('commentArea', function () {

   return {
      restrict: 'E',
      templateUrl: 'common/directives/comment-area.tpl.html',
      scope: {
         comment: '=',
         isReply: '=',
         submitComment: '&'
      },
      controller: ['$scope', function($scope) {

         $scope.getReplies = getReplies;
         $scope.hideReplies = hideReplies;   

         $scope.replies = [];
         $scope.showReplies = false;

         function getReplies() {
            $scope.replies.push({ contents: 'FIRST!' });
            $scope.replies.push({ contents: 'Mr. Hammond... Replies are working.' });
            $scope.showReplies = true;
         }

         function hideReplies() {
            $scope.showReplies = false;
         }
      }]
   };
})
;
