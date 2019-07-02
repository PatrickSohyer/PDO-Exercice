$(function () {
    $('.modifyInfoPatients').hide();
    $('.buttonSendModify').hide();
    $('.modifyinfoAppointments').hide();
    $('.buttonModify').click(function () {
        $('.infoPatients').hide();
        $('.modifyInfoPatients').show();
        $('.buttonModify').hide();
        $('.buttonSendModify').show();
    });
    $('.buttonModify').click(function () {
        $('.infoAppointments').hide();
        $('.modifyinfoAppointments').show();
        $('.buttonModify').hide();
        $('.buttonSendModify').show();
    });
});