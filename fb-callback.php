<?php
    if(!session_id()) {
        session_start();
    }   

    include("CommonPage/Config.php"); 
    include("CommonPage/GUIDHelper.php"); 
    include("CommonPage/SessionHelper.php"); 
    include("DAO/UserLoginLogDAO.php"); 
    require("lib/Facebook/autoload.php");

    $fb = new Facebook\Facebook([  
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v2.5',  
      ]);  

    $helper = $fb->getRedirectLoginHelper();  

    try {  
      $accessToken = $helper->getAccessToken();  
    } catch(Facebook\Exceptions\FacebookResponseException $e) {  
      // When Graph returns an error  
      echo 'Graph returned an error: ' . $e->getMessage();  
      exit;  
    } catch(Facebook\Exceptions\FacebookSDKException $e) {  
      // When validation fails or other local issues  
      echo 'Facebook SDK returned an error: ' . $e->getMessage();  
      exit;  
    }  

    if (! isset($accessToken)) {  
      if ($helper->getError()) {  
        header('HTTP/1.0 401 Unauthorized');  
        echo "Error: " . $helper->getError() . "\n";  
        echo "Error Code: " . $helper->getErrorCode() . "\n";  
        echo "Error Reason: " . $helper->getErrorReason() . "\n";  
        echo "Error Description: " . $helper->getErrorDescription() . "\n";  
      } else {  
        header('HTTP/1.0 400 Bad Request');  
        echo 'Bad request';  
      }  
      exit;  
    }

    $sessionHelper = new SessionHelper();
    $guidHelper = new GUIDHelper();
    $sessionId = $guidHelper->create_guid();
    $sessionHelper->set($CZUserSessionId,$sessionId);

    $logDAO = new UserLoginLogDAO($serverName,$userName,$password,$databaseName);
    $logDAO->insertUserInfo($sessionId,(string) $accessToken);

    $url = $websiteRoot."/Settings.php";  
    echo "<script type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";   

?>