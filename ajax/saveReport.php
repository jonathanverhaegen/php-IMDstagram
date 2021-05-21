<?php

include_once(__DIR__."/../classes/Report.php");

if(!empty($_POST)){


    $report = new Report();

    $report->setPost_id($_POST["post_id"]);
    $report->setUser_id($_POST["user_id"]);

    //post id gaan halen in de database

    $checkReport = $report->checkReport();

    //kijken of deze persoon die al gereport heeft

    //wel niet meer toevoegen

    //niet: toevoegen

    if($checkReport === false){
        $report->save();

        $response =[
            'status' => 'success',
            'message' => 'post reported'
        ];
    }else{
        $response =[
            'status' => 'success',
            'message' => 'post was already reported'
        ];
    }



    

    header('Content-Type: application/json');
    echo json_encode($response);

}