<?php

if(file_exists("../autoload.php")){
    include_once '../autoload.php';
}
else{
    include_once '../../autoload.php';
}


header('Content-Type: application/json; charset=utf-8');


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(strtolower($_REQUEST['method']) == 'getcounts'){
        echo getCount();
    }
    else if(strtolower($_REQUEST['method']) == 'getnotifications'){
        echo getNotifications();
    }
    else if(strtolower($_REQUEST['method']) == 'readnotification'){
        echo readNotification();
    }
}



function getCount(){
    global $notificationService;
    global $user;

    return json_encode(array("status"=>true, "object"=>$notificationService->getCountOfUnread($user->id)->object));
}

function getNotifications(){
    global $notificationService;
    global $user;

    return json_encode(array("status"=>true, "object" => $notificationService->getNotifications($user->id)->object));
}

function readNotification(){
    global $notificationService;
    
    $status = $notificationService->readNotification($_GET['id'])->status;

    return json_encode(array("status"=> $status == 0 ? true : false));
}


