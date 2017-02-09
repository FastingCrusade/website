angular.module('fc.account.register', [
   'fc.common.constants',
   'fc.services.userService'
])
.controller('RegisterCtrl', ['$scope', '$state', 'constants', 'userService', 
   function($scope, $state, constants, userService) {
   
   $scope.submitRegistration = submitRegistration;
   $scope.returnHome = returnHome;

   var squareApplicationId = 'sandbox-sq0idp-ShnGBqDA9ae3V3H6piMkMQa';
   var squareAccessToken = 'sandbox-sq0atb-0qy9x7jgr3k93EGO3O98kQ';

   $scope.paymentForm = new SqPaymentForm({
      applicationId: squareApplicationId,
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
             if (errors) {
                console.log("Encountered errors:");
   
                errors.forEach(function(error) {
                   console.log('  ' + error.message);
                });

             } else {
               // No errors occurred. Extract the card nonce.
               // document.getElementById('card-nonce').value = nonce;
               // document.getElementById('nonce-form').submit();   
            }
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
         },

         paymentFormLoaded: function() {
            // Fill in this callback to perform actions after the payment form is
            // done loading (such as setting the postal code field programmatically).
            // paymentForm.setPostalCode('94103');
         }
      }
   });

   $scope.paymentForm.build();

   function requestCardNonce(event) {
      event.preventDefault();
      $scope.paymentForm.requestCardNonce();
   }

   function submitRegistration(event) {
      $scope.isProcessing = true;
      $scope.paymentForm.requestCardNonce();
      return false; 
/*
      userService.register($scope.email, $scope.password, $scope.name)
         .then(function(response) {
            $scope.registrationSuccess = true;
         }, function(error) {
            $scope.registrationError = true;
            console.error('Error during registration! ' + error.statusText);
         });
*/
   }

   // TODO: Eventually figure out what the "main" state is, when you first hit the app
   function returnHome() {
      $state.go(constants.states.soon);
   }
}]);
