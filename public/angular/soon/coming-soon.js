angular.module('fc.comingSoon', [
   'fc.services.news'
])
.controller('ComingSoonCtrl', ['$scope', '$http', 'newsService', function($scope, $http, newsService) {

   $scope.submitEmail = submitEmail;

   function submitEmail() {
      newsService.subscribe($scope.email)
         .then(function () {
            $this.closest('.column').text('Thank you, we\'ll let you know!');
         });
   }
}]);
