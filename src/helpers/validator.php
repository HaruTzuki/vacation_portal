<?php

namespace VacationPortal\Helpers;

use VacationPortal\Data\Model\Dto\LoginDto;
use VacationPortal\Data\Model\Dto\UserDto;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;

class UserDtoValidator extends BaseValidator{

    public function Validate($userDto) : bool{
        if(!isset($userDto->username) || $userDto->username == '') {
            // settype($validation_error, "string");
            $validation_error = "Username must not be null or empty.";
            return false;
        }

        if(!isset($userDto->password) || $userDto->password == ''){
            // settype($validation_error, "string");
            $validation_error = "Password must not be null or empty.";
            return false;
        }

        if(!isset($userDto->first_name) || $userDto->first_name == ''){
            // settype($validation_error, "string");
            $validation_error = "First Name must not be null or empty.";
            return false;
        }

        if(!isset($userDto->last_name) || $userDto->last_name == ''){
            // settype($validation_error, "string");
            $validation_error = "Last Name must not be null or empty.";
            return false;
        }

        return true;
    }
}


class LoginDtoValidator extends BaseValidator{

    public function Validate($loginDto): bool
    {
        if(!isset($loginDto->email) || $loginDto->email == ''){
            settype($validation_error, "string");
            $validation_error = "E-Mail must not be null or empty.";
            return false;
        }


        if(!isset($loginDto->password) || $loginDto->password == ''){
            settype($validation_error, "string");
            $validation_error = "Password must not be null or empty.";
            return false;
        }

        return true;
    }
}

class ApplicationValidator extends BaseValidator{

    public function Validate($entity): bool
    {
        if(!isset($entity->date_from) || $entity->date_from == ""){
            settype($validation_error, "string");
            $validation_error = "From Date cannot be null or empty.";
            return false;
        }

        if(!isset($entity->date_to) || $entity->date_to == ""){
            settype($validation_error, "string");
            $validation_error = "To Date cannot be null or empty.";
            return false;
        }

        if(!isset($entity->reason) || $entity->reason == ""){
            settype($validation_error, "string");
            $validation_error = "The reason cannot be null or empty.";
            return false;
        }

        if(!isset($entity->status)){
            settype($validation_error, "string");
            $validation_error = "The status cannot be null or empty.";
            return false;
        }

        if($entity->status < ApplicationStatus::Pending || $entity->status > ApplicationStatus::Rejected){
            settype($validation_error, "string");
            $validation_error = "The status is not valid.";
            return false;
        }

        if(strtotime($entity->date_from) > strtotime($entity->date_to)){
            settype($validation_error, "string");
            $validation_error = "The Date From cannot be greater than Date To";
            return false;
        }

        return true;
    }
}