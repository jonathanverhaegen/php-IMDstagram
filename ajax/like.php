<?php

include_once(__DIR__."/../classes/Like.php");

if(!empty($_POST)){


   

    $like = new Like();

    $like->setPost_id($_POST["post_id"]);

    $like->setUser_id($_POST["user_id"]);

    $like->save();


    $response =[
        'status' => 'succes',
        'message' => 'post liked',
        'post'=> $like->getPost_id(),
        'user' => $like->getUser_id()
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

}