<?php 

    class Db{

        private static $conn;

        public static function getConnection(){

            include_once(__DIR__."/../settings/settings.php");
            
            if(self::$conn == null){
                self::$conn = new PDO('mysql:host='.SETTINGS["db"]["host"].';dbname='.SETTINGS["db"]["name"], SETTINGS["db"]["user"], SETTINGS["db"]["password"]);
                return self::$conn;
            }
            else{
                return self::$conn;
            }
            $sql = "SELECT * FROM user_like";
            $result = $conn->query($sql);
            $count=$_POST['send'];
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                   $ncount=$row["count"];
                }
                $ncount+=1;
                $sql1="UPDATE user_like SET count=$ncount WHERE id=1";
                $result1=$conn->query($sql1);
                if($result1==TRUE){
                    echo $ncount;
                }else{
                    echo "fail";
                }
            
            }else{
                $sql="INSERT INTO user_like (count) VALUES ($count)";
                if($result=$conn->query($sql)==TRUE){
                    echo $count;
                }else{
                    echo "error";
                }
            }
        }
    }
    