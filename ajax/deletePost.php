<?php

include_once(__DIR__."/../includes/autoloader.inc.php");

if(!empty($_POST)){

    $postId = $_POST["post_id"];
    
    Report::deleteReport($postId);
    Post::deletePost($postId);
    


    $response =[
        'status' => "succes",
        "message" => "post is deleted"
    ];

    header("Content-Type: application/json");
    echo json_encode($response);

}