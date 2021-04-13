<?php

class PostTag{
    private $post_id;
    private $tag_id;

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
     * Get the value of tag_id
     */ 
    public function getTag_id()
    {
        return $this->tag_id;
    }

    /**
     * Set the value of tag_id
     *
     * @return  self
     */ 
    public function setTag_id($tag_id)
    {
        $this->tag_id = $tag_id;

        return $this;
    }

    public static function getPostIdByTagId($tag_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select post_id from posts_tags where tag_id = :tag_id");
        $statement->bindValue(":tag_id", $tag_id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}