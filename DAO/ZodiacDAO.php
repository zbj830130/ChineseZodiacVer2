<?php
    include("../Model/ZodiacModel.php");
    include("../DAO/MySqlHelper.php");

    class ZodiacDAO{
        private $serverName;
        private $userName;
        private $password;
        private $databaseName;
        
        function __construct($serverName,$userName,$password,$databaseName){
            $this->serverName = $serverName;
            $this->userName = $userName;
            $this->password = $password;
            $this->databaseName = $databaseName;
        }
        
        public function queryZodiacInfo(){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            $sqlstr = "select * from ZodiacInfo";

            $result = $mysqlHelper->queryData($con,$sqlstr);

            $zodiacList = array(12);
            $i=0;
            while ($row=mysqli_fetch_assoc($result))
            {
                $id=$row['id'];
                $name=$row['name'];
                $color=$row['color'];
                $sorting=$row['sorting'];

                $item = new ZodiacModel($id,$name,$color,$sorting);
                $zodiacList[] = $item;
            }

            $mysqlHelper->closeConnection($con);
            return $zodiacList;
        }
        
        public function modifyZodiacSorting($newZodiacSortings){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            $sqlstr = "";
            
            for($i=0;$i<12;$i++){
                $sortingIndex = $i+1;
                $zodiacId = $newZodiacSortings[$i];
                $sqlstr .= "update ZodiacInfo set sorting='$sortingIndex' where id='$zodiacId';";
            }

            $result = $mysqlHelper->queryMultiData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
        
        public function modifyZodiacColor($hexColor,$currentId){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $hexColor = $hexColor;
            $currentId = $currentId;
            
            $sqlstr = "update ZodiacInfo set color='$hexColor' where id='$currentId';";

            $result = $mysqlHelper->queryData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
    }

    
?>