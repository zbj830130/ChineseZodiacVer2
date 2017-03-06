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
            $tokeId="";
            
            $stmt = $con->prepare("select * from UserLoginLog where guid=?;");
            $stmt->bind_param("s", $guId);
            $guId=$guid;
            
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row=mysqli_fetch_assoc($result))
            {
                $tokeId=$row['token'];
            }

            $stmt->close(); 
            return $tokeId;
        }
        
        public function insertUserInfo($sessionId,$token){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);

            $stmt = $con->prepare("insert into UserLoginLog(guid,token) values(?,?)");
            $stmt->bind_param("ss", $guid,$tokn);
            
            $guid = $sessionId;
            $tokn = $token ;
            
            $stmt->execute();
            $stmt->close(); 
        }
        
        public function modifyUserIdAndUserName($guid,$userId,$userName){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $stmt = $con->prepare("update UserLoginLog set userId=? where guid=?");
            $stmt->bind_param("ss", $uId,$guid);
            
            $uId = $userId;
            $guid = $guid ;
            
            $stmt->execute();
            $stmt->close(); 
        }
    }

    
?>