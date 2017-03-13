$(function () {
    initTimeSelector();
    eventbindings();
    caculateNavStely();
    pagelinkStyle();
});

function caculateNavStely() {
    var itemOffsetTop = $(".tt_conver").offset().top;
    var itemOuterHeight = $(".tt_conver").outerHeight();
    var winHeight = $(window).height();
    var winScrollTop = $(window).scrollTop();

    if (!(winScrollTop > itemOffsetTop + itemOuterHeight) && !(winScrollTop < itemOffsetTop - winHeight)) { // navigation is unfixed
        $(".site_nav").removeClass("site_nav_fixed");
        $(".site_nav").addClass("site_nav_static");
        $(".summaryContain").css('margin-top', '2vh');
        $(".conver").show();
        $(".backConver").hide();
    } else { //navigation is fixed
        $(".site_nav").removeClass("site_nav_static");
        $(".site_nav").addClass("site_nav_fixed");
        $(".summaryContain").css('margin-top', '25vh');
        $(".conver").hide();
        $(".backConver").show();
    }

}

function pagelinkStyle() {
    var summaryRelativeTop = $("#summaryContain")[0].getBoundingClientRect().top;
    var detailRelativeTop = $("#detailContain")[0].getBoundingClientRect().top;

    var winHeight = $(window).height();
    var winScrollTop = $(window).scrollTop();

    var isHomeLinkRed = false;
    var isDetailLinkRed = false;
    var isSummaryLinkRed = false;

    if ($(".site_nav").hasClass("site_nav_static")) {
        isHomeLinkRed = true;
    }

    if (isHomeLinkRed == false) {
        if (detailRelativeTop > winHeight / 2) {
            isSummaryLinkRed = true;
            isDetailLinkRed = false;
        } else {
            isDetailLinkRed = true;
            isSummaryLinkRed = false;
        }
    }

    if (isHomeLinkRed) {
        $("#homeLink").css("color", "#ae1718");
    } else {
        $("#homeLink").css("color", "#292929");
    }

    if (isSummaryLinkRed) {
        $("#summaryLink").css("color", "#ae1718");
    } else {
        $("#summaryLink").css("color", "#292929");
    }

    if (isDetailLinkRed) {
        $("#detailLink").css("color", "#ae1718");
    } else {
        $("#detailLink").css("color", "#292929");
    }
}

function initTimeSelector() {
    for (var i = 1937; i <= 2030; i++) {
        $('#select_year').append($('<option>', {
            value: i,
            text: i
        }));
    }

    for (var i = 1; i <= 12; i++) {
        var monthNames = ["Jan.", "Feb.", "Mar.", "Apr.", "May", "June", "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec."];
        var name = monthNames[i - 1];
        $('#select_month').append($('<option>', {
            value: i,
            text: name
        }));
    }

    for (var i = 1; i <= 31; i++) {
        $('#select_day').append($('<option>', {
            value: i,
            text: i
        }));
    }
};

function eventbindings() {
    $(window).scroll(function () {
        caculateNavStely();
        pagelinkStyle();
    });

    $(window).resize(function () {
        caculateDetilContainHeight();
    });

    $('#select_month').change(function () {
        $('#select_day').find('option').remove();
        var year = $("#select_year option:selected").text();
        var month = $("#select_month option:selected").val();
        var maxDay = getMaxDay(year, month - 1);

        for (var i = 1; i <= maxDay; i++) {
            $('#select_day').append($('<option>', {
                value: i,
                text: i
            }));
        }
    });

    $("#lunar_submit").click(function () {
        var year = $("#select_year option:selected").text();
        var month = $("#select_month option:selected").val();
        var day = $("#select_day option:selected").val();

        $("#result_label").show().text("The Zodiac is " + CalConv(year, month, day));
    });
}

function caculateDetilContainHeight() {
    var footerOffsetTop = $(".footer_background_img").offset().top;
    var wheelDivOffsetTop = $("#wheelDiv").offset().top;
    $("#detailContain").height(footerOffsetTop - wheelDivOffsetTop);
}