<?php
    include('partials/menu.php');
?>

         <!-- Main Content Section Starts -->
         <div class="main-content">
         <div class="wrapper">
             <h1>Dashoard</h1>
                <br><br>
             <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
               <br><br>

                <div class="col-4 text-center">


                    <?php
                        // Sql Query
                        $sql = "SELECT * FROM tbl_category";

                        // Execute Query
                        $res = mysqli_query($conn, $sql);

                        // Count Rows
                        $count = mysqli_num_rows($res);
                    ?>
                    

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>

                <?php
                        // Sql Query
                        $sql2 = "SELECT * FROM tbl_food";

                        // Execute Query
                        $res2 = mysqli_query($conn, $sql2);

                        // Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    

                <div class="col-4 text-center">

                

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
                </div>

                    <?php
                        // Sql Query
                        $sql3 = "SELECT * FROM tbl_order";

                        // Execute Query
                        $res3 = mysqli_query($conn, $sql3);

                        // Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>


                <div class="col-4 text-center">
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Total Orders
                </div>

                <div class="col-4 text-center">

                <?php
                    // create sql quert to get total revenue generated
                    // AGgregate function in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered' ";

                    // Execute the query
                    $res4 = mysqli_query($conn, $sql4);

                    // Get the value 
                    $row4 = mysqli_fetch_assoc($res4);

                    // get the total revenue
                    $total_revenue = $row4['Total'];
                ?>


                    <h1>&#8377;<?php echo $total_revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Section Ends -->
<?php
    include('partials/footer.php');
?>
         