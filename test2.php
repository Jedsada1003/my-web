<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  
  <style>
    /* Customize event appearance */
    .fc-event {
        background-color: orange;
        border-color: orange;
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        editable: false, // Disable editing
        events: <?php echo json_encode($events); ?>,
        viewRender: function(view, element) {
          // Get today's date
          var today = moment().startOf('day');
          
          // Loop through each day element in the current view
          view.el.find('.fc-day').each(function() {
            var date = $(this).data('date'); // Get date for this day
            var cell = $(this); // The day's cell element
            
            // Check if this day is today and apply custom styling
            if (moment(date).isSame(today, 'day')) {
              cell.css('background-color', '#E9967A'); // Set background color
              cell.css('border-color', '#E9967A'); // Set border color (optional)
            }
          });
        }
      });
    });
  </script>
</head>
<body>

</body>
</html>
