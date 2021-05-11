<?php
// include_once(__DIR__."/../includes/autoloader.inc.php");
include_once(__DIR__."/Db.php");

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


    public function upload(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into posts_tags (post_id, tag_id) values (:post_id, :tag_id)");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":tag_id", $this->getTag_id());
        $statement->execute();

    }

    public static function deletePostTag($post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("DELETE FROM `posts_tags` WHERE post_id = :post_id");
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
    }

    
}