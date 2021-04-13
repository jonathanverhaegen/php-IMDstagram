<?php

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

    public static function getTagByText($text){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from tags where text = :text");
        $statement->bindValue(":text", $text);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}