<?php

use VacationPortal\Data\Model\Communication\NotificationHeader;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;
use VacationPortal\Helpers\Enumerations\NotificationAction;

if(file_exists("../autoload.php")){
    include_once '../autoload.php';
}
else{
    include_once '../../autoload.php';
}

    header('Content-Type: application/json; charset=utf-8');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if($_REQUEST['method'] == 'approve'){
            echo approveApplication($_REQUEST['uuid']);
        }
        else if($_REQUEST['method'] == 'reject'){
            echo rejectApplication($_REQUEST['uuid']);
        }
        else{
            echo json_encode(array("status"=>false, "message"=>"The method does not exist."));
        }
    }
    else{
        echo json_encode(array("status"=> false, "message"=>"You try make a request with a method that not supported."));
    }

    function approveApplication(string $uuid){
        global $applicationService;
        global $notificationService;
        global $user;

        if($uuid == ''){
            return json_encode(array("status" => false, "message" => "Application with this ID does not exist."));
        }

        $applicationService->changeApplicationStatus($uuid, ApplicationStatus::Approved);

        $notificationHeader = new NotificationHeader();
        $notificationHeader->notification_action = NotificationAction::AnswerToApplication;
        $notificationHeader->application_id = $applicationService->getApplicationByUuid($uuid)->object->id;
        $notificationHeader->sender_user_id = $user->id;
        $notificationService->setNotification($notificationHeader);

        return json_encode(array("status"=> true, "message" => "You have approve the application with ID: " . $uuid));
    }

    function rejectApplication(string $uuid){
        global $applicationService;
        global $notificationService;
        global $user;

        if($uuid == ''){
            return json_encode(array("status" => 1, "message" => "Application with this ID does not exist."));
        }

        $applicationService->changeApplicationStatus($uuid, ApplicationStatus::Rejected);
        $notificationHeader = new NotificationHeader();
        $notificationHeader->notification_action = NotificationAction::AnswerToApplication;
        $notificationHeader->application_id = $applicationService->getApplicationByUuid($uuid)->object->id;
        $notificationHeader->sender_user_id = $user->id;
        $notificationService->setNotification($notificationHeader);

        return json_encode(array("status"=> true, "message" => "You have reject the application with ID: " . $uuid));
    }