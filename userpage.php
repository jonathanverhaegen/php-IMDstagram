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
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/footer.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title><?php echo $user["username"] ?></title>
</head>
<body>

<?php include_once(__DIR__."/header.php") ?>

<div class="container" id="containerProfileInfo">
    <div class="row align-items-center" id="rowProfileInfo">
        <div class="col-4"><img id="profileImage" src="<?php echo $user["image"] ?>" alt=""></div>
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


<div class="container">
<div class="row">

    



    <?php foreach($posts as $p): ?>
        <div class="col-12 justify-content-center">
        <?php 

        

           $tags = Tag::getTagsByPostId($p[0]);
           

           $reports = Report::getReportsById($p[0]);
           

           $numberOfReports = count($reports);

           if($numberOfReports < 3 || $_SESSION["user-type"] === "admin"):

            
            ?>
        <a href="userpage.php?user=<?php echo $p["user_id"] ?>"><h2 style="margin-top:25px;"><?php echo $p["username"] ?></h2></a>
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

        <a id="report" href="#" data-postid="<?php echo $p["id"];?>">report</a>
        
    <?php endif; ?>
    </div>
    <?php endforeach; ?>
    
    

</div>
</div>

<?php include_once(__DIR__."/footer.php") ?>
<script src="js/app.js"></script>
</body>
</html>