<?php
include('partials-front/menu.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Restaurant Website</title>
</head>

<body>

<!-- FOOD SEARCH Section Starts Here -->

<section class="food-search text-center">

	<div class="container">
		<form action="<?php echo SITEURL; ?>food-search.php" method="post">
		<input type="search" name="search" placeholder="Search For Food..." required />
		<input type="submit" name="submit" value="Search" class="btn btn-primary"  />
		</form>
	</div>
</section>

<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD Menu Section Starts Here -->

	<section class="food-menu">
	
	<div class="container">
		
		<h2 class="text-center">Food Menu</h2>

        <?php

            // Display Food that are active
            $sql = "SELECT * FROM tbl_food WHERE active = 'Yes' ";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // Count Rows
            $count = mysqli_num_rows($res);

            // check whether the food are available or not
            if($count>0)
            {
                // Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    // get the values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">

                            <?php

                                // Check whether image is available or not
                                if($image_name=="")
                                {
                                    // Image not Available
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    // image avaialble
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve" style="height:125px;">

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

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>



                    <?php

                }
            }
            else
            {
                // Food not available
                echo "<div class='error'Food Not Found></div>";
            }

        ?>

	
	


	<div class="clearfix"></div>
	</div>

	
    </section>
	</section>



<!-- FOOD Menu Section Ends Here -->
	
	
</body>
</html>

<?php
include('partials-front/footer.php');
?>