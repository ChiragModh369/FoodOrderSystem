<?php
    include('partials/menu.php');
?>

<html>
    <head>
        <title></title>
       
    </head>
    <body>
        <div class="main-content">
        <div class="wrapper">
            <br>
            <h1>Add Admin</h1>
            <br>

            <?php
                if(isset($_SESSION['add'])) //Checking whether session is set or not
                {
                    echo $_SESSION['add']; //Display Session message
                    unset($_SESSION['add']); //Remove Session Message
                }
            ?>
            <br>
            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name">
                        </td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Your Username">
                        </td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>
        </div>
        </div>
    </body>
</html>



<?php
    include('partials/footer.php');
?>


<?php
    // Process The Value From form and save it in Database

    // Check Whether the Submit Button Clicked Or Not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        // echo "Button Clicked";

        // 1.Get the Data from form

        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5(($_POST['password'])); //Password Encryption with MD5

        // 2.SQL Query to save the data into Database

        $sql = "INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";

        
        // 3.Executing query and saving data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4.Check whether the (Query is Exectued) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            // Data Inserted
            // echo "Data inserted";
            // Create a session variable to display message
            echo "<script>alert('Admin Added Successfully')</script>";
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            
            // Redirect page to manage admin
            echo "<script>window.open('manage-admin.php','_self')</script>";
            // header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // Failed to Insert Data
            // echo "Failed to insert data";
            // Create a session variable to display message
            echo "<script>alert('Failed to add Admin')</script>";
            $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";

            // Redirect page to manage admin
            echo "<script>window.open('add-admin.php','_self')</script>";
            // header("location:".SITEURL.'admin/add-admin.php');
        }

    }


?>