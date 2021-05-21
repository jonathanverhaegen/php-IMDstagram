<?php

session_start();

    if(!isset($_SESSION["id"])){
        header("Location: login.php"); //redirect to login.php
    }else{
        $id = $_SESSION["id"];
    }

include_once("includes/autoloader.inc.php");

    if(!empty($_GET["user"])){
        $user_id = $_GET["user"];
        $user = User::getUser($_GET["user"]);
        $posts = Post::getAllForUser($user["id"]);
    }

    if($user_id === $id){
        $profile = true;
    }

    


    $numberOfPosts = count($posts);
        
    //badge systeem

        //coutry badge: aantal posts in hetzelfde land
        $countryBadge = Badge::countryBadge($user_id); 
       
        //travell badge: hoeveel keer in een bepaald land geweest
        $travellerBadge = Badge::travellerbadge($user_id);

        //post badge: hoeveel keer een post gedaan
        $postBadge = Badge::postBadge($numberOfPosts);
        
        //distance badge: hoeveel kilometer gereisd, hoeveel keer verschillende steden
        $distanceBadge = Badge::distancebadge($user_id);     

    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style/header.css"/>
    <link rel="stylesheet" href="style/footer.css"/>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title><?php echo $user["username"] ?></title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<div style="margin-bottom:50px;" id="containerProfileInfo">
    <div class="row align-items-start" id="rowProfileInfo">
        <div class="col-lg-4"><img id="profileImage" src="images/<?php echo $user["avatar"] ?>" alt=""></div>
        <div class="col-lg-8">
            
                <h5><?php echo $user["username"] ?></h5>
                <div class="userInfo">
                    <p><?php echo $numberOfPosts ?> <?php if($numberOfPosts === 1){echo "post";}else{echo "posts";}  ?> </p>
                    <p><?php echo $user["followers"] ?> volgers</p>
                    <p><?php echo $user["following"] ?> volgend</p>
                </div>
                <p><?php echo $user["bio"] ?></p>
                <p>
                
                <?php if(isset($postBadge)){
                        echo $postBadge;
                    } ?>
                        

                    <?php if(isset($countryBadge)): ?>
                        <?php foreach($countryBadge as $b):?>
                            
                            <a class="badges" href="" title="<?php echo $b["country"] ?> badge: Make more than 2 posts in this country"><img  src="https://flagcdn.com/20x15/<?php echo $b["country_code"] ?>.png"
                                srcset="https://flagcdn.com/40x30/<?php echo $b["country_code"] ?>.png 2x,
                                https://flagcdn.com/60x45/<?php echo $b["country_code"] ?>.png 3x"
                                width="20"
                                height="15"
                                alt="<?php echo $b ?>"></a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if(isset($travellerBadge)){
                        echo $travellerBadge;
                    }?>
                        

                    <?php if(isset($distanceBadge)){
                        echo $distanceBadge;
                    }?>
                
                </p>
                
            
        </div>
        <?php if(isset($profile)): ?>
        <div id="editbtn" >
            <a style="    color: #fff; background: rgb(17, 248, 140); padding: 4px 14px; border-radius: 70px;" href="editProfile.php">Edit profile</a>
        </div>
        <?php endif; ?>
    </div>
    
</div>





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