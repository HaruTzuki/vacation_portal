<?php

namespace VacationPortal\Data\Repository;

use VacationPortal\Data\Model\Communication\NotificationHeader;
use VacationPortal\Data\Model\Dto\NotificationDto;

interface INotificationRepository {
    public function add(NotificationHeader $notificationHeader): bool;
    public function fetchAll(int $user_id):array;
    public function fetch(int $notificationId): NotificationDto;
    public function changeReadStatus(int $notificationId, bool $read_status, int $user_id) : bool;
    public function countUnread(int $user_id):int;
}