<?php

namespace VacationPortal\Data\Model\Dto;

class LoginDto {
    public string $email;
    public string $password;
    public bool $isRememberMe;
}