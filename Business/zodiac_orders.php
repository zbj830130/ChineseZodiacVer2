<?php
    if (!isset($_SESSION))
    {
        session_start();//开启Session
    }

    include("../CommonPage/Config.php");
    include("../CommonPage/CheckLoginHelper.php");    
    include("../DAO/ZodiacDAO.php");
    include("../Model/ZodiacModel.php");

    $checkLoginHelper = new CheckLoginHelper();
    

    if($_GET['opType']==1){
        $dao = new ZodiacDAO($serverName,$userName,$password,$databaseName);
        $result =  $dao->queryZodiacInfo();
        
        if(empty($result) || count($result) != 13 ){
            $result = array(12);
            
            $colors = ['#b25d25', '#808080', '#ffb61e', '#d41863', '#eacd76', '#8d4bbb', '#4169E1', '#00e09e', '#00e500', '#f00056', '#8A2BE2', '#fabc35'];

            $names = ['Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake', 'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'];
            
            for($i=0;$i<12;$i++){
                $id= $i+1;
                $name=$names[$i];
                $color=$colors[$i];
                $sorting=$i+1;
                $item = new ZodiacModel($id,$name,$color,$sorting);
                $result[] = $item;
            }
        }
        echo json_encode($result);
        return;
    }

    if($checkLoginHelper->isLogin($CZUserSessionId) == false){
        echo "false" ;
    }else{
        if($_GET['opType']==2){
            $val = !empty($_POST['data']) ? $_POST['data'] : null; 
            $zodiacSortings = json_decode($val); //sorting array
            
            if(empty($zodiacSortings) || count($zodiacSortings) != 12){
                return "true";
            }
            
            $idCounts = [0,0,0,0,0,0,0,0,0,0,0,0];
            $isContinue = true;
            for($i=0;$i<12;$i++){
                $id = $zodiacSortings[$i];
                if($id<1 || $id >12){
                    $isContinue = false;
                    break;
                }
                
                $idCounts[$id-1] +=1;
            }
            
            if($isContinue == true){
               for($i=0;$i<12;$i++){
                    $idCount = $idCounts[$i];
                    if($idCount>1){
                        $isContinue = false;
                        break;
                    }
                } 
            }
            
            if($isContinue == false){
                echo 1;
                return "true";
            }
            
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