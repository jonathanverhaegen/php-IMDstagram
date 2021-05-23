<?php

include_once(__DIR__."/Db.php");

class Comment{
    private $user_id;
    private $post_id;
    private $text;

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

    public function save(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into comments (post_id, user_id, text, time) values (:post_id, :user_id, :text, sysdate())");
        $statement->bindValue(":post_id", $this->getPost_id());
        $statement->bindValue(":user_id", $this->getUser_id());
        $statement->bindValue(":text", $this->getText());
        $statement->execute();
    }

    public static function getCommentsByPostId($post_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from comments INNER JOIN `users` on `comments`.`user_id` = `users`.`id` where post_id = :post_id");
        $statement->bindValue(":post_id", $post_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    public static function humanTiming ($date)
        {
            $time = strtotime($date);
            $time = time() - $time + 7200; // to get the time since that moment
            
            $time = ($time<1)? 1 : $time;
            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
            }

        }
}