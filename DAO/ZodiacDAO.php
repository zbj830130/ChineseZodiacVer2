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
            
            $stmt = $con->prepare("update ZodiacInfo set sorting=? where id=?;");
            $stmt->bind_param("ii", $sorting, $id);
            
            for($i=0;$i<12;$i++){
                $sorting = $i+1;
                $id = $newZodiacSortings[$i];
                $stmt->execute();  
            }
            
            $stmt->close();  
        }
        
        public function modifyZodiacColor($hexColor,$currentId){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $stmt = $con->prepare("update ZodiacInfo set color=? where id=?;");
            $stmt->bind_param("si", $updateColor, $id);
            $updateColor=$hexColor;
            $id=$currentId;
            $stmt->execute();  
            $stmt->close();  
        }
    }

    
?>