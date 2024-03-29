 <?php
 include('partials/menu.php');
 ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Add Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-- Add Category Form Starts -->

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <!-- Add Category Form Ends -->

        <?php

            // Check whether the submit button will clicked or not

            if(isset($_POST['submit']))
            {
                // echo "Clicked";

                // 1.Get the value from Category form
                $title = mysqli_real_escape_string($conn, $_POST['title']);

                // For Radio input type we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    // Get the Value From Form
                    $featured = $_POST['featured'];
                }
                else
                {
                    // Set the default value
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // Check whether the image os selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);

                // die(); //Brek the code here

                if(isset($_FILES['image']['name']))
                {
                    // Upload the Image only
                    // To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // Upload image only if image is selected
                    if($image_name != "")
                    {

                    
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
                            echo "<script>window.open('add-category.php','_self')</script>";
                            // header('location:'.SITEURL.'admin/add-category.php');
                            // Stop the process
                            die();
                        }

                    }
                }
                else
                {
                    // Don't Upload Image and the set the image name value as blank
                    $image_name = "";
                }

                // 2.Create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

                // 3.Execute the query and save in database
                $res = mysqli_query($conn,$sql);

                // 4.Check whether the query executed or not and data added or not
                if($res = TRUE)
                {
                    // Query executed and category added
                    echo "<script>alert('Category Added Successfully')</script>";

                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";

                    // Redirect to manage category page
                    echo "<script>window.open('manage-category.php','_self')</script>";

                    // header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to add Category
                    echo "<script>alert('Failed to Add Category')</script>";

                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";

                    
                    // Redirect to manage category page
                    echo "<script>window.open('add-category.php','_self')</script>";

                    // header('location:'.SITEURL.'admin/add-category.php');
                }

            }

        ?>

     </div>
 </div>


 <?php
 include('partials/footer.php'); 
 ?>