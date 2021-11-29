<?php

use VacationPortal\Helpers\Enumerations\ApplicationStatus;

if(!isset($_GET['uuid'])){
    header('location: /404');
}

if(!isset($_GET['method'])){
    header('location: /404');
}

include_once '../../autoload.php';

// Redaunt TODO fix.


    $uuid = $_GET['uuid'];
    $method = $_REQUEST['method'];

    $app = "";

    switch($method){
        case 'approve':
            if($uuid == ''){
                header('location: /404');
            }
            $app = $applicationService->changeApplicationStatus($uuid, ApplicationStatus::Approved);
            break;
        case 'reject':
            if($uuid == ''){
                header('location: /404');
            }
            $app = $applicationService->changeApplicationStatus($uuid, ApplicationStatus::Rejected);
            break;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>

    <link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?=SITE_URL?>/assets/css/adminlte.min.css">    
    <link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body>
    <div class="container">
        <div class="row pt-5">
            <dic class="col-xl-12 col-lg-12 text-center">
                <h2 class="lead">You have <?=$method == 'approve' ? "approved" : "rejected"?> successfully application with ID: <?=$uuid?></h2>
                <p>You will redirect autocally in 5 seconds. If not please press <a href="<?=SITE_URL?>">here</p></p>
            </dic>
        </div>
    </div>


    <script src="<?=SITE_URL?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?=SITE_URL?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?=SITE_URL?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>

        setInterval(function(){
            document.location.href = "<?=SITE_URL?>";
        }, 5000);

    </script>
</body>
</html>

