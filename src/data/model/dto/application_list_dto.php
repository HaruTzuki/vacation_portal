<?php


namespace VacationPortal\Data\Model\Dto;

use DateTime;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;

class ApplicationListDto {
    public string $date_submitted;
    public string $dates_submitted;
    public int $days;
    public string $status;
    public int $statusId;
    public int $applicationId;
    public int $user_id;
    public string $first_name;
    public string $last_name;
    public string $username;
    public string $reason;

    public function mapping($id, $date_from, $date_to, $inserted_date, $status, $reason){
        $app = new ApplicationListDto();

        $dt1 = new DateTime($date_from);
        $dt2 = new DateTime($date_to);



        $app->date_submitted = $inserted_date;
        $app->dates_submitted = $date_from . ' - ' . $date_to;
        $app->days = $dt1->diff($dt2)->d;
        $app->status = ApplicationStatus::getName($status);
        $app->statusId = $status;
        $app->applicationId = $id;
        $app->reason = $reason;

        return $app;
    }

    public function mapping_administrator($id, $user_id, $date_from, $date_to, $reason, $status, 
     $inserted_date , $first_name, $last_name, $username){
        $app = new ApplicationListDto();

        $dt1 = new DateTime($date_from);
        $dt2 = new DateTime($date_to);

        $app->date_submitted = $inserted_date;
        $app->dates_submitted = $date_from . ' - ' . $date_to;
        $app->days = $dt1->diff($dt2)->d;
        $app->status = ApplicationStatus::getName($status);
        $app->statusId = $status;
        $app->applicationId = $id;
        $app->user_id = $user_id;
        $app->family_name = $first_name . ' ' . $last_name;
        $app->username = $username;

        return $app;
    }
}