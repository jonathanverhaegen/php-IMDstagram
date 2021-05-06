<?php

include_once(__DIR__."/../includes/autoloader.inc.php");

if(!empty($_POST)){


    $report = new Report();

    $report->setPost_id($_POST["post_id"]);

    $report->save();


    $response =[
        'status' => "succes",
        "message" => "post reported"
    ];

    header("Content-Type: application/json");
    echo json_encode($response);

}