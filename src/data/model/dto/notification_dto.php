<?php
namespace VacationPortal\Data\Model\Dto;

    class NotificationDto{
        public int $id;
        public int $notification_action;
        public string $notification_inserted_date;
        public bool $has_read;
        public int $sender_user_id;
        public int $application_id;
        public string $uuid;
        public string $sender_family_name;
        public string $sender_username;
        public ApplicationListDto $application;

        function __construct(int $id, int $notification_action, bool $has_read, int $sender_user_id, string $notification_inserted_date, string $first_name, string $last_name, string $username, string $uuid
        , int $application_id, string $date_from, string $date_to, string $inserted_date, int $status, string $reason){
            $this->id = $id;
            $this->notification_action = $notification_action;
            $this->hash_read = $has_read;
            $this->sender_user_id = $sender_user_id;
            $this->notification_inserted_date = $notification_inserted_date;
            $this->sender_family_name = $first_name . ' ' . $last_name;
            $this->sender_username = $username;
            $this->uuid = $uuid;
            $this->application_id = $application_id;
            $this->application = new ApplicationListDto();
            $this->application = $this->application->mapping($application_id, $date_from, $date_to, $inserted_date, $status, $reason);
        }

        public function mapping(int $id, int $notification_action, bool $has_read, int $sender_user_id, string $notification_inserted_date, string $first_name, string $last_name, string $username, string $uuid
        , int $application_id, string $date_from, string $date_to, string $inserted_date, int $status, string $reason){
            return new NotificationDto($id, $notification_action, $has_read, $sender_user_id, $notification_inserted_date, $first_name, $last_name, $username, $uuid, $application_id, $date_from, $date_to, $inserted_date, $status, $reason);
        }
    }