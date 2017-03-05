<?php
    class MySqlHelper{
        public function openConnect($serverName,$userName,$password,$databasename){
            $con = mysqli_connect($serverName,$userName,$password,$databasename);
            if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
            
            return $con;
            //mysql_select_db($databasename, $con);
        }
        
        public function closeConnection($con){
            mysqli_close($con);
        }
        
        public function queryData($con,$sql){
            $result= $con->query($sql);
            return $result;
        }
        
        public function queryMultiData($con,$sql){
            $result= $con->multi_query($sql);
            return $result;
        }
    }
?>