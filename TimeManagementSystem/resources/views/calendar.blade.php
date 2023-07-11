<!doctype html>
<html lang="en">

<head>
  @include('header')
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      center: 'addEventButton'
    },
    customButtons: {
      addEventButton: {
        text: 'add event...',
        click: function() {
          var dateStr = prompt('Enter a date in YYYY-MM-DD format');
          var date = new Date(dateStr + 'T00:00:00'); // will be in local time
          var eventtitle = prompt('Enter event title');
          
          if (!isNaN(date.valueOf())) { // valid?
            $.ajax({
              type: 'POST',
              url: '/saveToDatabase',
              data: {"mFormData":mFormData}
            }).done(function (msg) {
              alert("Data saved!");
            });
            calendar.addEvent({
              title: eventtitle,
              start: date,
              allDay: true
            });
            
          } else {
            alert('Invalid date.');
          }
        }
      }
    }
  });

  calendar.render();
});
    
  </script>
</head>

<body>
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/calendar.css') ?>" type="text/css">
  <div class="wraper">
    @include('sidebar')
    <div class="dashboard">
      <div id='calendar' style="width: 80%; margin: auto; margin-top:50px;"></div>
    </div>
  </div>
</body>

</html>