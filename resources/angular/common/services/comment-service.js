angular.module('fc.services.commentService', [

])
.factory('commentService', ['$state', '$http', 
   function($state, $http) {

   var commentService = {};
   commentService.getComments = getComments;
   commentService.addComment = addComment;
   commentService.addReply = addReply;

   return commentService;   

   function getComments(fastId) {

      return $http({
         method: 'GET',
         url: '/api/fast/' + fastId + '/comments'
      });

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

   function addReply(commentId, reply) {

      return $http({
         method: 'POST',
         url: '/api/comment/' + commentId + '/replies',
         data: {
            contents: reply.contents
         }
      });
   }
}]);
