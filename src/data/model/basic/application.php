<?php

namespace VacationPortal\Data\Model\Basic;

use VacationPortal\Data\Model\Security\User;

class Application
{
    public int $id;
    public string $date_from;
    public string $date_to;
    public string $reason;
    public string $inserted_date;
    public int $status;
    public int $user_id;
    public string $uuid;
}
