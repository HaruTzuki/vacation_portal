<?php

namespace VacationPortal\Data\Services;

use VacationPortal\Data\Model\Basic\Application;
use VacationPortal\Data\Model\Dto\ApplicationListDto;
use VacationPortal\Data\Model\Responses\ResponseObject;
use VacationPortal\Helpers\ApplicationValidator;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;

class ApplicationService {

    public function submitApplication(Application $application) : ResponseObject{

        global $applicationRepository;

        $validator = new ApplicationValidator();

        if(!$validator->Validate($application)){
            return new ResponseObject(1, $validator->validation_error);
        }

        if(!$applicationRepository->add($application)){
            return new ResponseObject(1, "Something goes wrong and cannot submit your application");
        }

        return new ResponseObject(0, "Application has submitted successfully.");
    }

    public function getAllByUserId(int $userId) : ResponseObject{

        global $applicationRepository;

        $entities = $applicationRepository->fetchAllByUserId($userId);
        $appDto = new ApplicationListDto();
        $appDtoArray = array();
        foreach($entities as $entity){
            array_push($appDtoArray, $appDto->mapping($entity->id, $entity->date_from, $entity->date_to, $entity->inserted_date, $entity->status, $entity->reason));
        }

        return new ResponseObject(0, "", $appDtoArray);
    }

    public function getApplication(int $applicationId, int $userId): ResponseObject{
        global $applicationRepository;

        return new ResponseObject(0, "", $applicationRepository->fetch($applicationId, $userId));
    }

    public function updateApplication(Application $application): ResponseObject{
        global $applicationRepository;

        if($application->status != ApplicationStatus::Pending)
            return new ResponseObject(1, "To update an application must be in Pending status.");
        
        $validator = new ApplicationValidator();

        if(!$validator->Validate($application)){
            return new ResponseObject(1, $validator->validation_error);
        }

        if(!$applicationRepository->update($application)){
            return new ResponseObject(1, "Something goes wrong and cannot update your application.");
        }

        return new ResponseObject(0, "Application has updated successfully.");
    }

    public function deleteApplication(Application $application) : ResponseObject{
        global $applicationRepository;

        if($application->status != ApplicationStatus::Pending){
            return new ResponseObject(1, "To delete an application must be in the Pending status.");
        }

        if(!$applicationRepository->delete($application)){
            return new ResponseObject(1, "Something goes wrong and cannot delete your application.");
        }

        return new ResponseObject(0, "Application has deleted successfully.");
    }

    public function changeApplicationStatus(string $applicationId, int $applicationStatus):ResponseObject{
        global $applicationRepository;

        return new ResponseObject(0, "Application Status has changed", $applicationRepository->changeStatus($applicationId, $applicationStatus));
    }

    public function getPendingsApplications(): ResponseObject{
        global $applicationRepository;

        $pendings = $applicationRepository->fetchAllByStatus(ApplicationStatus::Pending);

        return new ResponseObject(0, "", $pendings);
    }

    public function getCompletedApplications(): ResponseObject {
        global $applicationRepository;

        // get approved
        $approved = $applicationRepository->fetchAllByStatus(ApplicationStatus::Approved);

        // get rejected
        $rejected = $applicationRepository->fetchAllByStatus(ApplicationStatus::Rejected);

        $merged = array_merge($approved, $rejected);

        return new ResponseObject(0, "", $merged);
    }

    public function getApplicationByUuid(string $uuid):ResponseObject{
        global $applicationRepository;

        return new ResponseObject(0, "", $applicationRepository->fetchByUuid($uuid));
    }
}