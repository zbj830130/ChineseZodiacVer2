<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="gb2312">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chinese Zodiac</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="JS/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="CSS/main.css?r=<?php echo $css_version;?>" type="text/css" />
    <link rel="stylesheet" href="CSS/settings.css?r=<?php echo $css_version;?>" type="text/css" />
    <link rel="stylesheet" href="CSS/jquery-ui.min.css" type="text/css" />
</head>

<body>
    <?php include 'Business/user_login.php' ?>
        <header class="site_nav">
            <?php include "CommonPage/Header.php"?>
        </header>
        <contain class="contain">
            <div id="tabs">
                <ul>
                    <li><a href="#tab-1">Zodiac Order Setting</a></li>
                    <li><a href="#tab-2">Zodiac Colours Setting</a></li>
                </ul>
                <div id="tab-1" class="zodiacList">
                </div>

                <div id="tab-2" class="zodiacColour">
                    <div class="colorSelecter">
                        <input type="hidden" id="zodiacName">
                        <div id="red"></div>
                        <div id="green"></div>
                        <div id="blue"></div>
                        <div id="hexColor">
                            Hex Color:
                            <input type="text" class="hexColorInput" />
                        </div>
                        <div id="swatch" class="ui-widget-content ui-corner-all"></div>
                        <a href="javascript:void(0)">
                            <img src="Img/submit.png" id="submitColor" />
                        </a>

                        <input type="hidden" id="currentId" />
                    </div>
                    <div class="nameColourList">
                    </div>
                </div>
            </div>
            <input id="prevSortings" type="hidden" />
        </contain>
        <footer>
            <?php include 'CommonPage/Footer.php' ?>
        </footer>
        <script type="text/javascript" src="JS/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="JS/jquery-ui.min.js"></script>
        <script type="text/javascript" src="JS/settings.js?r=<?php echo $javasrcipt_version;?>"></script>
        <script type="text/javascript" src="JS/sendMessage.js?r=<?php echo $javasrcipt_version;?>"></script>
</body>

</html>