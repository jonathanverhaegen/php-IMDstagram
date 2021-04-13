<?php 

class Message{

    private $text;
    private $sender_id;
    private $send_date;


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
     * Get the value of sender_id
     */ 
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * Set the value of sender_id
     *
     * @return  self
     */ 
    public function setSender_id($sender_id)
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    /**
     * Get the value of send_date
     */ 
    public function getSend_date()
    {
        return $this->send_date;
    }

    /**
     * Set the value of send_date
     *
     * @return  self
     */ 
    public function setSend_date($send_date)
    {
        $this->send_date = $send_date;

        return $this;
    }
}