<?php
    namespace VacationPortal;

use VacationPortal\Data\Model\Security\User;
use VacationPortal\Data\Repository\ApplicationRepository;
use VacationPortal\Data\Repository\NotificationRepository;
use VacationPortal\Data\Repository\UserRepository;
use VacationPortal\Data\Services\ApplicationService;
use VacationPortal\Data\Services\NotificationService;
use VacationPortal\Data\Services\UserService;

session_start();

    include_once 'include/config.php';
    include_once 'include/db.php';

    // Helpers
    include_once 'helpers/functions.php';
    include_once 'helpers/base_validator.php';
    include_once 'helpers/validator.php';
    include_once 'helpers/i_request.php';
    include_once 'helpers/request.php';
    include_once 'helpers/router.php';
    include_once 'helpers/enumerations/application_status.php';
    include_once 'helpers/enumerations/user_type.php';
    include_once 'helpers/enumerations/notification_action.php';
    include_once 'helpers/enumerations/notification_read_status.php';

    // Data
    // Model
    include_once 'data/model/basic/role.php';
    include_once 'data/model/basic/address.php';
    include_once 'data/model/basic/contact.php';
    include_once 'data/model/basic/application.php';
    include_once 'data/model/security/user.php';
    include_once 'data/model/communication/notification.php';
    include_once 'data/model/dto/user_dto.php';
    include_once 'data/model/dto/login_dto.php';
    include_once 'data/model/dto/application_list_dto.php';
    include_once 'data/model/dto/notification_dto.php';
    include_once 'data/model/responses/response_object.php';

    // Repository
    include_once 'data/repository/i_user_repository.php';
    include_once 'data/repository/user_repository.php';
    include_once 'data/repository/i_application_repository.php';
    include_once 'data/repository/application_repository.php';
    include_once 'data/repository/i_notification_repository.php';
    include_once 'data/repository/notification_repository.php';

    // Services
    include_once 'data/services/user_service.php';
    include_once 'data/services/application_service.php';
    include_once 'data/services/notification_service.php';

    
    // Inject
    $userRepository = new UserRepository();
    $userService = new UserService();
    $applicationRepository = new ApplicationRepository();
    $applicationService = new ApplicationService();
    $notificationRepository = new NotificationRepository();
    $notificationService = new NotificationService();

    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;