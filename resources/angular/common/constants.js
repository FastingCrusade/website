angular.module('fc.common.constants', [

])
.constant('constants', {
   states: {
      // Root states
      soon: 'root.soon',
      about: 'root.about',

      // Account states
      register: 'root.account.register',
      
      // Admin states
      privacy: 'root.admin.privacy',
      contact: 'root.admin.contact',

      // User states
      welcome: 'root.main.user.welcome',
      newFast: 'root.main.user.new-fast',
      fullFast: 'root.main.user.full-fast'
   }
})
;
