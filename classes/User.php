<?php

include_once(__DIR__."/Db.php");

class User{
    private $username;
    private $email;
    private $password;
    private $image;
    private $bio;
    private $status_id;

    private $oldEmail; 
    private $newEmail;
    private $newEmailCheck;
    

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

    /**
     * Get the value of oldEmail
     */ 
    public function getOldEmail()
    {
        return $this->oldEmail;
    }

    /**
     * Set the value of oldEmail
     *
     * @return  self
     */ 
    public function setOldEmail($oldEmail)
    {
        $this->oldEmail = $oldEmail;

        return $this;
    }

    /**
     * Get the value of newEmail
     */ 
    public function getNewEmail()
    {
        return $this->newEmail;
    }

    /**
     * Set the value of newEmail
     *
     * @return  self
     */ 
    public function setNewEmail($newEmail)
    {
        $this->newEmail = $newEmail;

        return $this;
    }

    /**
     * Get the value of newEmailCheck
     */ 
    public function getNewEmailCheck()
    {
        return $this->newEmailCheck;
    }

    /**
     * Set the value of newEmailCheck
     *
     * @return  self
     */ 
    public function setNewEmailCheck($newEmailCheck)
    {
        $this->newEmailCheck = $newEmailCheck;

        return $this;
    }

    public function editEmail( $email ) {
        try {
            $conn = Db::getConnection();
            $mailUpdateStmt = $conn->prepare( 'UPDATE users SET email=:newEmail WHERE email=:email' );
            $oldEmail = $this->getOldEmail();
            $newEmail = $this->getNewEmail();
            $newEmailCheck = $this->getNewEmailCheck();

            if ( $email === $oldEmail ) {
                if ( $newEmail === $newEmailCheck ) {
                    if ( preg_match( '|@student.thomasmore.be$|', $newEmail ) ) {
                        $mailUpdateStmt->bindValue( ':newEmail', $newEmail );
                        $mailUpdateStmt->bindValue( ':email', $email );
                        $updateEmailRes = $mailUpdateStmt->execute();
                        $_SESSION['user'] = $newEmail;

                        return $updateEmailRes;
                    } else {
                        throw new Exception( 'Email must end with @student.thomasmore.be' );
                    }
                } else {
                    throw new Exception( 'you did not repeat the correct email adress' );
                }
            } else {
                throw new Exception( 'this email does not exist in our database' );
            }
        } catch( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }
}