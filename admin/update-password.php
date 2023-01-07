<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>

        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" required> 
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </td>
                <tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </td>
                <tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;    ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

                </tr>
            </table>
        </form>
    </div>
</div>

<?php

        // Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            // echo "Clicked";

            // 1.Get the Data From form
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // 2.Check whether the user current ID and current Password Exists or not

            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            // execute  the query

            $res = mysqli_query($conn, $sql);
            if($res==TRUE)
            {
                // Whether data is available or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // User Exists and password can be changed
                    // echo "User Found";

                    // Check Whether the new password and confirm password match or not
                    if($new_password==$confirm_password)
                    {
                        // Update the password
                        // echo "Password Match"; 

                        $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                        // Execute Query
                        $res2 = mysqli_query($conn,$sql2);

                        // Check whether the query executed or not
                        if($res2==TRUE)
                        {
                            // Display Success Message

                            // Redirect to manage admin page with error message
                            echo "<script>alert('Password Change Successfully.')</script>";
                            $_SESSION['change-pwd'] = "<div class='success'>Password Change Successfully.</div>";

                            // Redirect the user
                            echo "<script>window.open('manage-admin.php','_self')</script>";
                            // header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                        else
                        {
                            // Display Error Message
                             // Redirect to manage admin page with error message
                             echo "<script>alert('Failed to Change Password.')</script>";
                             $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";

                             // Redirect the user
                             echo "<script>window.open('manage-admin.php','_self')</script>";
                            //  header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        // Redirect to manage admin page with error message
                        echo "<script>alert('Password did not Match.')</script>";
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password did not Match.</div>";

                        // Redirect the user
                        echo "<script>window.open('manage-admin.php','_self')</script>";
                        // header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    // User Does not exists Set Message and Redirect
                    echo "<script>alert('Please Enter Correct Password.')</script>";
                    $_SESSION['user-not-found'] = "<div class='error'>Please Enter Correct Password.</div>";

                    // Redirect the user
                    echo "<script>window.open('manage-admin.php','_self')</script>";
                    // header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

            // 3.Check whether the new password and Confirm Password Match or not

            // 4.Change Password if all above is true
        }

?>


<?php
    include('partials/footer.php');
?>