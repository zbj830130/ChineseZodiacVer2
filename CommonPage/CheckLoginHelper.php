<?php
require("SessionHelper.php");

/**
 * Session helper
 */
class CheckLoginHelper{

    /**
     * set session
     * @param String $name   session name
     * @param Mixed  $data   session data
     * @param Int    $expire million
     */
    public function isLogin($sessionName){
        $sessionHelper = new SessionHelper();
        $guid = $sessionHelper->get($sessionName);
    
        if($guid == false){
            return false;
        }
        
        return true;
    }
}
?>