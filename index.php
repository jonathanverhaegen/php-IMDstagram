<?php

    

    include_once(__DIR__."/classes/Post.php");
    include_once(__DIR__."/classes/Tag.php");
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Report.php");

    session_start();

    $user = User::getUser(1);

    $_SESSION["user-type"] = $user["type"];


    

    $posts = Post::getAllPosts();
    

    
    
    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>report</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>


<h1 style="text-align:center; margin-top:50px;">Posts</h1>




<div class="container">
<div class="row">

    



    <?php foreach($posts as $p): ?>
        <div class="col-12 justify-content-center">
        <?php 

           $user_id = $p["user_id"]; 
           $user = User::getUser($user_id);
           
           $tags = Tag::getTagsByPostId($p["id"]);

           $reports = Report::getReportsById($p["id"]);

           $numberOfReports = count($reports);

           
           if($numberOfReports < 3 || $_SESSION["user-type"] === "admin"):

            
            ?>
        <h2 style="margin-top:25px;"><?php echo $user["username"] ?></h2>
        <img style="height:250px; width:250px;" src="<?php echo $p["image"] ?>" alt="">
        <p><?php echo $p["description"] ?></p>
        <div style="display:flex; gap:5px;">

        <?php foreach($tags as $t): ?>
        <?php $tWithouth = explode("#", $t["text"]); ?>
            <a style="text-decoration:none;" href="tagpage.php?tag=<?php echo end($tWithouth); ?>"><?php echo $t["text"]; ?></a>
        <?php endforeach; ?>
        </div>

        <a id="report" href="#" data-postid="<?php echo $p["id"];?>">report</a>
        
    <?php endif; ?>
    </div>
    <?php endforeach; ?>
    
    

</div>
</div>


<?php if($_SESSION["user-type"] === "admin"): ?>
<div class="container">
    <div class="row">

        <div class="col"><h1>reported posts</h1></div>
    
    </div>

    <div class="row">

    <?php foreach($posts as $p): ?>
        <div class="col-12">
        <?php 

           $user_id = $p["user_id"]; 
           $user = User::getUser($user_id);
           
           $tags = Tag::getTagsByPostId($p["id"]);

           $reports = Report::getReportsById($p["id"]);

           $numberOfReports = count($reports);

           
           if($numberOfReports >= 3):

            
            ?>
        <h2 style="margin-top:25px;"><?php echo $user["username"] ?></h2>
        <img style="height:250px; width:250px;" src="<?php echo $p["image"] ?>" alt="">
        <p><?php echo $p["description"] ?></p>
        <div style="display:flex; gap:5px;">

        <?php foreach($tags as $t): ?>
        <?php $tWithouth = explode("#", $t["text"]); ?>
            <a style="text-decoration:none;" href="tagpage.php?tag=<?php echo end($tWithouth); ?>"><?php echo $t["text"]; ?></a>
        <?php endforeach; ?>
        </div>

        <!-- <a id="report" href="#" data-postid="<?php echo $p["id"];?>">report</a> -->

        
        <a id="deletePost" href="#" data-postid="<?php echo $p["id"];?>">delete the post</a>
        <a id="postOk" href="#" data-postid="<?php echo $p["id"];?>">the post is ok</a>
        
        </form>
        
    <?php endif; ?>
    </div>
    <?php endforeach; ?>

    </div>
</div>
<?php endif; ?>

<script src="js/app.js"></script>




    
</body>
</html>