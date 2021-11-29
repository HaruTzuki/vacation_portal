<?php
    namespace VacationPortal\Data\Services;

use VacationPortal\Data\Model\Communication\NotificationHeader;
use VacationPortal\Data\Model\Responses\ResponseObject;
use VacationPortal\Helpers\Enumerations\NotificationAction;
use VacationPortal\Helpers\Enumerations\NotificationReadStatus;

class NotificationService {

        public function setNotification(NotificationHeader $notificationHeader):ResponseObject{
            global $notificationRepository;

            if($notificationHeader->notification_action == NotificationAction::NewApplication){
                return new ResponseObject(0, "", $notificationRepository->add($notificationHeader));
            }
            else if ($notificationHeader->notification_action == NotificationAction::AnswerToApplication){
                return new ResponseObject(0, "", $notificationRepository->add($notificationHeader));
            }

            return new ResponseObject(1, "Something went wrong. Please try again.");
        }

        public function getNotifications(int $user_id): ResponseObject{
            global $notificationRepository;

            return new ResponseObject(0, "", $notificationRepository->fetchAll($user_id));
        }

        public function getNotificationBody(int $notificationId){
            global $notificationRepository;

            return new ResponseObject(0, "", $notificationRepository->fetch($notificationId));
        }

        public function readNotification(int $notificationId):ResponseObject{
            global $notificationRepository;

            if(!$notificationRepository->changeReadStatus($notificationId, NotificationReadStatus::Read)){
                return new ResponseObject(1, "Something went wrong. Pleas try again.");
            }

            return new ResponseObject(0, "Success");
        }

        public function unreadNotification(int $notificationId) : ResponseObject{
            global $notificationRepository;

            if(!$notificationRepository->changeReadStatus($notificationId, NotificationReadStatus::Unread)){
                return new ResponseObject(1, "Something went wrong. Pleas try again.");
            }

            return new ResponseObject(0, "Success");
        }

        public function getCountOfUnread($user_id):ResponseObject{
            global $notificationRepository;

            return new ResponseObject(0, "", $notificationRepository->countUnread($user_id));
        }

    }
?>