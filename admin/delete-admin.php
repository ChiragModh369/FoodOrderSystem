<?php

    // Include constants.php file here
    include('../config/constants.php');

    // 1.get the ID pf Admin to be Deleted
     $id = $_GET['id'];

    // 2.Create sql Query to Delete Admin
    $sql = "DELETE FROM tbl_admin where id=$id";

    // Execute the query

    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==TRUE)
    {
        // Query executed successfully and admin deleted
        // echo "Admin Deleted";

        // create session variable to display the message 
        echo "<script>alert('Admin Deleted Successfully.')</script>";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

        // Redirect to manage-admin page
        echo "<script>window.open('manage-admin.php','_self')</script>";
        // header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to delete admin 
        // echo "Failed to delete Admin";

        // create session variable to display the message 
        echo "<script>alert('Failed To Delete Admin. Try Again Later.')</script>";
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin. Try Again Later.</div> ";
        
        // Redirect to manage-admin page
        echo "<script>window.open('manage-admin.php','_self')</script>";
        // header('location:'.SITEURL.'admin/manage-admin.php');

    }

    // 3.Redirect to Manage Admin Page with message(Success or Error)

?>