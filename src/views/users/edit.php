<?php

use VacationPortal\Data\Model\Dto\UserDto;
use VacationPortal\Helpers\Enumerations\UserType;

include_once '../../autoload.php';

getHeader();

$has_errors = false;
$error_message = "";


$employee = $userService->getUser($_GET['id']);


if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['update'])){
    $employee->object->username = $_POST['username'];
    $employee->object->first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
    $employee->object->last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
    $employee->object->enable = isset($_POST['enable']) ? 1 : 0;
    $employee->object->role_id = $_POST['role'];
    
    // Adress Info
    $employee->object->address->street = isset($_POST['street']) ? $_POST['street'] : "";
    $employee->object->address->area = isset($_POST['area']) ? $_POST['area'] : "";
    $employee->object->address->city = isset($_POST['city']) ? $_POST['city'] : "";
    $employee->object->address->postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
    $employee->object->address->state = isset($_POST['state']) ? $_POST['state'] : "";
    $employee->object->address->country = isset($_POST['country']) ? $_POST['country'] : "";
    
    $employee->object->contact->phone_one = isset($_POST['phone_one']) ? $_POST['phone_one'] : "";
    $employee->object->contact->phone_two = isset($_POST['phone_two']) ? $_POST['phone_two'] : "";
    $employee->object->contact->phone_three = isset($_POST['phone_three']) ? $_POST['phone_three'] : "";
    $employee->object->contact->phone_four = isset($_POST['phone_four']) ? $_POST['phone_four'] : "";
    $employee->object->contact->mobile = isset($_POST['mobile']) ? $_POST['mobile'] : "";
    $employee->object->contact->email = $_POST['email'];
    
    $result = $userService->updateUser($employee->object);
    
    if($result->status == 1){
        $has_errors = true;
        $error_message = $result->message;
    }
    else {
        echo "<script>document.location.href = '/users'</script>";
    }
}

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
                    <li class="breadcrumb-item"><a href="/users">Users</a></li>
                    <li class="breadcrumb-item active">Create New User</li>
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
                    <button class="btn btn-success" name="update">Update</button>
                    <a href="/users" class="btn btn-danger">Cancel</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username..." class="form-control" value="<?=$employee->object->username?>" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" id="email" placeholder="E-Mail..." class="form-control" value="<?=$employee->object->contact->email?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name..." value="<?=$employee->object->first_name?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name..." value="<?=$employee->object->last_name?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="role">User Role</label>
                               <select name="role" id="role" class="form-control">
                                   <option value="<?=UserType::Employee?>" <?=$employee->object->role_id == UserType::Employee ? 'selected' : ''?>>Employee</option>
                                   <option value="<?=UserType::Manager?>" <?=$employee->object->role_id == UserType::Manager ? 'selected' : ''?>>Manager</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 d-flex align-items-center justify-content-center">
                            <div class="form-group ">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" class="custom-control-input" id="enable" name="enable" <?=$employee->object->enable ? "checked" : "" ?>>
                                    <label class="custom-control-label" for="enable">Enable</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->

            </div>

            <div class="row">
                <!-- Address -->
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Adress Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input type="text" name="street" id="street" placeholder="Street..." value="<?=$employee->object->address->street?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <input type="text" name="area" id="area" placeholder="Area..." value="<?=$employee->object->address->area?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city" placeholder="City..." value="<?=$employee->object->address->city?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code..." value="<?=$employee->object->address->postal_code?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" name="state" id="state" placeholder="State..." value="<?=$employee->object->address->state?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" id="country" placeholder="Country..." value="<?=$employee->object->address->country?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
                <!-- Contact -->
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Contact Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_one">Phone One</label>
                                        <input type="text" name="phone_one" id="phone_one" placeholder="Phone One..." value="<?=$employee->object->contact->phone_one?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_two">Phone Two</label>
                                        <input type="text" name="phone_two" id="phone_two" placeholder="Phone Two..." value="<?=$employee->object->contact->phone_two?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_three">Phone Three</label>
                                        <input type="text" name="phone_three" id="phone_three" placeholder="Phone Three..." value="<?=$employee->object->contact->phone_three?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_four">Phone Four</label>
                                        <input type="text" name="phone_four" id="phone_four" placeholder="Phone Four..." value="<?=$employee->object->contact->phone_four?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" placeholder="Mobile..." value="<?=$employee->object->contact->mobile?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>



<?php
getFooter();

?>