<?php
include_once(__DIR__."/Db.php");

class Tag{
    private $text;
    

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

    public static function getAllTags(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from tags");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getTagByText($tag){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from tags where text = :text");
        $statement->bindValue(":text", $tag);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

        
    }

    

    public function uploadTag(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into tags (text) values (:text)");
        $statement->bindValue(":text", $this->getText());
        return $statement->execute();
    }
}