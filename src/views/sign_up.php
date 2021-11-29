<?php

use VacationPortal\Data\Model\Basic\Address;
use VacationPortal\Data\Model\Basic\Contact;
use VacationPortal\Data\Model\Basic\Role;
use VacationPortal\Data\Model\Dto\UserDto;
use VacationPortal\Data\Model\Responses\ResponseObject;

include_once '../autoload.php';
include_once APP_SITE . '/shared/login_header.php';

$has_errors = false;
$is_success = false;
$error_message = "";



if (
  isset($_POST['username'])
  && isset($_POST['password'])
  && isset($_POST['r_password'])
  && isset($_POST['first_name'])
  && isset($_POST['last_name'])
) {

  if ($_POST['password'] != $_POST['r_password']) {
    $has_errors = true;
    $error_message = "You typed wrong passwords.";
  } else {
    $userDto = new UserDto();
    $userDto->username = $_POST['username'];
    $userDto->password = $_POST['password'];
    $userDto->first_name = $_POST['first_name'];
    $userDto->last_name = $_POST['last_name'];
    $userDto->address = new Address();
    $userDto->role = new Role();
    $userDto->role_id = 2;
    $userDto->contact = new Contact();

    $mRet = $userService->registerUser($userDto);

    if ($mRet->status == 0) {
      $is_success = true;
    }
  }
}

?>
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Vacation Portal</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register as new Employee</p>

      <?php if ($has_errors) : ?>

        <div class="alert alert-danger" role="alert">
          <?= $error_message ?>
        </div>

      <?php endif; ?>

      <?php if ($is_success) : ?>
        <div class="alert alert-success" role="alert">
          You have registered as new employee
        </div>
      <?php endif; ?>

      <form action="signup" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="r_password" id="r_password" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="/signin" class="text-center">I am already empoyee</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>


<!-- /.register-box -->



<?php
include_once APP_SITE . '/shared/login_footer.php';
?>