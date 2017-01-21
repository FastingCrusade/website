angular.module('fc.sidebar', [
   'ui.bootstrap',
   'fc.services.userService'
])
.controller('SidebarCtrl', ['$scope', '$state', 'userService',
   function($scope, $state, userService) {

   $scope.user = userService.user;
   
   // Temporary dummy data
   $scope.followedFasts = [{
      category_id: 2,
      user: 'Matt',
      start: new Date().getTime() / 1000 + 12345,
      end: new Date().getTime() / 1000 + 19930
   },{
      category_id: 4,
      user: 'Jamie',
      start: new Date().getTime() / 1000,
      end: new Date().getTime() / 1000 + 193244
   },{
      category_id: 6,
      user: 'Marshall',
      start: new Date().getTime() / 1000,
      end: new Date().getTime() / 1000 + 19
   }]
   $scope.friendsList = [{
      id: 100,
      name: 'Jhonny Walker'
   },{
      id: 101,
      name: 'Sara Kerrigan'
   },{
      id: 102,
      name: 'Malcom Reynolds'
   },{
      id: 103,
      name: 'Winston'
   }];

}]);
