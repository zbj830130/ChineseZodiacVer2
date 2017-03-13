<?php
$style='style="color:#ae1718";';
$href='';
$url = $_SERVER['REQUEST_URI'];
if(strpos($url,'Settings')){
    $style3=$style.' href="javascript:void(0);"';
    $href="home.php";
}else{
    $style3=' href="Settings.php"';
}


    echo '<div class="nav_detail alignCenter">
            <img src="Img/icon.png" />
            <ul>
                <li><a id="homeLink" href="'.$href.'#tt_conver">HOME</a></li>
                <li><a id="summaryLink" href="'.$href.'#summaryContain">SUMMARY</a></li>
                <li><a id="detailLink" href="'.$href.'#detailContain">DETAIL</a></li>
                <li><a '.$style3.'>SETTING</a></li>
            </ul>
        </div>';
?>