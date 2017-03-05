<?php
include("../CommonPage/Config.php"); 
include("../CommonPage/SessionHelper.php"); 


if(!session_id()) {
    session_start();
}

$sessionHelper = new SessionHelper();
$userSessionId = $sessionHelper->get("CZUserSessionId")

require_once __DIR__ . '/lib/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();  
  
$permissions = ['email']; // Optional permissions  
$loginUrl = $helper->getLoginUrl('http://localhost:8080/web/ChineseZodiacVer2/fb-callback.php', $permissions);  
  
echo '<a href="' . htmlspecialchars($loginUrl) . '">Login with Facebook!</a>';  
?>