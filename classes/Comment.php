<?php

include_once(__DIR__."/Db.php");

class Comment{
    private $user_id;
    private $post_id;
    private $text;

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

    public function save(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into comments (post_id, user_id, text) values (:post_id, :user_id, :text)");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->bindValue(":text", $this->getText());
        $statement->execute();
    }

    public static function getCommentsByPostId($post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from comments INNER JOIN `users` on `comments`.`user_id` = `users`.`id` where post_id = :post_id");
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}