<?php
    // Authorization or Access Control 
    // check whether the user logged in or not
    if(!isset($_SESSION['user'])) //if user session is not
    {
        // User is not logged in

        // Redirect to login Page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Access Admin Panel.</div>";
        echo "<script>alert('Please Login to Access Admin Panel.')</script>";
        // Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>