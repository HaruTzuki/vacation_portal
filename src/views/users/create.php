<?php

use VacationPortal\Data\Model\Dto\UserDto;
use VacationPortal\Helpers\Enumerations\UserType;

include_once '../../autoload.php';

$has_errors = false;
$error_message = "";

if(isset($_POST['username']) && $_POST['password'] && $_POST['r_password'] && $_POST['email'])

if($_POST['password'] != $_POST['r_password']){
        $has_errors = true;
        $error_message = "Passwords not match.";
    }
    else{
        CreateUser();
    }
    
    function CreateUser(){
        global $userService;
        global $has_errors;
        global $error_message;
        
        $user = new UserDto();
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $user->last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
        $user->date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : "1990-01-01";
        $user->enable = isset($_POST['enable']) ? 1 : 0;
        $user->role_id = $_POST['role'];
        
        // Adress Info
        $user->street = isset($_POST['street']) ? $_POST['street'] : "";
        $user->area = isset($_POST['area']) ? $_POST['area'] : "";
        $user->city = isset($_POST['city']) ? $_POST['city'] : "";
        $user->postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
        $user->state = isset($_POST['state']) ? $_POST['state'] : "";
        $user->country = isset($_POST['country']) ? $_POST['country'] : "";
        
        $user->phone_one = isset($_POST['phone_one']) ? $_POST['phone_one'] : "";
        $user->phone_two = isset($_POST['phone_two']) ? $_POST['phone_two'] : "";
        $user->phone_three = isset($_POST['phone_three']) ? $_POST['phone_three'] : "";
        $user->phone_four = isset($_POST['phone_four']) ? $_POST['phone_four'] : "";
        $user->mobile = isset($_POST['mobile']) ? $_POST['mobile'] : "";
        $user->email = $_POST['email'];
        
        $result = $userService->registerUser($user);
        
        if($result->status == 1){
            $has_errors = true;
            $error_message = $result->message;
        }
        else {
            header('location: /users');
        }
    }
    
    getHeader();
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
                    <button class="btn btn-success" name="save">Save</button>
                    <a href="/users" class="btn btn-danger">Cancel</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username..." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" id="email" placeholder="E-Mail..." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password..." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="form-group">
                                <label for="password">Retype Password</label>
                                <input type="password" name="r_password" id="r_password" placeholder="Retype Password..." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name..." class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name..." class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                                <label for="role">User Role</label>
                               <select name="role" id="role" class="form-control">
                                   <option value="<?=UserType::Employee?>">Employee</option>
                                   <option value="<?=UserType::Manager?>">Manager</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 d-flex align-items-center justify-content-center">
                            <div class="form-group ">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" class="custom-control-input" id="enable" name="enable" checked>
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
                                        <input type="text" name="street" id="street" placeholder="Street..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <input type="text" name="area" id="area" placeholder="Area..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city" placeholder="City..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" name="state" id="state" placeholder="State..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" id="country" placeholder="Country..." class="form-control">
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
                                        <input type="text" name="phone_one" id="phone_one" placeholder="Phone One..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_two">Phone Two</label>
                                        <input type="text" name="phone_two" id="phone_two" placeholder="Phone Two..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_three">Phone Three</label>
                                        <input type="text" name="phone_three" id="phone_three" placeholder="Phone Three..." class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_four">Phone Four</label>
                                        <input type="text" name="phone_four" id="phone_four" placeholder="Phone Four..." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" placeholder="Mobile..." class="form-control">
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