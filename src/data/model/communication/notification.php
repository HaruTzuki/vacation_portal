<?php

    namespace VacationPortal\Data\Model\Communication;

    class NotificationHeader {
        public int $id;
        public int $notification_action;
        public int $application_id;
        public int $sender_user_id;
        public bool $has_read;
    }

    class NotificationDetail {
        public int $id;
        public int $notification_header_id;
        public int $receiver_user_id;
    }