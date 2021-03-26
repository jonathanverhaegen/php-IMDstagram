<?php 

class Messages{
    private $chat_id;
    private $text;

    /**
     * Get the value of chat_id
     */ 
    public function getChat_id()
    {
        return $this->chat_id;
    }

    /**
     * Set the value of chat_id
     *
     * @return  self
     */ 
    public function setChat_id($chat_id)
    {
        $this->chat_id = $chat_id;

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
}