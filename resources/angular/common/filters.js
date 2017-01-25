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
         return returnString + ' Left';
      }
   };
})
.filter('timeElapsedFromSeconds', function() {
   return function(start, current, end) {
      if (current > end) {
         return 'Completed!';
      }

      var returnString = '';     
      var timeElapsed = (current - start).toFixed(0);
      if (timeElapsed <= 0) {
         returnString += "Beginning in ";
         timeElapsed = (start - current).toFixed(0);
      }
      
      var seconds = timeElapsed % 60;
      timeElapsed -= seconds;
      if (seconds < 10 || seconds === 0)
         seconds = '0' + seconds;
      var minutes = (timeElapsed = (timeElapsed / 60)) % 60;
      timeElapsed -= minutes;
      if (minutes < 10 || minutes === 0)
         minutes = '0' + minutes;
      var hours = (timeElapsed = (timeElapsed / 60)) % 24;
      timeElapsed -= hours;
      var days = timeElapsed / 24;

      returnString += (days > 0) ? days + 'D ': '';
      returnString += hours + ':' + minutes + ':' + seconds;

      return returnString;
   };
})
;

