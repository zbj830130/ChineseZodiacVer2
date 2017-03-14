<?php
include("../DAO/WebDatabaseSettingDAO.php");
function updateconfig($file, $ini, $value,$type="string") { 
    $str = file_get_contents($file); 
    $str2=""; 
    if($type=="int") 
    { 
        $str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=" . $value . ";", $str); 
    } 
    else 
    { 
        $str2 = preg_replace("/" . $ini . "=(.*);/", $ini . "=\"" . $value . "\";",$str); 
    } 

    file_put_contents($file, $str2); 
}

$serverName = $_GET['serverName'];
$userName = $_GET['userName'];
$password = $_GET['password'];
$websiteRoot = $_GET['websiteDomain'];
$isFirstTimeRunning = "no";

//modify database config file
updateconfig("../CommonPage/Config.php","serverName",$serverName);
updateconfig("../CommonPage/Config.php","userName",$userName);
updateconfig("../CommonPage/Config.php","password",$password);
updateconfig("../CommonPage/Config.php","websiteRoot",$websiteRoot);


$dao = new ZodiacDAO($serverName,$userName,$password,$databaseName);
$dao->createDatabase();

$dao->createZodiacInfoDatatable();
$dao->createUserloginLogDatatable();
$dao->insertData();

updateconfig("../CommonPage/Config.php","isFirstTime",$isFirstTimeRunning);
$url = "../home.php";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";  
?>