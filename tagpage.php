<?php

    
include_once(__DIR__."/classes/Post.php");
include_once(__DIR__."/classes/Tag.php");
include_once(__DIR__."/classes/User.php");
include_once(__DIR__."/classes/Report.php");
    
    if(!empty($_GET["tag"])){
        

        $tagWithout = $_GET["tag"];

        $tag = "#".$tagWithout;

        //alle posts met die tag vinden in database

        $posts = Post::getPostByTagName($tag);

        var_dump($posts);

        
        
       
        

        
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
        <div class="col-12"><h2 id="tagTitle"><?php echo $tag?></h2></div>
    </div>
</div>



<div class="container">
<div class="row">

    



    <?php foreach($posts as $p): ?>
        <div class="col-12 justify-content-center">
        <?php 

           
           
           $tags = Tag::getTagsByPostId($p["post_id"]);

           $reports = Report::getReportsById($p["post_id"]);

           $numberOfReports = count($reports);

           
           if($numberOfReports < 3 || $_SESSION["user-type"] === "admin"):

            
            ?>
        <h2 style="margin-top:25px;"><?php echo $p["username"] ?></h2>
        <figure style="height:250px; width:250px;" class="<?php echo $p["filter"] ?>">
        <img style="height:250px; width:250px;" src="<?php echo $p["image"] ?>" alt="">
        </figure>
        <p><?php echo $p["description"] ?></p>
        <div style="display:flex; gap:5px;">

        <?php foreach($tags as $t): ?>
        <?php $tWithouth = explode("#", $t["text"]); ?>
            <a style="text-decoration:none;" href="tagpage.php?tag=<?php echo end($tWithouth); ?>"><?php echo $t["text"]; ?></a>
        <?php endforeach; ?>
        </div>

        <a id="report" href="#" data-postid="<?php echo $p["post_id"];?>">report</a>
        
    <?php endif; ?>
    </div>
    <?php endforeach; ?>
    
    

</div>
</div>
    
    

</div>
</div>




<script src="js/app.js"></script>
</body>
</html>