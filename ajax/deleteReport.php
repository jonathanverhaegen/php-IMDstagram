<?php

include_once(__DIR__."/../classes/Report.php");

if(!empty($_POST)){

    $postId = $_POST["post_id"];

    
    Report::deleteReport($postId);


    $response =[
        'status' => 'succes',
        'message' => 'post is now report free'
    ];

    header("Content-Type: application/json");
    echo json_encode($response);

}