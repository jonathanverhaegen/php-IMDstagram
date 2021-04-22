<?php

include_once(__DIR__."/Db.php");

class User{
    private $username;
    private $email;
    private $password;
    private $image;
    private $bio;
    private $status_id;
    

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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

    /**
     * Get the value of bio
     */ 
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */ 
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get the value of status_id
     */ 
    public function getStatus_id()
    {
        return $this->status_id;
    }

    /**
     * Set the value of status_id
     *
     * @return  self
     */ 
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;

        return $this;
    }

    public static function getUser($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}