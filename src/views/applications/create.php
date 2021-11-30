<?php

use VacationPortal\Data\Model\Basic\Application;
use VacationPortal\Data\Model\Communication\NotificationHeader;
use VacationPortal\Helpers\Enumerations\ApplicationStatus;
use VacationPortal\Helpers\Enumerations\NotificationAction;

include_once '../../autoload.php';
getHeader();

    if(isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['reason_text'])){
        $application = new Application();
        $application->date_from = $_POST['date_from'];
        $application->date_to = $_POST['date_to'];
        $application->reason = $_POST['reason_text'];
        $application->status = ApplicationStatus::Pending;
        $application->user_id = $user->id;
        
        $applicationService->submitApplication($application);
        
        $notificationHeader = new NotificationHeader();
        $notificationHeader->notification_action = NotificationAction::NewApplication;
        $notificationHeader->application_id = $application->id;
        $notificationHeader->sender_user_id = $user->id;
        $notificationService->setNotification($notificationHeader);
    }
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Applications</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="applications">Applications</a></li>
                    <li class="breadcrumb-item active">Create New Application</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form action="create-new-application" method="post">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success">Save</button>
                    <a href="applications" class="btn btn-danger">Cancel</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="date_from">Date From</label>
                                <input type="date" name="date_from" id="date_from" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="date" name="date_to" id="date_to" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="form-group">
                                <label for="reason_text">Reason</label>
                                <textarea name="reason_text" id="reason_text" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
        </form>
    </div>
</section>



<?php
getFooter();

?>