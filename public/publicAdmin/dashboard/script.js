$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: moment().format('YYYY-MM-DD'),
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'New Order',
                start: moment().subtract(2, 'days').format('YYYY-MM-DD')
            },
            {
                title: 'Product Launch',
                start: moment().add(1, 'days').format('YYYY-MM-DD')
            },
            {
                title: 'User Meeting',
                start: moment().add(5, 'days').format('YYYY-MM-DD')
            }
        ]
    });
});
