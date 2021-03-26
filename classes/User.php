<?php 

class User{
    private $username;
    private $password;
    private $email;
    private $profilepic;
    private $bio;
    private $map;
    private $followers;
    private $following;
    private $badges;
    private $friends;
    private $favorites;
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
     * Get the value of profilepic
     */ 
    public function getProfilepic()
    {
        return $this->profilepic;
    }

    /**
     * Set the value of profilepic
     *
     * @return  self
     */ 
    public function setProfilepic($profilepic)
    {
        $this->profilepic = $profilepic;

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
     * Get the value of map
     */ 
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set the value of map
     *
     * @return  self
     */ 
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get the value of followers
     */ 
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Set the value of followers
     *
     * @return  self
     */ 
    public function setFollowers($followers)
    {
        $this->followers = $followers;

        return $this;
    }

    /**
     * Get the value of following
     */ 
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * Set the value of following
     *
     * @return  self
     */ 
    public function setFollowing($following)
    {
        $this->following = $following;

        return $this;
    }

    /**
     * Get the value of badges
     */ 
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * Set the value of badges
     *
     * @return  self
     */ 
    public function setBadges($badges)
    {
        $this->badges = $badges;

        return $this;
    }

    /**
     * Get the value of friends
     */ 
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Set the value of friends
     *
     * @return  self
     */ 
    public function setFriends($friends)
    {
        $this->friends = $friends;

        return $this;
    }

    /**
     * Get the value of favorites
     */ 
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * Set the value of favorites
     *
     * @return  self
     */ 
    public function setFavorites($favorites)
    {
        $this->favorites = $favorites;

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
}