$(document).ready(function () {
    $('#deviceRegister').click(function (e) {
        if ($('#deviceNumber').val() == '') {
            alert('Device Number is Mandatory');
            e.preventDefault();
        }
    });
});