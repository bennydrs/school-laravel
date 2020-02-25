$(function () {
    var $now = moment();
    var $dateMin = $now.subtract(3, 'days');


    $('#datetimepicker').bootstrapMaterialDatePicker({
        format: 'MM/DD/YYYY HH:mm',
        shortTime: false,
        //minDate: $dateMin,
        //maxDate: null,
        //currentDate: $now,
        //disabledDays: [],
        date: true,
        time: true,
        monthPicker: false,
        year: true,
        clearButton: false,
        nowButton: false,
        switchOnClick: true,
        cancelText: 'Cancel',
        //okText: 'VALIDER',
        //clearText: 'EFFACER',
        //nowText: 'MAINTENANT',
        //triggerEvent: 'focus',
        //lang: 'en',
        //weekStart: 1,
    });

    $('#datetimepicker-fr').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        shortTime: false,
        clearButton: false,
        nowButton: false,
        cancelText: 'annuler',
        //okText: 'valider',
        //clearText: 'effacer',
        nowText: 'maintenant',
        lang: 'fr',
        weekStart: 1,
    });

    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        shortTime: false,
        date: false,
        time: true,
        monthPicker: false,
        year: false,
        switchOnClick: true
    });

    $('#datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        shortTime: false,
        date: true,
        time: false,
        monthPicker: false,
        year: false,
        switchOnClick: true,
    });

    $('#monthpicker').bootstrapMaterialDatePicker({
        format: 'MM',
        shortTime: false,
        date: false,
        time: false,
        monthPicker: true,
        year: false
    });

    $('#yearpicker').bootstrapMaterialDatePicker({
        format: 'YYYY',
        shortTime: false,
        date: false,
        time: false,
        monthPicker: false,
        year: true,
        switchOnClick: true,
    });
});
