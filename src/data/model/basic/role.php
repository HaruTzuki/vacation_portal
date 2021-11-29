<?php

namespace VacationPortal\Data\Model\Basic;

class Role {
    public int $id;
    public string $description;
    public bool $can_write;
    public bool $can_read;
    public bool $can_delete;
    public bool $can_update;
    public bool $is_manager;
    public bool $is_admin;
}