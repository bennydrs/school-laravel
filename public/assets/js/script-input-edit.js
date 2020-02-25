// datepicker
$('#tanggal_lahir').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    shortTime: false,
    date: true,
    time: false,
    monthPicker: false,
    year: true,
    switchOnClick: true,
});

// $('#jam_mulai').bootstrapMaterialDatePicker({
//     format: 'HH:mm',
//     shortTime: false,
//     date: false,
//     time: true,
//     monthPicker: false,
//     year: false,
//     switchOnClick: true
// });



// custom file input
$(document).ready(function () {
    bsCustomFileInput.init();
});
