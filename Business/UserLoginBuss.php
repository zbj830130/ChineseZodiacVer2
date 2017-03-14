<?php
if(!session_id()) {
    session_start();
}   

include(dirname(__FILE__).'/'."../CommonPage/Config.php"); 
include(dirname(__FILE__).'/'."../CommonPage/SessionHelper.php"); 
include(dirname(__FILE__).'/'."../DAO/UserLoginLogDAO.php"); 

$fblogin = new FaceBookLoginHelper();

$result= $fblogin->checkLogin($app_id,$app_secret,$CZUserSessionId,$websiteRoot);

if($result == false){
  echo  "<div class='layoutLogin'>
            <div class='loginButtonDiv'>
                <span>Login</span>
                <a href='".$fblogin->getJumpUrl()."'><img class='bfLogin' src='Img/fbLoginButton_normal.png' /></a>
            </div>
        </div>";
}
else{
    $sessionHelper = new SessionHelper();
    $guid = $sessionHelper->get($CZUserSessionId);
    
    $logDAO = new UserLoginLogDAO($serverName,$userName,$password,$databaseName);
    $token = $logDAO->queryUserInfoByGUID($guid);
    
    $results = explode("$",$fblogin->getUserNameAndUserId($app_id,$app_secret,$token));
    $logDAO->modifyUserIdAndUserName($guid,$results[0],$results[1]);
    echo "<div class='loginSubTitle'>
            <img src='http://graph.facebook.com/$results[0]/picture?type=small'></img>
            <span>$results[1]</span>
            <span class='logout' href='javascript:void(0);'>logout</span>
        </div>";
}

class FaceBookLoginHelper{
    private $jumpUrl = "";
    
    function getJumpUrl(){
        return $this->jumpUrl;
    }
    
    function checkLogin($app_id,$app_secret,$CZUserSessionId,$websiteRoot){
        $sessionHelper = new SessionHelper();
        $userSessionId = $sessionHelper->get($CZUserSessionId);
       
        require_once (dirname(__FILE__).'/'."../lib/Facebook/autoload.php");
        
        if($userSessionId == false){//need to login 
            $fb = new Facebook\Facebook([
                  'app_id' => $app_id,
                  'app_secret' => $app_secret,
                  'default_graph_version' => 'v2.5',
                ]);

            $helper = $fb->getRedirectLoginHelper();  
            $permissions = ['email']; // Optional permissions  
            $loginUrl = $helper->getLoginUrl($websiteRoot.'fb-callback.php', $permissions); 
            $this->jumpUrl = htmlspecialchars($loginUrl);
            
            return false;   
        }
        else{//check token
            return true;
        }
    }
    
    function getUserNameAndUserId($app_id,$app_secret,$token){
        $fb = new Facebook\Facebook([
          'app_id' => $app_id,
          'app_secret' => $app_secret,
          'default_graph_version' => 'v2.5',
        ]);
        $sessionHelper = new SessionHelper();
        try {
              $response = $fb->get('/me?fields=id,name',$token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {  
          echo 'Graph returned an error: ' . $e->getMessage();  
          exit;  
        } catch(Facebook\Exceptions\FacebookSDKException $e) {  
          echo 'Facebook SDK returned an error: ' . $e->getMessage();  
          exit;  
        }

        $user = $response->getGraphUser();
        return $user['id'].'$'.$user['name'];
    }
}







?>