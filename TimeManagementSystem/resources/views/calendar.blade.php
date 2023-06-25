<!doctype html>
<html lang="en">

<head>
  @include('header')
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar')
      const calendar = new FullCalendar.Calendar(calendarEl, {
        height: 850,
        initialView: 'dayGridMonth',
        events: [
          {
            title: 'event test',
            start: '2023-06-20',
            description: 'test 123'
          },
          {
            title: 'event test2',
            start: '2023-06-20',
            description: 'test 123'
          }
        ],
        eventClick: function(info) {
          console.log(info.event.extendedProps.description)
          alert('Event: ' + info.event.title);
        }
      })
      calendar.render()
    })
    
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