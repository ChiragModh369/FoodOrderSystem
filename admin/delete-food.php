<?php
include('../config/constants.php');
?>

<?php
    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'. 
    {
        // Process to delete
        // echo "Process to delete";

        // 1.get id and image name

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2.Remove the image if available
        // check whether the image is available or not and delete only if available

        if($image_name!="")
        {
            // It has image and need to remove from the folder
            // Get the image path
            $path = "../images/food/".$image_name;

            // Remove image file from folder
            $remove = unlink($path);

            //check whether the image is removed or not

            if($remove==FALSE)
            {
                // Failed to Remove
                echo "<script>alert('Failed to Remove image file')</script>";
                $_SESSION['upload'] = "<div class='error'>Failed to Remove image file</div>";

                // Redirect to manage food
                echo "<script>window.open('manage-food.php','_self')</script>";
                // header('location:'.SITEURL.'admin/manage-food.php');

                // Stop the process of deleting food
                die();
            }   
            
        }

        // 3.Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        // 4.Redirect to manange page with session message

        if($res==TRUE)
        {
            // Food deleted
            echo "<script>alert('Food Deleted Successfully.')</script>";
                $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";

                // Redirect to manage food
                echo "<script>window.open('manage-food.php','_self')</script>";
                // header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            // Failed to delete food
            echo "<script>alert('Failed to delete Food.')</script>";
            $_SESSION['delete'] = "<div class='success'>Failed to delete Food.</div>";

            // Redirect to manage food
            echo "<script>window.open('manage-food.php','_self')</script>";
            // header('location:'.SITEURL.'admin/manage-food.php');

        }

        
    }
    else
    {
        // redirect to manage food page
        // echo "Redirect";
        echo "<script>alert('Unauthorized Action.')</script>";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Action. </div>";

        echo "<script>window.open('manage-food.php','_self')</script>";
        // header('location:'.SITEURL.'admin/manage-food.php');
    }
?>