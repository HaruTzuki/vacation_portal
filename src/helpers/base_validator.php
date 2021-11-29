<?php

namespace VacationPortal\Helpers;

abstract class BaseValidator {
    public string $validation_error = "";

    abstract public function Validate($entity) : bool;
}


