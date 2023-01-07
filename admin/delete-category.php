<?php 
    // Include Constants File
    include('../config/constants.php');
?>
<?php
    // echo "Delete Page";
    // Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            // Image is available. So Remove it
            $path = "../images/category/".$image_name;
            // Remove the image
            $remove = unlink($path);
            // If failed to remove image then add and error message and stop the process
            if($remove == FALSE)
            {
                // Share the SESSION message
                echo "<script>alert('Failed to remove category image. ')</script>";
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image. </div>";
            
                // Redirect to manage-category page
                echo "<script>window.open('manage-category.php','_self')</script>";
                // header('location:'.SITEURL.'admin/manage-category.php');
                // Sop the process
                die();
            }
        }

        // Delete data from database 
        // Sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id ";

        // Execute the query
        $res = mysqli_query($conn,$sql);

        // check whether the data deleted from database or not
        if($res == TRUE)
        {
            // Set success message and redirect

            echo "<script>alert('Category Deleted Successfully. ')</script>";
            $_SESSION['delete']=  "<div class='success'>Category Deleted Successfully. </div>";

            // Redirect to manage-category page
            echo "<script>window.open('manage-category.php','_self')</script>";
            // header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Set fail message and redirect
            echo "<script>alert('Failed to delete Category. ')</script>";
            $_SESSION['delete']=  "<div class='error'>Failed to delete Category. </div>";

            // Redirect to manage-category page
            echo "<script>window.open('manage-category.php','_self')</script>";
            // header('location:'.SITEURL.'admin/manage-category.php');
            
        }

    }
    else
    {
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>