<?php
    // Include constants.php for SITEURL
    include('../config/constants.php');
    // 1.Destroy the session 
    session_destroy(); //Unsets $_SESSION['user']

    // 2.Redirect to login page
    echo "<script>alert('Logout Successfull.')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    // header('location:'.SITEURL.'admin/login.php');
?>