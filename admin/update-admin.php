<?php
    include('partials/menu.php');
    
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>

        <?php 
            // 1.Get The id of selected Admin
            $id = $_GET['id'];

            // 2.Create sql Query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            // Execute the query
            $res=mysqli_query($conn, $sql);

            // Check whether the query is executed

            if($res==TRUE)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                // Check whether we have admin data or not
                if($count==1)
                {
                    // Get the details 
                    // echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    // Redirect to Manage-admin Page
                    header('location'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary" >
                    </td>
                </tr>
            </table>

        </form>
    </div>

</div>

<?php

            // Check whether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                // echo "Button Clicked";
                // Get All the Value From form to update 
                 $id = $_POST['id'];
                 $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                 $username = mysqli_real_escape_string($conn, $_POST['username']);

                //  create a sql query to Update Admin
                $sql = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' WHERE id='$id'";

                // Execute the query

                $res = mysqli_query($conn, $sql); 

                // Check whether the query executed sucessfully or not

                if($res)
                {
                    
                    // Query Executed and admin Updated
                    echo "<script>alert('User Has Been Updated Successfully')</script>";

                    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";

                    // // Redirect to manage admin page
                    echo "<script>window.open('manage-admin.php','_self')</script>";


                    // header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    // // Failed to Update Admin
                    echo "<script>alert('Failed to Update Admin')</script>";
                    $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";

                    // // Redirect to manage admin page
                    echo "<script>window.open('manage-admin.php','_self')</script>";

                    // header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
?>


<?php
    include('partials/footer.php');
?>