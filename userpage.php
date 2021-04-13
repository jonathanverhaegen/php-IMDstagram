<?php

    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Post.php");

    if(!empty($_GET["user_id"])){
        $user = User::getUser($_GET["user_id"]);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Profile</title>
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
                    <p>7 volgers</p>
                    <p>7 volgend</p>
                </div>
                <p><?php echo $user["bio"] ?></p>
                
            
        </div>
    </div>
</div>

<div class="container" id="containerImageFeed" >
    <div class="row" id="imageFeed" >
        <?php foreach($posts as $p): ?>
        <div class="col-4"><img id="feedImage" src="<?php echo $p["image"] ?>" alt="post"></div>
        <?php endforeach; ?>
        
    </div>
</div>


    
</body>
</html>