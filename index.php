<?php
include('partials-front/menu.php');
?>

<html>
<head>
    <title>Restaurant Website</title>
    

        <style>        
        .box-3
        {
            margin: 2%;
        }
        .w
        {
          width:126.6%;
        }

            </style>
    </head>
    
<body>




<!-- FOOD SEARCH Section Starts Here -->

<center>
<?php

if(isset($_SESSION['login_user']))
{
	echo "<h1 style='font-size:30px; font-family:Georgia; color:darkgreen;'>Welcome ";
	echo $_SESSION['login_user'];
}
?></center>


<section class="food-search text-center">

	<div class="container">
		<form action="<?php echo SITEURL; ?>food-search.php" method="post">
		<input type="search" name="search" placeholder="Search For Food..." required />
		<input type="submit" name="submit" value="Search" class="btn btn-primary"  />
		</form>
	</div>
</section>

<!-- FOOD SEARCH Section Ends Here -->


<?php
  if(isset($_SESSION['order']))
  {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
  }
?>

<!-- Category Starts Here -->

<section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
           
            <?php 
            
              // Create sql query to display categories from Database
              $sql = "SELECT * FROM tbl_category WHERE active ='Yes' AND featured = 'Yes' LIMIT 3";

              // Execute the query
              $res = mysqli_query($conn, $sql);

              // Count rows to check whether the category is available or not
              $count = mysqli_num_rows($res);
              
              if( mysqli_num_rows($res)>0)
              {
                // Categories Available
                while($row=mysqli_fetch_assoc($res))
                {
                  // get the values like id, title, image_name
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  ?>

                  <a href="<?php echo SITEURL;?>foods-category.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">

                        <?php

                          // check whether image is available or not
                          if($image_name=="")
                          {
                            // Display message
                            echo "<div class='error'>Image Not Available.</div>";
                          }
                          else
                          {
                            // Image Available
                            ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" style="width:400px; height:535px;">

                            <?php
                          }

                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                  </a>

                  <?php

                }
              }
              else
              {
                // Categories not available
                echo "<div class='error'>Category Not Added.</div>";
              }

            ?>  

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    
<!-- Category Section Ends Here -->



<!-- FOOD Menu Section Starts Here -->
  
	<section class="food-menu">
	
	<div class="container">
		
		<h2 class="text-center">Food Menu</h2>

    <?php

      // Getting food from database that are active and featured
      // Sql Query
      $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6 ";

      // Execute the query
      $res2 = mysqli_query($conn, $sql2);

      // Count Rows
      $count2 = mysqli_num_rows($res2);

      // Check whether food available or not
      if($count2>0)
      {
        // food available
        while($row=mysqli_fetch_assoc($res2))
        {
          // get all the values
          $id = $row['id'];
          $title = $row['title'];
          $price = $row['price'];
          $description = $row['description'];
          $image_name = $row['image_name'];
          ?>

          <div class="food-menu-box">
            <div class="food-menu-img">
              <?php 

                  // Check whether image avilable or not 
                  if($image_name=="")
                  {
                    // Image not Available
                    echo "<div class='error'>Image Not Available.</div>";
                  }
                  else
                  {
                    // image avaialble
                    ?>

                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve" style="height:140px;">

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
        // Food not avaialble
        echo "<div class='error'>Food not Available.</div>";
      }
    
    ?>

	


	<div class="clearfix"></div>
	</div>

	<p class="text-center">
		<a href="category-foods.php">See All Foods</a>
	</p>
    </section>
	</section>



<!-- FOOD Menu Section Ends Here -->
	
<!-- Loader Section JavaScript -->
<!-- <script>
  $(window).on('load',function()
  {
    $(".loader").fadeOut(1000);
    $(".content").fadeIn(1000);
  });
</script> -->


</body>
</html>

<?php
include('partials-front/footer.php');
?>
</div>