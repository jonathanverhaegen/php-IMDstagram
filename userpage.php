<?php

include_once("includes/autoloader.inc.php");

    if(!empty($_GET["user"])){
        $user = User::getUser($_GET["user"]);
        $posts = Post::getAllForUser($user["id"]);
    }


    $numberOfPosts = count($posts);

    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <!-- <link rel="stylesheet" href="style/header.css"/> -->
    <!-- <link rel="stylesheet" href="style/footer.css"/> -->
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
    <title><?php echo $user["username"] ?></title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<div style="margin-bottom:50px;" id="containerProfileInfo">
    <div class="row align-items-center" id="rowProfileInfo">
        <div class="col-4"><img id="profileImage" src="<?php echo $user["avatar"] ?>" alt=""></div>
        <div class="col-8">
            
                <h5><?php echo $user["username"] ?></h5>
                <div class="userInfo">
                    <p><?php echo $numberOfPosts ?> berichten</p>
                    <p><?php echo $user["followers"] ?> volgers</p>
                    <p><?php echo $user["following"] ?> volgend</p>
                </div>
                <p><?php echo $user["bio"] ?></p>
                
            
        </div>
    </div>
</div>





<?php foreach($posts as $p): ?>
        <?php 

        

        
           $tags = Tag::getTagsByPostId($p[0]);

           $reports = Report::getReportsById($p[0]);

           $numberOfReports = count($reports);
          

           if($numberOfReports < 3):

            
            ?>

    <div class="post">
        <div class="post__report">
            <a class="report" href="" data-postid="<?php echo $p[0];?>">Report</a>
        </div>
        <div class="post_user">
            <img class="post_avatar" src="<?php echo htmlspecialchars($p["avatar"]) ?>" alt="avatar">
            <a class="post_username" href="userpage.php?user=<?php echo $p["user_id"] ?>"><h2><?php echo htmlspecialchars($p["username"]) ?></h2></a>
        </div>
        
        <a class="btn-location" href="location.php?location=<?php echo $p["location"] ?>"><p class="post__location"><?php echo htmlspecialchars($p["location"]) ?></p></a>
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
        
    </div>

        <?php endif; ?>
    <?php endforeach; ?>

<?php include_once(__DIR__."/footer.php") ?>
<script src="js/app.js"></script>
</body>
</html>