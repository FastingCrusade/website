angular.module('fc.comingSoon', [
   'fc.services.news'
])
.controller('ComingSoonCtrl', ['$scope', '$http', 'newsService', function($scope, $http, newsService) {

   $scope.submitEmail = submitEmail;

   $scope.subscribed = false;

   function submitEmail() {
      newsService.subscribe($scope.email)
         .then(function () {
            $scope.subscribed = true;
         });
   }
}]);
