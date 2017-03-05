<?php
    include("../CommonPage/Config.php");    
    include("../DAO/ZodiacDAO.php");

    if($_GET['opType']==1){
        $dao = new ZodiacDAO($serverName,$userName,$password,$databaseName);
        echo json_encode($dao->queryZodiacInfo());
    }

    if($_GET['opType']==2){
        $val = !empty($_POST['data']) ? $_POST['data'] : null; 
        $zodiacSortings = json_decode($val); //sorting array
        
        $dao=new ZodiacDAO($serverName,$userName,$password,$databaseName);
        $dao->modifyZodiacSorting($zodiacSortings);
    }

    if($_GET['opType']==3){
        $hexColor = !empty($_POST['hexColor']) ? $_POST['hexColor'] : null; 
        $currentId = !empty($_POST['currentId']) ? $_POST['currentId'] : null; 
       
        $dao=new ZodiacDAO($serverName,$userName,$password,$databaseName);
        $dao->modifyZodiacColor($hexColor,$currentId);
    }
?>