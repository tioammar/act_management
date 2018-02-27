document.addEventListener('DOMContentLoaded', function(){
  var datePicker = new bulmaCalendar( document.getElementById( 'datepicker' ), {
    // startDate: new Date(), // Date selected by default
    dateFormat: 'd M yyyy', // the date format `field` value
    // lang: 'en', // internationalization
    overlay: true,
    // closeOnOverlayClick: true,
    // closeOnSelect: true,
    // // callback functions
    // onSelect: null,
    // onOpen: null,
    // onClose: null,
    // onRender: null
  });
});