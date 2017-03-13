<?php
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
        
        public function createDatabase(){
            $conn = new mysqli($this->serverName,$this->userName,$this->password);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "CREATE DATABASE ".$this->databaseName;
            $conn->query($sql);
            mysqli_close($conn);
        }
        
        public function createUserloginLogDatatable(){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $sqlstr = "CREATE TABLE `UserLoginLog` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `guid` varchar(50) CHARACTER SET utf8 NOT NULL,
                      `token` varchar(200) CHARACTER SET utf8 NOT NULL,
                      `userId` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;";
            
            $mysqlHelper->queryData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
        
        public function createZodiacInfoDatatable(){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $sqlstr = "CREATE TABLE `ZodiacInfo` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(15) NOT NULL,
                  `color` varchar(8) DEFAULT NULL,
                  `sorting` int(11) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;";

            $mysqlHelper->queryData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
        
        public function insertData(){
            $mysqlHelper = new MySqlHelper();
            $con = $mysqlHelper->openConnect($this->serverName,$this->userName,$this->password,$this->databaseName);
            
            $sqlstr = "INSERT INTO `ZodiacInfo` VALUES ('1', 'Rat', '#B25D25', '1'), ('2', 'Ox', '#808080', '2'), ('3', 'Tiger', '#ffb61e', '3'), ('4', 'Rabbit', '#D32FFF', '4'), ('5', 'Dragon', '#eacd76', '5'), ('6', 'Snake', '#8d4bbb', '6'), ('7', 'Horse', '#22ED15', '7'), ('8', 'Goat', '#00e09e', '8'), ('9', 'Monkey', '#00e500', '9'), ('10', 'Rooster', '#91C256', '10'), ('11', 'Dog', '#8A2BE2', '11'), ('12', 'Pig', '#fabc35', '12');";

            $mysqlHelper->queryData($con,$sqlstr);
            $mysqlHelper->closeConnection($con);
        }
    }

    
?>