<?php
include('partials-front/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
	<link rel="stylesheet" href="css/style.css" />

</head>

<body>


   
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

				// Get the Search Keyword
                $search = mysqli_real_escape_string($conn, $_POST['search']);
				// $search = $_POST['search'];

			?>
            <h2>Foods on Your Search "<?php echo $search; ?>"</h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // sql query to get food based on search keyword
                // $search = burger '; DROP database name;
                // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger'%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // Count Rows
                $count = mysqli_num_rows($res);

                // check whether food available or not
                if($count>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php

                                // Check whether image name is available or not
                                if($image_name=="")
                                {
                                    // image not available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" style="height:125px;">

                                    <?php
                                }

                            ?>



                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">&#8377;<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php
                    }
                }
                else
                {
                    // Food not available
                    echo "<div class='error'>Food not found.</div>";
                }



            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    

</body>
</html>

<?php
include('partials-front/footer.php');
?>