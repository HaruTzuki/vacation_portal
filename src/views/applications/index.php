<?php

use VacationPortal\Helpers\Enumerations\ApplicationStatus;

include_once '../../autoload.php';
getHeader();


$has_errors = false;
$error_message = "";

$applications = $applicationService->getAllByUserId($user->id);

if ($applications->status != 0) {
    $has_errors = true;
    $error_message = $applications->message;
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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Applications</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="create-new-application" class="btn btn-info">Create new Application</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date Submitted</th>
                            <th>Dates Requested</th>
                            <th>Days Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications->object as $application) : ?>
                            <tr>
                                <td><?= $application->date_submitted ?></td>
                                <td><?= $application->dates_submitted ?></td>
                                <td><?= $application->days ?></td>
                                <td><?= $application->status ?></td>

                                <td>
                                    <?php if ($application->statusId == ApplicationStatus::Pending) : ?>
                                        <a href="application-edit/<?= $application->applicationId ?>"><i class="fas fa-edit"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
    </div>
</section>



<?php
getFooter();

?>