<?php

include_once(__DIR__."/../classes/Post.php");
include_once(__DIR__."/../classes/Report.php");
include_once(__DIR__."/../classes/PostTag.php");

if(!empty($_POST)){

    $postId = $_POST["post_id"];
    
    Report::deleteReport($postId);
    PostTag::deletePostTag($postId);
    Post::deletePost($postId);

    


    $response =[
        "status" => "succes",
        "message" => "post is deleted"
    ];

    header("Content-Type: application/json");
    echo json_encode($response);

}