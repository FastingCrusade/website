angular.module('fc.comingSoon', [])
.controller('ComingSoonCtrl', function($scope, $http) {
   $scope.submitEmail = submitEmail;

   function submitEmail(event) {
      event.stopPropagation();
      event.preventDefault();
        
      console.log('Email address: ' + $scope.email);
      /*
      $http({
         url: 'newsletters/subscription',
         method: 'POST',
         data: {
            email: $scope.email,
            '_token': '{{ csrf_token() }}'
         }
      }).then(function () {
         $this.closest('.column').text('Thank you, we\'ll let you know!');
      });
      */
   }
});
