<?php

use VacationPortal\Data\Model\Dto\LoginDto;

include_once '../autoload.php';

include_once APP_SITE . '/shared/login_header.php';


    if(isset($_POST['email']) && isset($_POST['password'])){
      $loginDto = new LoginDto();
      $loginDto->email = $_POST['email'];
      $loginDto->password = $_POST['password'];
      $loginDto->isRememberMe = isset($_POST['remember_me']);

      $mRet = $userService->login($loginDto);
      
      if($mRet->status == 0){
        header('location: dashboard');
      }
      
    }
?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>Vacation Portal</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Welcome back</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="E-Mail" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
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
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember_me">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="/signup" class="text-center">Register as new employee</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->


<?php
    include_once APP_SITE . '/shared/login_footer.php';
?>