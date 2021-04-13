<?php

class MessageUser{
    private $user_id;
    private $message_id;
    

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
     * Get the value of message_id
     */ 
    public function getMessage_id()
    {
        return $this->message_id;
    }

    /**
     * Set the value of message_id
     *
     * @return  self
     */ 
    public function setMessage_id($message_id)
    {
        $this->message_id = $message_id;

        return $this;
    }
}