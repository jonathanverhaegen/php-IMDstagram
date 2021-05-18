<?php

// include_once(__DIR__."./../includes/autoloader.inc.php");
include_once(__DIR__."/Db.php");

class Report{
    private $post_id;
    private $user_id;
    private $date;

    /**
     * Get the value of post_id
     */ 
    public function getPost_id()
    {
        return $this->post_id;
    }

    /**
     * Set the value of post_id
     *
     * @return  self
     */ 
    public function setPost_id($post_id)
    {
        $this->post_id = $post_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function save(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into reports (post_id, user_id, date) values (:post_id, :user_id, sysdate())");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->execute();
    }

    public static function getReportsById($id){

        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from reports where post_id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    public static function deleteReport($post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("DELETE FROM `reports` WHERE `post_id` = :post_id");
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
    }

    public function checkreport(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `reports` WHERE post_id = :post_id AND user_id = :user_id ");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->execute();
        $result = $statement->fetch();
        return $result;

        
    }

    
}