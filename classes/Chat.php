<?php

class Chat{
    private $user1_id;
    private $user2_id;
    private $date;
    private $time;

    /**
     * Get the value of user1_id
     */ 
    public function getUser1_id()
    {
        return $this->user1_id;
    }

    /**
     * Set the value of user1_id
     *
     * @return  self
     */ 
    public function setUser1_id($user1_id)
    {
        $this->user1_id = $user1_id;

        return $this;
    }

    /**
     * Get the value of user2_id
     */ 
    public function getUser2_id()
    {
        return $this->user2_id;
    }

    /**
     * Set the value of user2_id
     *
     * @return  self
     */ 
    public function setUser2_id($user2_id)
    {
        $this->user2_id = $user2_id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

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
}