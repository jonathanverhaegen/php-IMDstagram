<?php

include_once(__DIR__."/../classes/Post.php");
include_once(__DIR__."/../classes/PostTag.php");

if(!empty($_POST)){

    $postId = $_POST["post_id"];

    
    PostTag::deletePostTag($postId);
    Post::deletePost($postId);

    


    $response =[
        "status" => "success",
        "message" => "post is deleted"
    ];

    header("Content-Type: application/json");
    echo json_encode($response);

}