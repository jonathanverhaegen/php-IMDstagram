<?php
include_once(__DIR__."/Db.php");

class Filter{
    


    public static function getAllFilters(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from filters");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}