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
        $statement = $conn->prepare("select * from posts where user_id = :user_id order by time DESC");
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

    public function uploadPost(){

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into posts (user_id, text, time, image) values (:user_id, :text, :time, :image)");
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->bindValue(":text", $this->getText());
        $statement->bindValue(":time", $this->getTime());
        $statement->bindValue(":image", $this->getImage());

        $result = $statement->execute();

        return $result;

    }

    public static function getPostByTagName($tag){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` INNER JOIN `posts_tags` ON `posts_tags`.`post_id` = `posts`.`id` INNER JOIN `tags` ON `posts_tags`.`tag_id` = `tags`.`id` AND `tags`.`text` = :tag");
        $statement->bindValue(":tag", $tag);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;


    }

    public function getIdByImage(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT `id` FROM `posts` WHERE `image` = :image");
        $statement->bindValue(":image", $this->getImage());
        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }
}