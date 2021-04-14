<?php

include_once(__DIR__."/classes/Post.php");
include_once(__DIR__."/classes/Tag.php");
include_once(__DIR__."/classes/PostTag.php");


    if(!empty($_POST["description"])){

        
        
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));

        $allowed = array("jpg", "png", "jpeg", "gif");

        if(in_array($fileActExt, $allowed)){
            
            if($fileError === 0){

                if($fileSize < 1000000){

                    $fileNameNew = uniqid('', true).".".$fileActExt;

                    $fileDestination = 'images/'.$fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    //upload the file to db posts

                    $post = new Post();

                    $post->setUser_id(1);
                    $post->setText($_POST["description"]);

                    $dateUnix = new DateTime();
                    $post->setTime($dateUnix->format('Y-m-d H:i:s') . "\n");
                    
                    $post->setImage($fileDestination);

                    $post->uploadPost();

                    
                    //kijken op tag al bestaat

                    $tag = $_POST["tag"];

                    $tags = explode(" ", $tag);

                    foreach($tags as $t){
                        $result = Tag::getTagByText($t);
                        if(!empty($result)){
                            echo "bestaat";

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

                            echo "bestaat niet";

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
                


                    // header("Location: userpage.php?user_id=".$post->getUser_id());


                }else{
                    $error = "file is to big to upload";
                }
                

            }else{
                $error = "there was an error uploading the file";
            
            }
        }else{
            $error = "files are not supported";
            
        }
    }else{
        $error = "description cannot by empty";
    }

    


        
        
        
        
        
        

        
      
       
    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Upload post</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<div class="container" id="containerUploadPost">

    <div class="row">
        <div class="col-12"><h2 id="titleUpload">Upload a new post</h2></div>
    </div>

    <div class="row">
        <div class="col-12" id="uploadPost">

            <form action="" method="post" enctype="multipart/form-data">

            <?php if(isset($error)): ?>

                <p id="message">Oops, there went something wrong:</p>
                <p id="errorMessage" ><?php echo $error ?></p>

            <?php endif; ?>

                <label for="file">Image</label>
                <input type="file" id="file" name="file">
            

                <label for="filter">Filter</label>
                <select id="filter" name="filter">
                    <option value="none">Geen Filter</option>
                    <option value="zwart-wit">Zwart-wit</option>
                    <option value="sepia">Sepia</option>
                </select>


                <label for="description">Description</label>
                <input type="text" id="description" name="description" >

                <label for="tag">Tag</label>
                <input type="text" id="tag" name="tag" >

                <label for="location">Location</label>
                <input type="text" id="location" name="location" >

                <div class="container_btn">
                <input class="btn_upload" type="submit" value="Upload">
                </div>


            </form>





        </div>
    </div>


</div>






    
</body>
</html>