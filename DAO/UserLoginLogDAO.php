<?php
    include("MySqlHelper.php");

    class UserLoginLogDAO{
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
        
        public function queryUserInfoByGUID($guid){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            $sqlstr = "select * from UserLoginLog where guid='$guid'";

            $result = $mysqlHelper->queryData($con,$sqlstr);

            $zodiacList = array(12);
            $tokeId="";
            while ($row=mysqli_fetch_assoc($result))
            {
                $tokeId=$row['token'];
            }

            $mysqlHelper->closeConnection($con);
            return $tokeId;
        }
        
        public function insertUserInfo($sessionId,$token){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            $sqlstr = "insert into UserLoginLog(guid,token) values('$sessionId','$token')";

            $result = $mysqlHelper->queryData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
        
        public function modifyUserIdAndUserName($guid,$userId,$userName){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            $sqlstr = "update UserLoginLog set userId='$userId' where guid='$guid'";
            try {  
            $result = $mysqlHelper->queryData($con,$sqlstr);
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            $mysqlHelper->closeConnection($con);
        }
    }

    
?>