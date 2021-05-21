<?php

    
include_once("includes/autoloader.inc.php");

    session_start();

    if(!isset($_SESSION["id"])){
        header("Location: login.php"); //redirect to login.php
    }else{
        $id = $_SESSION["id"];
    }
    
    if(!empty($_GET["city"])&& !empty($_GET["country"])){
        

        $city = $_GET["city"];
        $country = $_GET["country"];

        // echo $city;
        // echo $country;

        

       

        //alle posts met die location vinden in database

        $posts = Post::getPostByLocation($city, $country);

        

        

        
    }

   

    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/footer.css"/>
    <link rel="stylesheet" href="style/header.css"/>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title><?php echo $city.", ".$country; ?></title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<h1 class="title"><?php echo $city.", ".$country ?></h1>


<?php foreach($posts as $p): ?>
        <?php 

        
           $tags = Tag::getTagsByPostId($p[0]);

           $reports = Report::getReportsById($p[0]);

           $numberOfReports = count($reports);

           $numberOfLikes = Like::CountLikesForPost($p[0]);

           $likeByUser = Like::LikedByUser($id, $p[0]);

           $comments = Comment::getCommentsByPostId($p[0]);

           $numberOfComments = count($comments);

           if($numberOfReports < 3):

            
            ?>

    <div class="post">
    <span class="postTime"><?php echo Comment::humanTiming($p["time"])." ago"; ?></span>
        <div class="post__report">
            <a class="report" href="" data-postid="<?php echo $p[0];?>">Report</a>
        </div>
        <div class="post_user">
            <img class="post_avatar" src="images/<?php echo htmlspecialchars($p["avatar"]) ?>" alt="avatar">
            <a class="post_username" href="userpage.php?user=<?php echo $p["user_id"] ?>"><h2><?php echo htmlspecialchars($p["username"]) ?></h2></a>
        </div>
        
        <a class="btn-location" href="location.php?city=<?php echo $p["city"] ?>&country=<?php echo $p["country"] ?>"><p class="post__location"><?php echo htmlspecialchars($p["city"].", ".$p["country"]) ?></p></a>
        <figure class="<?php echo htmlspecialchars( $p["filter"]) ?>">
            <img class="post__image" src="images/<?php echo htmlspecialchars($p["image"]) ?>" alt="post">
        </figure>
        <p class="post_description"><?php echo htmlspecialchars($p["description"]) ?></p>
        <div class="post_tags">
            <?php foreach($tags as $t): ?>
            <?php $tWithouth = explode("#", $t["text"]); ?>
                <a href="tagpage.php?tag=<?php echo htmlspecialchars(end($tWithouth)); ?>"><?php echo htmlspecialchars($t["text"]); ?></a>
            <?php endforeach; ?>
        </div>

        <div class="likes">
                <?php if($likeByUser): ?>

                    <a style="<?php echo "display:none" ?>" class="btnLike" href="" data-userid="<?php echo $id ?>" data-postid="<?php echo $p[0] ?>"><img class="iconLike" src="images/like.svg" alt="like"></a>
                    <a style="<?php echo "display:block" ?>;" class="btnUnlike" href="" data-userid="<?php echo $id ?>" data-postid="<?php echo $p[0] ?>"><img class="iconLike" src="images/unlike.svg" alt="unlike"></a>
                
                <?php else: ?>

                <a class="btnLike" href="" data-userid="<?php echo $id ?>" data-postid="<?php echo $p[0] ?>"><img class="iconLike" src="images/like.svg" alt="like"></a>
                <a class="btnUnlike" href="" data-userid="<?php echo $id ?>" data-postid="<?php echo $p[0] ?>"><img class="iconLike" src="images/unlike.svg" alt="unlike"></a>
                
                <?php endif; ?>

                <p class="display-likes">
                    <?php if(empty($numberOfLikes)){
                     echo "0";
                    }else{
                        echo $numberOfLikes;
                    } ?>
                </p> 


                <a class="btnComment" href=""><img class="iconComment" src="images/comment.svg" alt="comment"></a>
                <p class="display-comments">

                <?php if(empty($numberOfComments)){

                    echo "0";
                }else{
                    echo $numberOfComments;
                } ?>
                
                </p>            
        </div>

        <div class="comment_input_field">
            <input data-userid="<?php echo $id ?>" data-postid="<?php echo $p[0] ?>" class="commentInput" name="comment" type="text" placeholder="leave a comment">
        </div>

        <ul class="comments">
        <?php foreach($comments as $c):?>
            <li class="comment">
                <img class="commentAvatar" src="images/<?php echo htmlspecialchars($c["avatar"]); ?>" alt="avatar">
                <a class="commentName" href="userpage.php?user=<?php echo $c["user_id"] ?>"><?php echo htmlspecialchars($c["username"]); ?></a>
                <p class="commentText"><?php echo htmlspecialchars($c["text"]); ?></p>
                <span class="commentTime"><?php echo Comment::humanTiming($c["time"])." ago"; ?></span>
            </li>
        <?php endforeach ?>
            
        </ul>
        
        
    </div>

        <?php endif; ?>
    <?php endforeach; ?>


    






<?php include_once(__DIR__."/footer.php") ?>

<script src="js/app.js"></script>
</body>
</html>