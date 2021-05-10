<?php

include_once("includes/autoloader.inc.php");

session_start();


    if(!empty($_POST)){

        

        //beginnen met de try

        try{

            $post = new Post();

            // $post->setFile($_FILES['file']);
            $file = $_FILES['file'];
            var_dump($file);
            
            $post->setFileName($file['name']);
            $post->setFileTmpName($file['tmp_name']);
            $post->setFileSize($file['size']);
            $post->setFileError($file['error']);
            $post->setFileType($file['type']);
            $post->setFileExt(explode('.', $post->getFileName()));
            $post->setFileActExt(strtolower(end($post->getFileExt())));

            if($post->isPostAllowed()){

                $fileNameNew = uniqid('', true).".".$post->getFileActExt();
                $fileDestination = 'images/'.$fileNameNew;

                $imgCompressed = Post::compressImage($post->getFileTmpName(),$fileDestination,20);
                var_dump($imgCompressed);

                // move_uploaded_file($post->getFileTmpName(), $fileDestination);

                $post->setDescription($_POST["description"]);
                $post->setImage($fileNameNew);
                $post->setUser_id($_SESSION["user"]);
                $post->setFilter($_POST["filter"]);
                $post->setLocation($_POST["location"]);
                $post->uploadPost($email);

                //kijken op tag al bestaat

                    $tag = $_POST["tag"];

                    $tags = explode(" ", $tag);

                    foreach($tags as $t){
                        $result = Tag::getTagByText($t);
                        if(!empty($result)){
                            

                            //post id gaan halen uit databse
                            //tag id gaan halen uit de database

                           
                            $idPost = $post->getIdByImage();
                            $idTag = $result[0]["id"];

                            //nieuwe posttag met de ids

                            $postTag = new PostTag();

                            $postTag->setPost_id($idPost["id"]);
                            $postTag->setTag_id($idTag);

                            $postTag->upload();


                        }else{

                            

                            //tag toevoegen aan de database

                            $newTag = new Tag();
                            $newTag->setText($t);
                            $textTag = $newTag->getText();
                            $newTag->uploadTag();

                            //post id gaan halen uit databse
                            //tag id gaan halen uit de database

                            $idPost = $post->getIdByImage();
                            $idTag = Tag::getTagByText($textTag);
                            
                            //nieuwe posttag met de ids
                            $postTag = new PostTag();

                            $postTag->setPost_id($idPost["id"]);
                            $postTag->setTag_id($idTag[0]["id"]);

                            
                            $postTag->upload();


            }


        }
        header("Location: index.php");
        
    }
    

        } catch(\Throwable $th){
            $error = $th->getMessage();
        }

        

    }

        

  


    $filters = Filter::getAllFilters(); 
    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/footer.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Upload post</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>



<div class="upload">
    <h2 class="title__upload">Upload a new post</h2>
    
    <div class="uploadPost__form">

            <form action="" method="post" enctype="multipart/form-data">

            <?php if(isset($error)): ?>

                <p id="message">Oops, there went something wrong:</p>
                <p id="errorMessage" ><?php echo $error ?></p>

            <?php endif; ?>

                <label for="file">Image</label>
                <input type="file" id="file" name="file">
            

                <label for="filter">Filter</label>
                <select id="filter" name="filter">
                <?php foreach($filters as $f): ?>
                    <option value="<?php echo $f["filter"] ?>"><?php echo $f["name"] ?></option>
                <?php endforeach; ?>
                    
                </select>


                <label for="description">Description</label>
                <textarea type="text" id="description" name="description" ></textarea>

                <label for="tag">Tag</label>
                <input type="text" id="tag" name="tag" >

                <label for="location">Location</label>
                <input type="text" id="location" name="location" >

                <div class="container_btn">
                <input class="btn__upload" type="submit" value="Upload">
                </div>


            </form>

        </div>
</div>




<?php include_once(__DIR__."/footer.php") ?>
<script src="js/app.js"></script>
    
</body>
</html>