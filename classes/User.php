<?php

include_once(__DIR__."/../includes/autoloader.inc.php");

class User{
    private $username;
    private $email;
    private $password;
    private $newPassword;
    private $confirmPassword;
    private $oldPassword;
    private $avatar;
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
     * Get the value of ConfirmPassword
     */ 
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of ConfirmPassword
     *
     * @return  self
     */ 
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

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

    public function save() 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'INSERT INTO users (email, firstName, lastName, password, description, avatar) VALUES (:email, :firstName, :lastName, :password, :description, :avatar)' );
            $email = $this->getEmail();
            // $firstName = $this->getFirstName();
            // $lastName = $this->getLastName();
            $password = $this->getPassword();
            $description = "here comes your description";
            $avatar = "Upload/standard.jpg";
      

        
            
        
            $statement->bindValue(":email", $email);
            // $statement->bindValue(":firstName", $firstName);
            // $statement->bindValue(":lastName", $lastName);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":avatar", $avatar);


            $result = $statement->execute();

            return $result;

        } catch ( PDOException $e ) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public static function getAll() 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'select * from users' );
        $statement->execute();
        $users = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $users;

    }

    public function viewEmail( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT email FROM users WHERE email = :yourEmail' );
            $statement->bindValue( 'yourEmail', $email );
            $statement->execute();
            while( $row = $statement->fetch() ) {
                $activeEmail = $row['email'];

                return $activeEmail;
            }
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function viewDescription( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT bio FROM users WHERE email = :currentEmail' );
            $statement->bindValue( ':currentEmail', $email );
            $statement->execute();
            while( $row = $statement->fetch() ) {
                $activeDescription = $row['bio'];

                return $activeDescription;
            }
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function editDescription( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $updateDesStmt = $conn->prepare( 'UPDATE users SET bio = :description WHERE email = :email' );
            $description = $this->getBio();
            $updateDesStmt->bindValue( ':description', $description );
            $updateDesStmt->bindValue( ':email', $email );
            $descrResult = $updateDesStmt->execute();

            return $descrResult;
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
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
                    
                        $mailUpdateStmt->bindValue( ':newEmail', $newEmail );
                        $mailUpdateStmt->bindValue( ':email', $email );
                        $updateEmailRes = $mailUpdateStmt->execute();
                        $_SESSION['user'] = $newEmail;

                        return $updateEmailRes;
                    
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

    public function changeAvatar( $email, $fileName, $fileSize, $fileTmpName, $file ) 
    {
        $conn = Db::getConnection();
        $profileStatement = $conn->prepare( 'UPDATE users SET avatar=:avatar WHERE email=:email' );
        $fileName = $fileName;
        $fileSize = $fileSize;
        $fileTmpName = $fileTmpName;
        $file = $file;
        $fileExt = explode( '.', $fileName );
        $fileExtention = strtolower( end( $fileExt ) );
        $allowedFiles = array( 'jpg', 'jpeg', 'png' );

        if ( in_array( $fileExtention, $allowedFiles ) ) {
            if ( $fileSize < 1000000 ) {
                $fileNewName = uniqid( '', true ).'.'.$fileExtention;
                $fileDestination = 'images/'.$fileNewName;
                move_uploaded_file( $fileTmpName, $fileDestination );
                $profileStatement->bindValue( ':avatar', $fileNewName );
                $profileStatement->bindValue( ':email', $email );
                $profileStatement->execute();
            } else {
                throw new Exception( 'filesize is to big!' );
            }
        } else {
            throw new Exception( 'this image type is not supported by imdstagram' );
        }
    }

    public function showAvatar( $email ) 
    {
        $conn = Db::getConnection();
        $avatarstmt = $conn->prepare( 'SELECT avatar FROM users WHERE email = :email' );
        $avatarstmt->bindValue( ':email', $email );
        $avatarstmt->execute();
        
        

        while( $row = $avatarstmt->fetch() ) {
            $showAvatar = $row['avatar'];

            return $showAvatar;
        }
    }

    //login functie ----------

    public function canLogin($email,$password) {

        $conn = Db::getConnection();
        $statement = $conn->prepare('select * from users where email = :email');
        $statement->bindParam(':email', $email);
        $result = $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $hash = $user['password'];
        
        if(password_verify($password, $hash)){   
                return true; 
        }
        else{
                return false;
            }
    }



    // registreren -------------

    public function registerUser() {

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into users (username,password,email, avatar) values (:username, :password, :email, :avatar )");
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $confirmPassword = $this->getConfirmPassword();
        $avatar = "standard.jpg";

            
    
        if(empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
                throw new Exception("All fields are required!");
                return false;
        } 
        
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Give a validate email!");
                return false;

        } 
        elseif($password != $confirmPassword){
                throw new Exception("Passwords don't match!");
                return false;
        }
        else {

            $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $hash);
            $statement->bindValue(":avatar", $avatar);
                
            $result = $statement->execute();
            return $result;
        }
    }


    public function login( $complete ) {
            session_start();

            $_SESSION['user'] = $this->getEmail();
            if ( $complete ) {
                header( 'Location: index.php' );

            } else {
                header( 'Location: login.php' );
            }
        }


    public static function getIdByEmail($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $result = $statement->fetch();

        return $result["id"];

        
    }


    /**
     * Get the value of newPassword
     */ 
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @return  self
     */ 
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function changePassword( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $updateDesStmt = $conn->prepare( 'UPDATE users SET password = :password WHERE password = :oldPassword AND email = :email' );
            $password = password_hash($this->getNewPassword(), PASSWORD_DEFAULT, ['cost' => 13]);
            $oldPassword = password_hash($this->getOldPassword(), PASSWORD_DEFAULT, ['cost' => 13]);
            $updateDesStmt->bindValue( ':oldPassword', $oldPassword );
            $updateDesStmt->bindValue( ':password', $password );
            $updateDesStmt->bindValue( ':email', $email );
            $descrResult = $updateDesStmt->execute();

            return $descrResult;
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }



    /**
     * Get the value of oldPassword
     */ 
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set the value of oldPassword
     *
     * @return  self
     */ 
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }
    }



    
