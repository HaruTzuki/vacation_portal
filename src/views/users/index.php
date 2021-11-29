<?php

use VacationPortal\Helpers\Enumerations\ApplicationStatus;

include_once '../../autoload.php';
getHeader();


$has_errors = false;
$error_message = "";

$users = $userService->getAllUsers();;



?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                <a href="create-new-user" class="btn btn-info">Create new User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users->object as $user) : ?>
                            <tr>
                                <td><?= $user->first_name ?></td>
                                <td><?= $user->last_name ?></td>
                                <td><?= $user->contact->email ?></td>
                                <td><?= $user->role->description ?></td>

                                <td>
                                    <a href="user-edit/<?= $user->id ?>"><i class="fas fa-edit"></i></a>
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