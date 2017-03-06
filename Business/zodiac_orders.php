<?php
    if (!isset($_SESSION))
    {
        session_start();//开启Session
    }

    include("../CommonPage/Config.php");
    include("../CommonPage/CheckLoginHelper.php");    
    include("../DAO/ZodiacDAO.php");

    $checkLoginHelper = new CheckLoginHelper();
    

    if($_GET['opType']==1){
        $dao = new ZodiacDAO($serverName,$userName,$password,$databaseName);
        echo json_encode($dao->queryZodiacInfo());
        return;
    }

    if($checkLoginHelper->isLogin($CZUserSessionId) == false){
        echo "false" ;
    }else{
        if($_GET['opType']==2){
            $val = !empty($_POST['data']) ? $_POST['data'] : null; 
            $zodiacSortings = json_decode($val); //sorting array

            $dao=new ZodiacDAO($serverName,$userName,$password,$databaseName);
            $dao->modifyZodiacSorting($zodiacSortings);

            echo "true" ;
        }

        if($_GET['opType']==3){
            $hexColor = !empty($_POST['hexColor']) ? $_POST['hexColor'] : null; 
            $currentId = !empty($_POST['currentId']) ? $_POST['currentId'] : null; 

            $dao=new ZodiacDAO($serverName,$userName,$password,$databaseName);
            $dao->modifyZodiacColor($hexColor,$currentId);

            echo "true" ;
        }
    }
?>