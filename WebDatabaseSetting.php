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
    <link rel="stylesheet" href="CSS/webDatabaseSetting.css" type="text/css" />

</head>

<body>
    <header class="site_nav">
    </header>
    <contain class="contain">
        <div class="settingDiv">
            <span>CHINESE ZODIAC DATABASE SETTING</span>
            <form action="Business/WebDatabaseSettingBuss.php" method="get">
                <label>Servername:</label>
                <input type="text" id="serverName" name="serverName" placeholder="localhost:3306"/>
                <p></p>
                <label>Username:</label>
                <input type="text" id="userName" name="userName" placeholder="root"/>
                <p></p>
                <label>Password:</label>
                <input type="text" id="password" name="password" placeholder="mike123"/>
                <p></p>
                <label>Website Domain:</label>
                <input type="text" id="websiteDomain" name="websiteDomain" placeholder="http://localhost:8080/ChineseZodiacVer2"/>
                <p></p>
                <button type="submit">Submmit</button>
                
            </form>
        </div>
    </contain>
    <footer>
    </footer>
    <script type="text/javascript" src="JS/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="JS/jquery-ui.min.js"></script>
</body>

</html>