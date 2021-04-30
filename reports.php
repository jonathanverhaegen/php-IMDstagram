<?php



    include_once("includes/autoloader.inc.php");


    session_start();

    

    if($_SESSION["user-type"] != "admin"){
        header("Location: index.php");
    }

    

    $posts = Post::getAllPosts();



    


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title>Reported posts</title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<h1 class="title">All the reported posts</h1>




    <?php foreach($posts as $p): ?>
        <?php 

        
           $tags = Tag::getTagsByPostId($p[0]);

           $reports = Report::getReportsById($p[0]);

           $numberOfReports = count($reports);

           
           if($numberOfReports >= 3):
            
            ?>

    <div class="post">
        <div class="admin__reports">
            <a id="deletePost" href="" data-postid="<?php echo $p["id"];?>">delete the post</a>
            <a id="postOk" href="" data-postid="<?php echo $p["id"];?>">the post is ok</a>
        </div>
        <div class="post_user">
            <img class="post_avatar" src="<?php echo $p["avatar"] ?>" alt="avatar">
            <a class="post_username" href="userpage.php?user=<?php echo $p["user_id"] ?>"><h2><?php echo $p["username"] ?></h2></a>
        </div>
        
        <p class="post__location"><?php echo $p["location"] ?></p>
        <figure class="<?php echo $p["filter"] ?>">
            <img class="post__image" src="<?php echo $p["image"] ?>" alt="post">
        </figure>
        <p class="post_description"><?php echo $p["description"] ?></p>
        <div class="post_tags">
            <?php foreach($tags as $t): ?>
            <?php $tWithouth = explode("#", $t["text"]); ?>
                <a href="tagpage.php?tag=<?php echo end($tWithouth); ?>"><?php echo $t["text"]; ?></a>
            <?php endforeach; ?>
        </div>
        
    </div>

       <?php endif; ?>
    <?php endforeach; ?>

<?php include_once(__DIR__."/footer.php") ?>

<script src="js/app.js"></script>

</body>
</html>