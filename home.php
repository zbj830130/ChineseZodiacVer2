<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chinese Zodiac</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="JS/html5shiv.js"></script>
    <![endif]-->
    <?php include 'CommonPage/Config.php' ?>
        <link rel="stylesheet" href="CSS/main.css?r=<?php echo $css_version;?>" type="text/css" />
        <link rel="stylesheet" href="CSS/home.css?r=<?php echo $css_version;?>" type="text/css" />
        <link rel="stylesheet" href="CSS/detail.css?r=<?php echo $css_version;?>" type="text/css" />
        <link rel="stylesheet" href="CSS/conver.css?r=<?php echo $css_version;?>" type="text/css" />
</head>

<body>
    <div id="homeContain" name="homeContain" class="conver">
        <div>
            <img class="alignCenter" src="Img/title.png">
        </div>
        <div class="cover_text">
            <span class="cover_tip">What is your Zodiac?</span>
        </div>
    </div>
    <!--top transparent conver start-->
    <div id="tt_conver" name="tt_conver" class="tt_conver"></div>
    <!--top transparent conver end-->
    <div class="body_div">
        <!--navigation start-->
        <nav class="site_nav alignCenter">
            <?php include 'CommonPage/Header.php' ?>
        </nav>
        <!--navigation end-->
        <!--Summary start-->
        <contain id="summaryContain" name="summaryContain" class="summaryContain alignCenter">
            <div class="bigIcon_div border_gray">
                <img src="Img/bigIcon.png" class="zodiac_cycle" />
            </div>
            <div class="home_artical border_gray">
                <h2>Summary</h2>
                <p>The Chinese zodiac or shengxiao (/shnng-sshyaoww/ ‘born resembling’) is a classification scheme that assigns an animal and its reputed attributes to each year in a repeating 12-year cycle. The 12-year cycle is an approximation to the 11.86-year orbital period of Jupiter, the largest planet of the solar system.</p>
                <p>It and its variations remain popular in several East Asian countries including China, Vietnam, Burma, Korea, Japan, Mongolia, Nepal, Bhutan, Sri Lanka, Cambodia, Laos and Thailand as well as the Buddhist calendar.</p>
                <p>The 12 zodiac animals are, in order: Rat, Ox, Tiger, Rabbit, Dragon, Snake, Horse, Goat, Monkey, Rooster, Dog, and Pig.</p>

            </div>
            <div class="home_lunar_calendar border_gray">
                <label>Data:</label>
                <select id="select_year"></select>
                <select id="select_month"></select>
                <select id="select_day"></select>

                <div class="zodiac_div">
                    <a href="javascript:void(0)">
                        <img src="Img/zodiac-calculator-search-button.png" id="lunar_submit" class="zodiac_caculat_img" />
                    </a>
                </div>
                <label id="result_label"></label>
            </div>

        </contain>

        <!--Summary end-->
        <!--Detail start-->
        <contain id="detailContain" name="detailContain" class="detailContain alignCenter">
            <div id="wheelDiv" class="masonryItem"></div>
        </contain>
        <!--Detail end-->
        <!--Footer start-->
        <footer class="clearfix">
                    <?php include 'CommonPage/Footer.php' ?>
        </footer>
        <!--Footer end-->

    </div>
    <!--bottom transparent conver start-->
    <div class="bt_conver"></div>
    <!--bottom transparent conver end-->
    <div class="backConver">
        <img class="alignCenter" src="Img/backConver.png">
    </div>

    <script type="text/javascript" src="JS/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="JS/home.js?r=<?php echo $javasrcipt_version;?>"></script>
    <script type="text/javascript" src="JS/CalConv.js?r=<?php echo $javasrcipt_version;?>"></script>
    <script type="text/javascript" src="JS/raphael.min.js"></script>
    <script type="text/javascript" src="JS/raphael.icons.min.js"></script>
    <script type="text/javascript" src="JS/wheelnav.min.js"></script>
    <script type="text/javascript" src="JS/detail.js?r=<?php echo $javasrcipt_version;?>"></script>
    <script type="text/javascript" src="JS/sendMessage.js?r=<?php echo $javasrcipt_version;?>"></script>
</body>

</html>