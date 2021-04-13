<?php

class CommentTag{
    private $comment_id;
    private $tag_id;

    /**
     * Get the value of comment_id
     */ 
    public function getComment_id()
    {
        return $this->comment_id;
    }

    /**
     * Set the value of comment_id
     *
     * @return  self
     */ 
    public function setComment_id($comment_id)
    {
        $this->comment_id = $comment_id;

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
}