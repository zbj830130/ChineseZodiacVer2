$(function () {
    //var names = ['Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake', 'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'];
    //var colors = ['#b25d25', '#808080', '#ffb61e', '#d41863', '#eacd76', '#8d4bbb', '#4169E1', '#00e09e', '#00e500', '#f00056', '#8A2BE2', '#fabc35


    initZodiacs();
    $("#tabs").tabs();

    $(".site_nav").removeClass("site_nav_static");
    $(".site_nav").addClass("site_nav_fixed");

    resizeLayoutLoginDiv();
    setSubTitlePosition();
    eventBinding();

});

function eventBinding() {
    $(window).resize(function () {
        resizeLayoutLoginDiv();
    });

    $(".bfLogin").hover(function () {
        $(this).attr("src", "Img/fbLoginButton_hover.png");
    }, function () {
        $(this).attr("src", "Img/fbLoginButton_normal.png");
    });

    $(".logout").click(function () {
        $.ajax({
            url: 'Business/user_logout.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            success: function (data) {
                location.reload();
            }
        });
    });

    $("#tabs [href='#tab-2']").click(function () {
        initZodiacs();
    });
}

function resizeLayoutLoginDiv() {
    if ($(".layoutLogin").length > 0) {
        $(".footer_background_img").offset().top;
        $(".layoutLogin").height($(".footer_background_img").offset().top - 110);
    }
}

function setSubTitlePosition() {
    if ($(".loginSubTitle").length > 0) {
        $(".nav_detail").append($(".loginSubTitle"));
    }
}

function initZodiacs() {
    $.ajax({
        url: 'Business/zodiac_orders.php?opType=1',
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            var names = new Array();
            var colors = new Array();
            var ids = new Array();

            $(data).each(function (i) {
                if (i > 0) {
                    names[this.sorting - 1] = this.name;
                    colors[this.sorting - 1] = this.color;
                    ids[this.sorting - 1] = this.id;
                }
            });

            zodiacSort(names, ids);
            colourSelector(names, colors, ids);
        }
    });
}

/** Zodiac Sort Function Start **/

function zodiacSort(names, ids) {
    var $list = $(".zodiacList");
    $list.empty();
    $("#prevSortings").val("");
    
    var prevOrders = [];
    for (var i = 0; i < 12; i++) {
        var name = names[i];
        var id = ids[i];
        prevOrders[i] = id;

        $list.append(
            $('<div class="items"><h3 class="item_title">Order:' + (i + 1) + '</h3><img src="Img/detail_' + name + '.gif"><input type="hidden" value="' + id + '"></div>')
        );
    }

    $("#prevSortings").val(prevOrders);
    $(".item_title").bind('mouseover', function () {
        $(this).css("cursor", "move")
    });


    $list.sortable({
        opacity: 0.6,
        revert: true,
        cursor: 'move',
        handle: '.item_title',
        update: function () {
            var new_order = [];
            $list.children(".items").each(function (index) {
                $(this).find(".item_title").text("Order:" + (index + 1));
                new_order[index] = $(this).find("input:hidden").val();
            });

            if (validateSortings($("#prevSortings").val(), new_order) == false) {
                return;
            }
            modifyZodiacSorting(new_order);
        }
    });
}

function validateSortings(prevSortings, newSortings) {
    var validateionResult = false;

    if (newSortings.length != 12) {
        return validateionResult;
    }

    for (var i = 0; i < 12; i++) {
        if (prevSortings[i] != newSortings[i]) {
            validateionResult = true;
            break;
        }
    }

    return validateionResult;
}

function modifyZodiacSorting(new_order) {
    var newSorting = JSON.stringify(new_order);

    $.ajax({
        url: 'Business/zodiac_orders.php?opType=2',
        type: 'POST',
        async: true,
        data: {
            data: newSorting
        },
        dataType: 'json',
        success: function (data) {

        }
    });
}

/** Zodiac Sort Function End **/


/** Zodiac Color Selector Function Start **/

function colourSelector(names, colors, ids) {
    var $colursList = $(".nameColourList");
    $colursList.empty();

    for (var i = 0; i < 12; i++) {
        var name = names[i];
        var color = colors[i];
        var id = ids[i]

        $colursList.append('<div class="nameColourItem"><input type = "radio" name = "nameColor" value = "' + name + '" /><label>' + name + '</label><div id="color_' + name + '" class="zodiacColourWatch"></div><input id="hiden_' + name + '" type="hidden" value="' + color + '_' + id + '"></div>');
        $('#color_' + name).css("background-color", color);
    }

    colourSelectorEventBinding();
}

function colourSelectorEventBinding() {

    $("#red, #green, #blue").slider({
        orientation: "horizontal",
        range: "min",
        max: 255,
        value: 127,
        slide: refreshSwatch,
        change: refreshSwatch
    });

    $("#red").slider("value", 0);
    $("#green").slider("value", 0);
    $("#blue").slider("value", 0);


    $("input[type=radio]").click(function () {
        zodiacRadioClick(this);
    });

    $(".hexColorInput").focusout(function () {
        var hexColor = $(this).val();
        var reg = /#([\da-f]{1}){6}/i;
        if (reg.test(hexColor) == true) {
            colorSelectorSetting(hexColor);
        };
    });

    $("#submitColor").click(function () {
        if ($("#zodiacName").val().length == 0) {
            alert("Please Select A Zodiac First");
            return;
        }
        var zodiacName = $("#zodiacName").val();
        var hex = "#" + hexFromRGB($("#red").slider("value"), $("#green").slider("value"), $("#blue").slider("value"));

        var color_id = $("#hiden_" + zodiacName).val();
        if (hex == color_id.split('_')[0]) {
            return;
        }

        $("#color_" + zodiacName).css("background-color", hex);
        $("#hiden_" + zodiacName).val(hex);

        var currentId = $("#currentId").val();
        submitColor(hex, currentId);
    });
}

function zodiacRadioClick(currentRadio) {
    var zodiacName = $(currentRadio).val();
    var color_id = $("#hiden_" + zodiacName).val();
    var hexColor = color_id.split('_')[0];
    var zodiacId = color_id.split('_')[1];

    colorSelectorSetting(hexColor);

    $("#currentId").val(zodiacId);
    $("#zodiacName").val(zodiacName);
    $(".hexColorInput").val(hexColor);
}

function colorSelectorSetting(hexColor) {
    var rgb = hexToRGB(hexColor);

    $("#red").slider("value", rgb.r);
    $("#green").slider("value", rgb.g);
    $("#blue").slider("value", rgb.b);

    $("#swatch").css("background-color", hexColor);
}

function hexFromRGB(r, g, b) {
    var hex = [
        r.toString(16),
        g.toString(16),
        b.toString(16)
      ];
    $.each(hex, function (nr, val) {
        if (val.length === 1) {
            hex[nr] = "0" + val;
        }
    });
    return hex.join("").toUpperCase();
}

function RGBColor(r, g, b) {
    this.r = r;
    this.g = g;
    this.b = b;
}

function hexToRGB(hex) {
    var r = parseInt(hex.slice(1, 3), 16),
        g = parseInt(hex.slice(3, 5), 16),
        b = parseInt(hex.slice(5, 7), 16);
    return new RGBColor(r, g, b);
}

function refreshSwatch() {
    var red = $("#red").slider("value"),
        green = $("#green").slider("value"),
        blue = $("#blue").slider("value"),
        hex = hexFromRGB(red, green, blue);
    $("#swatch").css("background-color", "#" + hex);
    $(".hexColorInput").val("#" + hex);
}

function submitColor(hexColor, currentId) {
    $.ajax({
        url: 'Business/zodiac_orders.php?opType=3',
        type: 'POST',
        async: true,
        data: {
            hexColor: hexColor,
            currentId: currentId
        },
        dataType: 'json',
        success: function (data) {
            if (data == false) {
                location.reload();
            } else {
                alert("Successed");
            }
        }
    });
}

/** Zodiac Color Selector Function End **/