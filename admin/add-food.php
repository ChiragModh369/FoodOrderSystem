<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food.">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                                // Create php code to display categories from database

                                // 1.Create sql query to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                                // Executing the query
                                $res = mysqli_query($conn,$sql);

                                // Count rows to check whehter we have the categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero we have categories else we do not have categories
                                if($count>0)
                                {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>


                                        <?php
                                    }
                                }
                                else
                                {
                                    // We do not have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                // Display on Dropdown
                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php

            // Check whehter the button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add thr food in database
                // echo "Clicked";

                // 1.Get the data from form 

                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                // whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting default value
                }
                
                // 3.Upload the image if selected
                // Check whether the select image is clicked or not and upload the image only if image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the details of the selected images
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is selected or not and uplaod image only if selected
                    if($image_name!="")
                    {
                        // image is selected
                        // A.Rename the image
                        // get the extension of tjhe selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // Create new name for image   
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Name-657.jpg"


                        // B.Upload the image
                        // get the source path and destination path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // destination path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        // Finally upload food image
                        $upload = move_uploaded_file($src, $dst);   

                        // check whether the image uploaded or not
                        if($upload == FALSE)
                        {
                            // Failed to upload the image
                            echo "<script>alert('Failed to upload image')</script>";
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            // Redirect to add food page with error message

                            echo "<script>window.open('add-food.php','_self')</script>";
                            // header('location:'.SITEURL.'admin/add-food.php');
                            
                            // stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; //setting default value as blank
                }

                // 3.insert into database
                // create a sql query to save or add food 
                $sql2 = "INSERT INTO tbl_food SET title = '$title', description = '$description', price = $price, image_name = '$image_name', category_id = $category, featured = '$featured', active = '$active' ";
                // execute hte query
                $res2 = mysqli_query($conn, $sql2);
                // check whether the data is inserted or not

                // 4.Redirect with message to manage food page
                if($res2 == TRUE)
                {
                    // data inserted successfully
                    echo "<script>alert('Food Added Successfully')</script>";
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";

                    echo "<script>window.open('manage-food.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // failed to insert data
                    echo "<script>alert('Failed to Add Food...')</script>";
                    $_SESSION['add'] = "<div class='success'>Failed to Add Food...</div>";

                    echo "<script>window.open('manage-food.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>


    </div>
</div>


<?php
    include('partials/footer.php');
?>