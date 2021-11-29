<?php

use VacationPortal\Helpers\Enumerations\ApplicationStatus;
use VacationPortal\Helpers\Enumerations\UserType;

include_once '../../autoload.php';

    if(!isset($_GET['id']) || (isset($user) && $user->role_id != UserType::Manager)){
        header('location: /applications');
    }

    $app = $applicationService->getApplication($_GET['id'], 0);

    if($app->status == 1){
        header('location: /applications');
    }

    getHeader();
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
                    <li class="breadcrumb-item"><a href="/applications">Applications</a></li>
                    <li class="breadcrumb-item active">Answer to Application</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <?php if($app->object->status == ApplicationStatus::Pending) :?>
                        <button class="btn btn-success" name="approve" data-uuid="<?=$app->object->uuid?>">Approve</button>
                        <button class="btn btn-danger" name="reject" data-uuid="<?=$app->object->uuid?>">Reject</button>
                    <?php endif?>
                        <a href="/applications" class="btn btn-primary">Cancel</a>
                    <?php if($app->object->status != ApplicationStatus::Pending) :?>
                        <label class="lead">You have <?=$app->object->status == ApplicationStatus::Approved ? "approved" : "rejected" ?> this application.</label>
                    <?php endif;?>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $app->object->id ?>">
                                <label for="date_from">Date From</label>
                                <input type="text" disabled name="date_from" id="date_from" class="form-control" value="<?= $app->object->date_from ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="text" disabled name="date_to" id="date_to" class="form-control" value="<?= $app->object->date_to ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="form-group">
                                <label for="reason_text">Reason</label>
                                <textarea name="reason_text" disabled id="reason_text" cols="30" rows="10" class="form-control"><?= $app->object->reason ?></textarea>
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


