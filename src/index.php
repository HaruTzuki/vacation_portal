<?php

    include 'autoload.php';

    if(isset($_SESSION['user'])){
        header('location: dashboard');
    }
    else{
        header('location: signin');
    }

?>


    
