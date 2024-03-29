<?php
    include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

            // Check whether the id is set or not
            if(isset($_GET['id']))
            {
                // get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                // Create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                // Execute the query
                $res = mysqli_query($conn,$sql);
                
                // Count the rows to check whether the  id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Get all the data 
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // Redirect to Manage category page with session message
                    echo "<script>alert('Category Not Found. ')</script>";
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";

                    // Redirect to Manage Category
                    echo "<script>window.open('manage-category.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php 
                        if($current_image != "")
                        {
                            // Display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                        else
                        {
                            // Display message
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes

                    <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No" >No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" >Yes

                    <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No" >No
                </td>
            </tr>

            <tr>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <td><input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
                
            </tr>

        </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // 1.Get all the values from our form

                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2.updating new image if selected
                // check whehter the image is selected or not   
                if(isset($_FILES['image']['name']))
                {
                    // get hte image details 
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is available or not
                    if($image_name != "")
                    {
                        // image available
                        // A.Upload the new image

                        
                        // Auto Rename our image
                        // Get hte Extension of our image (jpg, png, gif, etc) ex. "food1.jpg"
                        $ext = end(explode('.',$image_name));

                        // Rename the image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // Finally Upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        // Check whether the image is uploaded or not 
                        // and if the image is not uploaded then we will stop the process and redirect with eror message
                        if($upload == FALSE)
                        {
                            // Set Message
                            echo "<script>alert('Failed to upload image')</script>";
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";

                            // Redirect to Add Category page
                            echo "<script>window.open('manage-category.php','_self')</script>";
                            // header('location:'.SITEURL.'admin/manage-category.php');
                            // Stop the process
                            die();
                        }


                        // B.Remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            // check whether the image is removed or not

                            // if failed to remove the display message and stop the process
                            if($remove==false)
                            {
                                // Failed to remove image
                                echo "<script>alert('Failed to Remove Current Image.')</script>";
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image.</div>";

                                // Redirect to manage category page
                                echo "<script>window.open('manage-category.php','_self')</script>";
                                // header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //Stop the process
                            }
                        }

                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // 3.Update the database
                $sql2 = "UPDATE tbl_category SET 
                title = '$title', 
                image_name='$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                // Execute the query
                $res2 = mysqli_query($conn,$sql2);

                // 4.Redirect to manage category with message
                // check whether query executed or not
                if($res2==TRUE)
                {
                    // category updated 
                    echo "<script>alert('Category Updated Successfully')</script>";
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    // Redirect to manage category page
                    echo "<script>window.open('manage-category.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to update category
                    echo "<script>alert('Failed to update Category.')</script>";
                    $_SESSION['update'] = "<div class='error'>Failed to update Category.</div>";
                    // Redirect to manage category page
                    echo "<script>window.open('manage-category.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
             

        ?>
    </div>
</div>


<?php
    include('partials/footer.php');
?>