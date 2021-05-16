<?php
// include_once(__DIR__."/../includes/autoloader.inc.php");
include_once(__DIR__."/Db.php");

class Post{
    private $user_id;
    private $description;
    private $time;
    private $image;
    
    private $city;
    private $country;
    private $country_code;
    private $filter;

    private $file;
    private $fileName;
    private $fileTmpName;
    private $fileSize;
    private $fileError;
    private $fileType;
    private $fileExt;
    private $fileActExt;
    

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
     * Get the value of text
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setDescription($description)
    {

        if(empty($description)){
            // description kan niet leeg zijn
            throw new Exception("Description cannot be empty");
        }

        $this->description = $description;
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
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {

        if(empty($city)){
            // city kan niet leeg zijn
            throw new Exception("City cannot be empty");
        }
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        if(empty($country)){
            // country kan niet leeg zijn
            throw new Exception("country cannot be empty");
        }
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of filter
     */ 
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set the value of filter
     *
     * @return  self
     */ 
    public function setFilter($filter)
    {
        if(empty($filter)){
            // filter kan niet leeg zijn
            throw new Exception("Please choose a filter");
        }

        $this->filter = $filter;

        return $this;
    }

     /**
     * Get the value of country_code
     */ 
    public function getCountry_code()
    {
        return $this->country_code;
    }

    /**
     * Set the value of country_code
     *
     * @return  self
     */ 
    public function setCountry_code($country_code)
    {

        if(empty($country_code)){
            // country code kan niet leeg zijn
            throw new Exception("Country code cannot be empty");
        }
        $this->country_code = $country_code;

        return $this;
    }







    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

     /**
     * Get the value of fileName
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of fileTmpName
     */ 
    public function getFileTmpName()
    {
        return $this->fileTmpName;
    }

    /**
     * Set the value of fileTmpName
     *
     * @return  self
     */ 
    public function setFileTmpName($fileTmpName)
    {
        $this->fileTmpName = $fileTmpName;

        return $this;
    }

    /**
     * Get the value of fileSize
     */ 
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set the value of fileSize
     *
     * @return  self
     */ 
    public function setFileSize($fileSize)
    {
        //als foto groter is 
        if($fileSize > 50000000){
            throw new Exception("image size is to big");
        }

        $this->fileSize = $fileSize;
        return $this;
    }

    /**
     * Get the value of fileError
     */ 
    public function getFileError()
    {
        return $this->fileError;
    }

    /**
     * Set the value of fileError
     *
     * @return  self
     */ 
    public function setFileError($fileError)
    {
        if($fileError != 0){
            throw new Exception("there was an error uploading the image");
        }

        $this->fileError = $fileError;

        return $this;
    }

    /**
     * Get the value of fileType
     */ 
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set the value of fileType
     *
     * @return  self
     */ 
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get the value of fileExt
     */ 
    public function getFileExt()
    {
        return $this->fileExt;
    }

    /**
     * Set the value of fileExt
     *
     * @return  self
     */ 
    public function setFileExt($fileExt)
    {
        $this->fileExt = $fileExt;

        return $this;
    }

    /**
     * Get the value of fileActExt
     */ 
    public function getFileActExt()
    {
        return $this->fileActExt;
    }

    /**
     * Set the value of fileActExt
     *
     * @return  self
     */ 
    public function setFileActExt($fileActExt)
    {
        $this->fileActExt = $fileActExt;

        return $this;
    }

    

    //functies

    public static function getAllForUser($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id` INNER JOIN `filters` on `posts`.`filter_id` = `filters`.`id` where `users`.`id` = :user_id order by time desc ");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getPostById($id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from posts where id IN :id");
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

        
    }

    public function uploadPost(){

        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO `posts`(`user_id`, `description`, `time`, `image`, `filter_id`, `city`, `country`, `country_code`) VALUES (:user, :text, sysdate(), :image, (select id from filters where filter = :filter), :city, :country, :country_code)");
        $statement->bindValue(":user", $this->getUser_id());
        $statement->bindValue(":text", $this->getDescription());
        $statement->bindValue(":image", $this->getImage());
        $statement->bindValue(":filter", $this->getFilter());
        $statement->bindValue(":city", $this->getCity());
        $statement->bindValue(":country", $this->getCountry());
        $statement->bindValue(":country_code", $this->getCountry_code());
        

        $result = $statement->execute();

        return $result;

    }

    public static function getPostByTagName($tag){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id` INNER JOIN `filters` on `posts`.`filter_id` = `filters`.`id` INNER JOIN `posts_tags` ON `posts_tags`.`post_id` = `posts`.`id` INNER JOIN `tags` ON `posts_tags`.`tag_id` = `tags`.`id` AND `tags`.`text` = :tag order by time desc");
        $statement->bindValue(":tag", $tag);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;


    }

    public function getIdByImage(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT `id` FROM `posts` WHERE `image` = :image");
        $statement->bindValue(":image", $this->getImage());
        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    public static function getAllPosts(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id` INNER JOIN `filters` on `posts`.`filter_id` = `filters`.`id` order by time desc");
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
    }

    public static function deletePost($id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("delete from posts where id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        
    }

    public static function getPostByLocation($city, $country){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` INNER JOIN `users` ON `posts`.`user_id` = `users`.`id` INNER JOIN `filters` on `posts`.`filter_id` = `filters`.`id` where `city` = :city AND `country` = :country order by time desc ");
        $statement->bindValue(":city", $city);
        $statement->bindValue(":country", $country);
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;

    }

    public function isPostAllowed(){
        $allowed = array("jpg", "png", "jpeg", "gif");

        if(in_array($this->getFileActExt(), $allowed)){
            return true;
        }else{
            throw new Exception("the file is not supported");
        }
    }

    public static function compressImage($source, $destination, $quality){

        // info van de image
        $info = getimagesize($source);
        $mime = $info['mime']; 

        
        //nieuwe image createn
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            case 'image/jpg':
                $image = imagecreatefromjpeg($source);
                break;
            default: 
                $image = imagecreatefromjpeg($source); 
        }

        
        // Save image 
        imagejpeg($image, $destination, $quality);

        // Return compressed image 
        return $destination; 
        

    }

    public static function getPostsByCountry($user_id,$country){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `posts` WHERE `user_id` = :user_id AND location LIKE :country");
        $statement->bindvalue(":user_id", $user_id);
        $statement->bindvalue(":country", '%'.$country.'%');
        $statement->execute();

        $result = $statement->fetchAll();
        $numberOfResults = count($result);

        return $numberOfResults;
    }


    public static function getCountriesForUser($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT DISTINCT country, country_code FROM posts WHERE `user_id` = :user_id ");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function countCountryForUser($user_id, $country){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * from posts WHERE `user_id` = :user_id AND `country` = :country ");
        $statement->bindValue(":user_id", $user_id);
        $statement->bindvalue(":country", $country);
        $statement->execute();
        $result = $statement->fetchAll();

        $numberOfResults = count($result);
        return $numberOfResults;


    }

    public static function numberOfCountries($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT DISTINCT country FROM posts WHERE `user_id` = :user_id ");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll();

        $number = count($result);

        return $number;
    }

    public static function countCitiesForUser($user_id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT DISTINCT city FROM posts WHERE `user_id` = :user_id ");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll();

        $number = count($result);

        return $number;
    }
    

    

   
}