<?php

use VacationPortal\Data\Model\Security\User;

if(file_exists("../autoload.php")){
  include_once '../autoload.php';
}
else{
  include_once '../../autoload.php';
}
  
  if(!isset($_SESSION['user'])){
    header("location: /signin");
  }

  $user = unserialize($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacation Portal</title>

    <!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?=SITE_URL?>/assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link notification-view" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge notification-unread-count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification-dropdown-body" style="max-height: 500px; width: 500px !important; max-width: 5000px !important; overflow-y: auto;">
          
        </div>
      </li>

      <li class="nav-item m-2">
        <a href="/logout">
          <i class="fas fa-sign-out-alt text-muted"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->


  <?php

if(file_exists("../shared/sidebar.php")){
  include_once '../shared/sidebar.php';
}
else{
  include_once '../../shared/sidebar.php';
}

?>

<div class="content-wrapper">



