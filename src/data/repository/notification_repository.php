<?php

namespace VacationPortal\Data\Repository;

use VacationPortal\Data\Model\Communication\NotificationHeader;
use PDO;
use VacationPortal\Data\Model\Dto\NotificationDto;
use VacationPortal\Helpers\Enumerations\NotificationAction;
use VacationPortal\Helpers\Enumerations\UserType;

class NotificationRepository implements INotificationRepository{

    public function fetchAll(int $user_id): array{
        global $conn;

        $stmt = $conn->prepare("SELECT nh.id, nh.notification_action, nd.has_read, nh.sender_user_id, DATE_FORMAT(nh.inserted_date, '%Y-%m-%d %H-%i') AS notification_inserted_date,
        u.first_name, u.last_name, u.username, a.uuid, a.id, DATE_FORMAT(a.date_from, '%Y-%m-%d'), DATE_FORMAT(a.date_to, '%Y-%m-%d'), DATE_FORMAT(a.inserted_date, '%Y-%m-%d'), a.status, a.reason
        FROM notification_headers AS nh
        INNER JOIN notification_details AS nd ON nh.id = nd.notification_header_id
        INNER JOIN applications AS a ON  nh.application_id = a.id
        INNER JOIN users AS u ON nh.sender_user_id = u.id
        WHERE nd.receiver_user_id = :user_id
        ORDER BY nh.inserted_date DESC");

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return array();
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Dto\NotificationDto", "mapping"));
    }

    public function add(NotificationHeader $notificationHeader): bool{
        global $conn;

        $stmt = $conn->prepare("INSERT INTO notification_headers (notification_action, application_id, sender_user_id) VALUES (:notification_action, :application_id, :sender_user_id)");

        $stmt->bindParam(':notification_action', $notificationHeader->notification_action, PDO::PARAM_INT);
        $stmt->bindParam(':application_id', $notificationHeader->application_id, PDO::PARAM_INT);
        $stmt->bindParam(':sender_user_id', $notificationHeader->sender_user_id, PDO::PARAM_INT);

        $conn->beginTransaction();

        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $notification_header_id = $conn->lastInsertId();

        $stmt_users = $conn->prepare('SELECT id FROM users WHERE role_id =' . ($notificationHeader->notification_action == NotificationAction::NewApplication ? UserType::Manager : UserType::Employee));
        
        if(!$stmt_users->execute()){
            $conn->rollBack();
            return false;
        }

        $users_ids = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

        foreach($users_ids as $user_id){
            $stmt = $conn->prepare("INSERT INTO notification_details (notification_header_id, receiver_user_id) VALUES (:notification_header_id, " . $user_id['id'] .")");
            $stmt->bindParam(":notification_header_id", $notification_header_id, PDO::PARAM_INT);

            if(!$stmt->execute()){
                $conn->rollBack();
                return false;
            }
        }
        
        $conn->commit();
        return true;
    }

    public function fetch(int $notificationId): NotificationDto
    {
        global $conn;

        $stmt = $conn->prepare("SELECT nh.id, nh.notification_action, nd.has_read, nh.sender_user_id, DATE_FORMAT(nh.inserted_date, '%Y-%m-%d %H-%i') AS notification_inserted_date,
        , u.first_name, u.last_name, u.username, a.id, DATE_FORMAT(a.date_from, '%Y-%m-%d'), DATE_FORMAT(a.date_to, '%Y-%m-%d'), DATE_FORMAT(a.inserted_date, '%Y-%m-%d'), a.status
        FROM notification_headers AS nh
        INNER JOIN notification_details AS nd ON nh.id = nd.notification_header_id
        INNER JOIN applciations AS a ON  nh.application_id = a.id
        INNER JOIN users AS u ON nh.sender_user_id = u.id
        WHERE nd.receiver_id = :user_id
        ORDER BY nh.inserted_date DESC");

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return array();
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Dto\NotificationDto", "mapping"))[0];
    }

    public function changeReadStatus(int $notificationId, bool $read_status, int $user_id): bool
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE notification_details SET has_read = :read_status WHERE notification_header_id = :id AND receiver_user_id = :receiver_user_id");

        $stmt->bindParam(':read_status', $read_status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $notificationId, PDO::PARAM_INT);
        $stmt->bindParam(':receiver_user_id', $user_id, PDO::PARAM_INT);

        $conn->beginTransaction();

        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }

    public function countUnread(int $user_id): int
    {
        global $conn;

        $stmt = $conn->prepare("SELECT COUNT(*) AS CNT
        FROM notification_headers AS nh
        INNER JOIN notification_details AS nd ON nh.id = nd.notification_header_id
        WHERE nd.receiver_user_id = :receiver_user_id AND nd.has_read = 0");

        $stmt->bindParam(":receiver_user_id" , $user_id, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return 0;
        }

        $count = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        return $count['CNT'];
    }
}
