<?php

    
    include_once(__DIR__."/classes/Post.php");
    include_once(__DIR__."/classes/PostTag.php");
    include_once(__DIR__."/classes/Tag.php");

    if(!empty($_GET["tag"])){
        $tag = Tag::getTagByText($_GET["tag"]);
        $post_id = PostTag::getPostIdByTagId($tag["id"]);
       
        
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
    <title>tag</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<div class="container" id="containerTag">
    <div class="row">
        <div class="col-12"><h2 id="tag"><?php echo $tag["text"] ?></h2></div>
    </div>
</div>

<div class="container" id="containerImageFeed" >
    <div class="row" id="imageFeed" >
        
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        <div class="col-4"><img id="feedImage" src="images/1.jpg" alt="post"></div>
        
        
    </div>
</div>




    
</body>
</html>