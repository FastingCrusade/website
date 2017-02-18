angular.module('fc.account.register', [
   'fc.common.constants',
   'fc.services.userService'
])
.controller('RegisterCtrl', ['$scope', '$state', 'constants', 'userService', 
   function($scope, $state, constants, userService) {
   
   $scope.submitRegistration = submitRegistration;
   $scope.returnHome = returnHome;

   $scope.squarePaymentForm = new SqPaymentForm({
      applicationId: $('#square_app_id').attr('content'),
      inputClass: 'sq-input',
      inputStyles: [{
         fontSize: '15px'
      }],
      cardNumber: {
          elementId: 'sq-card-number',
          placeholder: '---- ---- ---- ----'
      },
      cvv: {
         elementId: 'sq-cvv',
         placeholder: 'CVV'
      },
      expirationDate: {
         elementId: 'sq-expiration-date',
         placeholder: 'MM/YY'
      },
      postalCode: {
         elementId: 'sq-postal-code'
      },
      callbacks: {
         cardNonceResponseReceived: function(errors, nonce, cardData) {
            $scope.errors = errors;   
            if (!errors) {
               // No errors occurred. Extract the card nonce.
               $scope.nonce = nonce;
               completeRegistration();
            }
            $scope.$apply(); // Required since this is not an angular function
         },
         unsupportedBrowserDetected: function() {
            // Fill in this callback to alert buyers when their browser is not supported.
         },
         inputEventReceived: function(inputEvent) {
            switch (inputEvent.eventType) {
               case 'focusClassAdded':
                  // Handle as desired
                  break;
               case 'focusClassRemoved':
                  // Handle as desired
                  break;
               case 'errorClassAdded':
                  // Handle as desired
                  break;
               case 'errorClassRemoved':
                  // Handle as desired
                  break;
               case 'cardBrandChanged':
                  // Handle as desired
                  break;
               case 'postalCodeChanged':
                  // Handle as desired
                  break;
            }
         }
      }
   });

   $scope.squarePaymentForm.build();

   function submitRegistration() {
      $scope.isProcessing = true;
      $scope.squarePaymentForm.requestCardNonce();
      return false; 
   }

   function completeRegistration() {
      userService.register($scope.email, $scope.password, $scope.name, $scope.nonce)
         .then(function(response) {
            $scope.registrationSuccess = true;
            $scope.isProcessing = false;
         }, function(error) {
            $scope.registrationError = true;
            console.error('Error during registration! ' + error.statusText);
         });
   }

   // TODO: Eventually figure out what the "main" state is, when you first hit the app
   function returnHome() {
      $state.go(constants.states.soon);
   }
}]);
