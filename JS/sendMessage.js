$(function () {
    $("#sendMessage").click(function () {
        var subject = $("#txtSubject").val();
        var message = $("#txtMessage").val();
        var mailtoAttr = "mailto:?subject=" + subject + "&body=" + message;

        $(this).attr("href", mailtoAttr);
    })

});