<?php

include_once( __DIR__ . '/Db.php' );

class Search {
    private $searchTerm;
    private $category;
    private $currentEmail;
   
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory( $category )
    {
        $category = preg_replace( '/[^a-z-A-Z]/', '', $category );
        $this->category = $category;

        return $this;
    }

    public function getSearchTerm()
    {
        return $this->searchTerm;
    }

    public function setSearchTerm( $searchTerm )
    {
        $searchTerm = preg_replace( '/[^a-z-A-Z]/', '', $searchTerm );
        $this->searchTerm = $searchTerm;
    }

    public function getCurrentEmail()
    {
        return $this->currentEmail;
    }

    public function setCurrentEmail( $currentEmail )
    {
        $this->currentEmail = $currentEmail;

        return $this;
    }

    public function goSearch()
    {
        $currentEmail = $this->getCurrentEmail();
        $category = $this->getCategory();
        $searchTerm = $this->getSearchTerm();
        $conn = Db::getConnection();
        $statement = $conn->prepare( "SELECT `id`,`email`,`firstName`,`lastName`,`music`,`movies`,`games`,`tvShows`,`books`,`buddy`,`avatar`,`description` FROM `users` WHERE `email` != :currentEmail && `$category` like '%$searchTerm%' " );
        $statement->bindValue( ':currentEmail', $currentEmail );
        $statement->execute();
        $result = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $result;
    }
}