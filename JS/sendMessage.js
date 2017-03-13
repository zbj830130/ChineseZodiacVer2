$(function () {
    $("#sendMessage").click(function () {
        var subject = $("#txtSubject").val();
        var message = $("#txtMessage").val();
        var mailtoAttr = "mailto:zbj830130@gmail.com?subject=" + subject + "&body=" + message;

        $(this).attr("href", mailtoAttr);
    });
});