angular.module('fc.home.fullFast', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.common.directives',
   'fc.services.fastService',
   'fc.services.commentService'
])
.controller('FullFastCtrl', ['$scope', '$state', '$stateParams', '$http', 
   'constants', 'fastService', 'commentService',
   function($scope, $state, $stateParams, $http, constants, fastService, commentService) {
   
   $scope.fastCategories = fastService.fastCategories;
   $scope.addComment = addComment;

   $scope.fast = $stateParams.fast;
   resetNewComment();
   $scope.comments = [];

   $scope.comments = $scope.comments.concat(commentService.getComments($scope.fast.id));   
/*
   // TODO: Find out why this is failing and fix.
   commentService.getComments($scope.fast.id)
      .then(function(response) {
         $scope.comments.push(response.data.data);
      });
*/

   function addComment(comment) {
      commentService.addComment($scope.fast.id, comment)
         .then(function(response) {
            
            // TODO: Make sure comment is actually added to DB.
      
            comment.isNew = false;
            $scope.comments.splice(0, 0, comment);
            resetNewComment();
         }, function(error) {
            console.log('Error adding comment: ' + error.statusText);
         });
   }

   function resetNewComment() {
      $scope.newComment = {
         isNew: true,
         contents: null
      };
   }

}]);
