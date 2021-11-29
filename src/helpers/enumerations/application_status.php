<?php

namespace VacationPortal\Helpers\Enumerations;

$names = array("Pending", "Approved", "Rejected");

abstract class ApplicationStatus{
    const Pending = 0;
    const Approved = 1;
    const Rejected = 2;


    public static function getName(int $status):string{
        global $names;
        return $names[$status];
    }
}