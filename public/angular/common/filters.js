angular.module('fc.common.filters', [

])
.filter('timeRemainingFromString', function($filter) {
   return function(start, end) {
      var startTime = new Date(start);
      var endTime = new Date(end);
      
      return $filter('timeRemainingFromSeconds')(startTime / 1000, endTime / 1000);
   };
})
.filter('timeRemainingFromSeconds', function() {
   return function(start, end) {
      var timeRemaining = (end - start).toFixed();
      if (timeRemaining <= 0)
         return "Completed!";
      else {
         var seconds = timeRemaining % 60;
         if (seconds < 10 || seconds === 0) 
            seconds = '0' + seconds;
         var minutes = (timeRemaining = (timeRemaining / 60).toFixed(0)) % 60;
         if (minutes < 10 || minutes === 0) 
            minutes = '0' + minutes;
         var hours = (timeRemaining = (timeRemaining / 60).toFixed(0)) % 24;
         var days = (timeRemaining / 24).toFixed(0);

         var returnString = '';
         returnString += (days > 0) ? days + 'D ': '';
         returnString += hours + ':' + minutes + ':' + seconds;
         return returnString;
      }
   };
})
;

