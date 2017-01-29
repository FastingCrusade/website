angular.module('fc.services.commentService', [

])
.factory('commentService', ['$state', '$http', 
   function($state, $http) {

   var commentService = {};
   commentService.getComments = getComments;
   commentService.addComment = addComment;

   return commentService;   

   function getComments(fastId) {
  
      return [{
         contents: 'Comment number 1',
         replyCount: 2
      },{
         contents: 'This is the second comment.  It is longer.  But not very good still.'
      }];    
/*
      return $http({
         method: 'GET',
         url: '/api/fast/' + fastId + '/comments'
      });
*/
   }

   function addComment(fastId, comment) {

      return $http({
         method: 'POST',
         url: '/api/fast/' + fastId + '/comments',
         data: { 
            'contents': comment.contents
         }
      });
   }
}]);
