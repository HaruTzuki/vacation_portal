<?php
include_once '../autoload.php';

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    unset($user);
    session_destroy();
}

header('location: /');
