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


    $numberOfPosts = count($posts);

    

    //badge systeem

        //land badge: aantal post uit een zelfde land

            //in welke landen zijn er posts gebeurd

        

        $countriesPosts = Post::getCountriesForUser($user_id);

            //hoeveel posts in dat land

            foreach($countriesPosts as $c){
                // echo $c["country"];
                $numberOfCountry = Post::countCountryForUser($user_id,$c["country"]);
                // echo $numberOfPosts;

                if($numberOfCountry > 1){
                    $countryBadge[] = $c["country"];
                    
                }

            }

       

        //travell badge: hoeveel keer in een bepaald land geweest

        $numberOfCountries = Post::numberOfCountries($user_id);
        // echo $numberOfCountries;

        if($numberOfCountries > 2){
            $travellerBadge = true;
        }
        


        //post badge: hoeveel keer een post gedaan
        if($numberOfPosts > 2){
            $postBadge = true;
        }

        //distance badge: hoeveel kilometer gereisd, hoeveel keer verschillende steden

        $numberOfCities = Post::countCitiesForUser($user_id);
        // echo $numberOfCities;

        if($numberOfCities > 5){
            $distanceBadge = true;
        }
        
        

        

        

    

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
        <div class="col-4"><img id="profileImage" src="images/<?php echo $user["avatar"] ?>" alt=""></div>
        <div class="col-8">
            
                <h5><?php echo $user["username"] ?></h5>
                <div class="userInfo">
                    <p><?php echo $numberOfPosts ?> <?php if($numberOfPosts === 1){echo "post";}else{echo "posts";}  ?> </p>
                    <p><?php echo $user["followers"] ?> volgers</p>
                    <p><?php echo $user["following"] ?> volgend</p>
                </div>
                <p><?php echo $user["bio"] ?></p>
                <p>
                    <?php if(isset($postBadge)){
                        echo "postbadge";
                    } ?>

                    <?php if(isset($countryBadge)){
                        foreach($countryBadge as $b){
                            echo $b."badge ";
                        }
                    } ?>

                    <?php if(isset($travellerBadge)){
                        echo "travellerbadge";
                    } ?>

                    <?php if(isset($distanceBadge)){
                        echo "distancebadge";
                    } ?>
                
                </p>
                
            
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
        
    </div>

        <?php endif; ?>
    <?php endforeach; ?>

<?php include_once(__DIR__."/footer.php") ?>
<script src="js/app.js"></script>
</body>
</html>