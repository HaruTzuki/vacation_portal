<?php
    include_once '../../autoload.php';

    if(!isset($_GET['mode'])){
        header('location: /applications');
    }

    $mode = $_GET['mode'];
    $list = array();

    if($mode == 1) { // Only Pendings
        $list = $applicationService->getPendingsApplications()->object;
    }
    else if($mode == 2){ // Everything else
        $list = $applicationService->getCompletedApplications()->object;
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
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Issuer</th>
                            <th>Submitted Date</th>
                            <th>Dates Requested</th>
                            <th>Days Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($list) > 0) :?>
                            <?php foreach ($list as $application) : ?>
                                <tr>
                                    <td><?= $application->family_name?> (<?= $application->username ?>)</td>
                                    <td><?= $application->date_submitted ?></td>
                                    <td><?= $application->dates_submitted ?></td>
                                    <td><?= $application->days ?></td>
                                    <td><?= $application->status ?></td>

                                    <td>
                                        <a href="/application-manage/<?= $application->applicationId ?>"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
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