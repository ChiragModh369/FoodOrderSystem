<?php
include('config/constants.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order</title>
<link rel="stylesheet" href="css/style.css" />

</head>

<body>

<!--	Header Section Start -->
	
<div class="container">
	
	
	<div class="logo">
		<a href="index.php" title="logo">
		<img src="images/logo.png" alt="Restaurant Logo" class="img-responsive" />
		</a>
	</div>


<div class="menu text-right" >
	<ul>
			<li>
				<a href="<?php echo SITEURL; ?>">Home</a>
			</li>
			<li>
				<a href="<?php echo SITEURL; ?>Categories.php">Categories</a>
			</li>
			<li>
				<a href="<?php echo SITEURL; ?>category-foods.php">Foods</a>
			</li>
			<li>
				<?php if(isset($_SESSION['login_user'])) { ?> 
				
				<a  href="logout.php" onClick="myFunction()" style="text-decoration:none">logout</a>
				<?php }else { ?><a  href="login.php">login/Signup </a><?php } ?>
			</li>
			
	   </ul>
		
</div>
<div class="clearfix"></div>
</div>
<!--	Header Section End -->
					



<?php

	// check whether food id is set or not
	if(isset($_GET['food_id']))
	{
		// Food id and details of the selected food
		$food_id = $_GET['food_id'];

		// get the details of the selected food
		$sql = "SELECT * FROM tbl_food WHERE id=$food_id ";

		// execute the query
		$res = mysqli_query($conn, $sql);

		// count the rows
		$count = mysqli_num_rows($res);

		// check whether data is available or not
		if($count==1)
		{
			// we have data
			// get the data from database
			$row = mysqli_fetch_assoc($res);

			$title = $row['title'];
			$price = $row['price'];
			$image_name = $row['image_name'];
		}
		else
		{
			// Food Not Available
			// Redirect to Homepage
			header('location:'.SITEURL);
		}
	}
	else
	{
		// Redirect to Homepage
		header('location:'.SITEURL);
	}

?>

<!-- Food Order Section Starts Here -->

<section class="food-search" >
	<div class="container">
		<h2 class="text-center text-white">Fill This Form To Confirm Your Order</h2>
		
		<form action="" method="POST" class="order">
		<fieldset>
			<legend>Selected Food</legend>
			
			<div class="food-menu-img">

			<?php

				// check whether image is available or not
				if($image_name=="")
				{
					// image not available
					echo "<div class='error'>Image not Available.</div>";
				}
				else
				{
					// Image is available
					?>

					<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Hawain Pizza" class="img-responsive img-curve" style="height:125px;"/>

					<?php

				}

			?>


			
			</div>
				
			<div class="food-menu-desc"> 
				<h3><?php echo $title; ?></h3>

				<input type="hidden" name="food" value="<?php echo $title; ?>">

				<p class="food-price">&#8377;<?php echo $price; ?></p>

				<input type="hidden" name="price" value="<?php echo $price; ?>">
				
				
				<div class="order-label">Quantity</div>
					<input type="number" name="qty" value="1" required />
			</div>
		</fieldset>
		
		<fieldset>
		
			<legend>Delivery Details</legend>
			
			<div class="order-label">Full Name</div>
			<input type="text" name="full-name" placeholder="E.g. Mahesh Patel" class="input-responsive" reqiuired />
			
			<div class="order-label">Phone Number</div>
			<input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" reqiuired />
			
			<div class="order-label">Email</div>
			<input type="email" name="email" placeholder="E.g hi@onlinefoodorder.com" class="input-responsive" reqiuired />
			
			<div class="order-label">Address</div>
			<textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
			
			<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />
		</fieldset>
		</form>

		<?php

				// check whether submit button is clicked or not
				if(isset($_POST['submit']))
				{
					// get all the details from form	
					
					$food = $_POST['food'];
					$price = $_POST['price'];
					$qty = $_POST['qty'];

					$total = $price * $qty; //Total = Price * Quantity

					$order_date = date("Y-m-d h:i:sa"); //Order Date

					$status = "Ordered"; //Ordered, on Delivery, Delivered, Cancelled

					$customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
					$customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
					$customer_email = mysqli_real_escape_string($conn, $_POST['email']);
					$customer_address = mysqli_real_escape_string($conn, $_POST['address']);

					// Save the order in database
					// create sql to save th data

					$sql2 = "INSERT INTO tbl_order SET 
						food = '$food',
						price = $price,
						qty = '$qty',
						total = $total,
						order_date = '$order_date',
						status = '$status',
						customer_name ='$customer_name',
						customer_contact = '$customer_contact',
						customer_email = '$customer_email',
						customer_address = '$customer_address'
					";

					// echo $sql2;
					// die();
 
					// execute the query
					$res2 = mysqli_query($conn, $sql2);

					// Check whether query executed successfully or not
					if($res2==TRUE)
					{
						// query executed and order saved
						echo "<script>alert('Food Ordered Successfully.')</script>";
						$_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";

						echo "<script>window.open('index.php','_self')</script>";
						// header('location:'.SITEURL);
					}
					else
					{
						// Failed to save order
						echo "<script>alert('Failed to Order Food.')</script>";
						$_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";

						echo "<script>window.open('index.php','_self')</script>";
						// header('location:'.SITEURL);
					}

				}

				// 
				if(!$_SESSION['login'])
				{
					header("location:login.php");
					die;
				}
				 

		?>


	</div>
</section>

<!--Food Order Section Ends Here-->
</body>
</html>

<?php
include('partials-front/footer.php');
?>