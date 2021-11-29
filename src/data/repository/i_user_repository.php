<?php

namespace VacationPortal\Data\Repository;

use VacationPortal\Data\Model\Security\User;

interface IUserRepository {
    public function fetchAll() : array;
    public function fetch(int $id) : User;
    public function fetchWithUsername(string $username) : User;
    public function fetchWithEmail(string $email) : User;
    public function add(User $user) : bool;
    public function update(User $user) : bool;
    public function delete(User $user) : bool;
}