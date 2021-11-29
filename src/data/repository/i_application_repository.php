<?php

namespace VacationPortal\Data\Repository;

use VacationPortal\Data\Model\Basic\Application;
use VacationPortal\Data\Model\Dto\ApplicationListDto;

interface IApplicationRepository
{
    public function fetchAllByUserId(int $userId): array;
    public function fetchAll(): array;
    public function fetchAllByStatus(int $status) : array;
    public function fetch(int $applicationId, int $userId):Application;
    public function fetchByUuid(string $uuid): Application;
    public function add(Application $application): bool;
    public function update(Application $application): bool;
    public function delete(Application $application): bool;
    public function changeStatus(string $applicationId, int $status):bool;
}
