<?php
include_once(__DIR__."/Db.php");

class Like{
    private $user_id;
    private $post_id;

    

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

    public function save(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into  likes (post_id, user_id) values (:post_id, :user_id)");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->execute();
    }

    public function delete(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("delete from likes where post_id = :post_id AND user_id = :user_id");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->execute();
    }
    

    public static function CountLikesForPost($post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from likes where post_id = :post_id");
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
        $result = $statement->fetchAll();

        $numberOfLikes = count($result);
        return $numberOfLikes;
    }

    public static function likedByUser($user_id, $post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from likes where user_id = :user_id and post_id = :post_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
        $result = $statement->fetchAll();

        

        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
}