<?php
    if(!session_id()) {
        session_start();
    }   

    include(dirname(__FILE__).'/'."../CommonPage/Config.php"); 
    include(dirname(__FILE__).'/'."../CommonPage/SessionHelper.php"); 

    $sessionHelper = new SessionHelper();
    $sessionHelper->clear($CZUserSessionId);

    echo(1);

?>