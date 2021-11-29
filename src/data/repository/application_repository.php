<?php

namespace VacationPortal\Data\Repository;

use PDO;
use VacationPortal\Data\Model\Basic\Application;
use VacationPortal\Data\Model\Dto\ApplicationListDto;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;

class ApplicationRepository implements IApplicationRepository{
    
    public function fetchAllByUserId(int $userId): array{
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM applications WHERE user_id = :user_id ORDER BY inserted_date DESC");
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return array();
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'VacationPortal\Data\Model\Basic\Application');
    }

    public function fetchAll(): array{
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM applications ORDER BY inserted_date DESC");

        if(!$stmt->execute()){
            return array();
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'VacationPortal\Data\Model\Basic\Application');
    }

    public function fetchAllByStatus(int $status) : array{
        global $conn;

        $stmt = $conn->prepare("SELECT a.id, a.user_id, DATE_FORMAT(a.date_from, '%Y-%m-%d'), DATE_FORMAT(a.date_to, '%Y-%m-%d'),
        a.reason, a.status, DATE_FORMAT(a.inserted_date, '%Y-%m-%d') AS date_submitted, u.first_name, u.last_name, u.username
        FROM applications AS a
        INNER JOIN users AS u ON u.id = a.user_id
        WHERE a.status = :status
        ORDER BY a.inserted_date");

        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return array();
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Dto\ApplicationListDto", "mapping_administrator"));
    }

    public function fetch(int $applicationId, int $userId = 0): Application{
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM applications WHERE id = :id" . ($userId <= 0 ? "" : " AND user_id = :user_id"));

        $stmt->bindParam(":id", $applicationId, PDO::PARAM_INT);
        if($userId>0){
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        }

        if(!$stmt->execute()){
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'VacationPortal\Data\Model\Basic\Application')[0];
    }

    public function fetchByUuid(string $uuid): Application{
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM applications WHERE uuid = :uuid");

        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);

        if(!$stmt->execute()){
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'VacationPortal\Data\Model\Basic\Application')[0];
    }

    public function add(Application $application): bool{
        global $conn;

        $stmt = $conn->prepare("INSERT INTO applications (date_from, date_to, reason, status, inserted_date, user_id) 
        VALUES(:date_from, :date_to, :reason, :status, NOW(), :user_id)");

        $stmt->bindParam(":date_from", $application->date_from, PDO::PARAM_STR);
        $stmt->bindParam(":date_to", $application->date_to, PDO::PARAM_STR);
        $stmt->bindParam(":reason", $application->reason, PDO::PARAM_STR);
        $stmt->bindParam(":status", $application->status, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $application->user_id, PDO::PARAM_INT);

        $conn->beginTransaction();
        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $application->id = $conn->lastInsertId();
        
        $conn->commit();
        return true;
    }

    public function update(Application $application): bool{
        global $conn;

        $stmt = $conn->prepare("UPDATE applications
        SET date_from = :date_from,
        date_to = :date_to,
        reason = :reason
        WHERE id = :id AND user_id = :user_id AND status = " . ApplicationStatus::Pending);

        $stmt->bindParam(":date_from", $application->date_from, PDO::PARAM_STR);
        $stmt->bindParam(":date_to", $application->date_to, PDO::PARAM_STR);
        $stmt->bindParam(":reason", $application->reason, PDO::PARAM_STR);
        $stmt->bindParam(":id", $application->id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $application->user_id, PDO::PARAM_INT);

        $conn->beginTransaction();
        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }

    public function delete(Application $application): bool{
        global $conn;

        $stmt = $conn->prepare("DELETE FROM applications WHERE id = :id AND status = " . ApplicationStatus::Pending);

        $stmt->bindParam(":id", $application->id, PDO::PARAM_INT);

        $conn->beginTransaction();

        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }

    public function changeStatus(string $applicationId, int $status) : bool{
        global $conn;

        $stmt = $conn->prepare("UPDATE applications
        SET status = :status
        WHERE uuid = :uuid");

        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":uuid", $applicationId, PDO::PARAM_STR);

        $conn->beginTransaction();

        if(!$stmt->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }
}