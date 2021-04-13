<?php
include_once(__DIR__."/Db.php");

class Post{
    private $user_id;
    private $text;
    private $time;
    private $image;

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
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public static function getAllForUser($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from posts where user_id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPostById($id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from posts where id IN :id");
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

        
    }
}