<?php
include('config/constants.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Restaurant Website</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<!-- <div id="preloader"></div> -->

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
                        <a href="<?php echo SITEURL; ?>" class="pad">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>Categories.php" class="pad">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>category-foods.php" class="pad">Foods</a>
                    </li>
					<li>
                        <?php if(isset($_SESSION['login_user'])) { ?> 
						
           <a  href="logout.php" onClick="myFunction()" style="text-decoration:none" class="pad">Logout</a>
  <?php }else { ?><a  href="login.php" class="pad">Login/Signup </a><?php } ?>
                    </li>
					
               </ul>
				
		</div>
		<div class="clearfix"></div>
	</div>
	<!--	Header Section End -->
	

    <!-- Page Loader java Script -->
    <!-- <script>

    var loader = document.getElementById("preloader");
    window.addEventListener("load", function()
    {
    loader.style.display = "none";
    })

    </script> -->
    
</body>
</html>
