<?php
	include('partials-front/menu.php');
?>

<?php

	if(isset($_POST['signup']))
	{
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email =  mysqli_real_escape_string($conn, $_POST['email']);
    	$password = $_POST['password'];
		

		$sql = "INSERT INTO signup SET username = '$username', email = '$email', password = '$password' ";

		$res = mysqli_query($conn, $sql);

		if($res==TRUE)
        {
            
            echo "<script>alert('Registered Successfully Successfully')</script>";
            
            echo "<script>window.open('login.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Failed to Registered Please Try again....')</script>";

            echo "<script>window.open('login.php','_self')</script>";
            
        }

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login And Registration Form</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/5.6.3/css/all.css">

	<style>
		 /* Password Visible Button CSS For Login */
            .span
            {
                position: absolute;
                right: 20px;
                transform: translate(50%, -50%);
                top: 41%;
                cursor: pointer;
            }
            .fa
            {
                font-size: 20px;
                color: #7a797e; 
            }
			
			/* For the Label Animation */
			.inputBox
			{
				position: relative;
			}
			.inputBox label
            {
                position: absolute;
                top: 0;
                left:0;
                letter-spacing: 1px;
                padding: 10px 0;
                font-size: 16px;
                transition: 0.5s;
            }
			.inputBox input:focus ~ label, 
            .inputBox input:valid ~ label
            {
                top: -10px;
                left: 0;
                color: #03a9f4;
                font-size: 12px;
            }

			
			/* Password Visible Button CSS For Login */
            .span-login
            {
                position: absolute;
                right: 3px;
                transform: translate(0, 50%, -50%);
                top: 34%;
                cursor: pointer;
            }
            .fa
            {
                font-size: 20px;
                color: #7a797e; 
            }
			#hide1
            {
                display: none;
            }
			
			/* Password Visible Button CSS For Register */
            .span-register
            {
                position: absolute;
                right: 2px;
                transform: translate(0, 50%, -50%);
                top: 43%;
                cursor: pointer;
            }
            .fa
            {
                font-size: 20px;
                color: #7a797e; 
            }
			#hide1
            {
                display: none;
            }

	</style>
</head>


<body>
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn">

				</div>
				<button type="button" class="toggle-btn" onclick="login()">Log In</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>
				
			</div>
			<div class="social-icons">
				<img src="images/Login/fb.png">
				<img src="images/Login/tw.png">
				<img src="images/Login/gp.png">
			</div>

			<form action="" id="login" method="POST" class="input-group">
				<div class="inputBox">
					<input type="text" name="username" id="" class="input-field" required>
					<label>Username</label>
				</div>
				
				<div class="inputBox">
					<input type="password" name="password" id="login_password" class="input-field" required>
					<label>Password</label>

					<span class="span-login" onclick="toggle()">
                    <i id="hide1" class="fa fa-eye"></i>
                    <i id="hide2" class="fa fa-eye-slash"></i>
					</span>

				</div>

				<input type="checkbox" name="" class="check-box"><span>Remember Password</span>
				<button type="submit" name="submit" class="submit-btn">Login</button>

			</form>

			<script>
            function toggle()
				{
					var x = document.getElementById("login_password");
					var y = document.getElementById("hide1");
					var z = document.getElementById("hide2");

					if(x.type == 'password')
					{
						x.type = 'text';
						y.style.display = "block";
						z.style.display = "none";
					}
					else
					{
						x.type = 'password';
						y.style.display = "none";
						z.style.display = "block";
					}
				}
			</script>

			
				

			<form action="" id="register" method="POST" class="input-group">

				<div class="inputBox">
					<input type="text" name="username" id="" class="input-field" required>
					<label>Username</label>
				</div>

				<div class="inputBox">
					<input type="email" name="email" id="" class="input-field" required>
					<label>Email</label>
				</div>
				

				<div class="inputBox">
					<input type="password" name="password" id="register_password" class="input-field" required>
					<label>Password</label>
				</div>
				<span class="span-register" onclick="myFunction()">
                    <i id="hide1" class="fa fa-eye"></i>
                    <i id="hide2" class="fa fa-eye-slash"></i>
                 </span>

				<input type="checkbox" name="" class="check-box"><span>I agree to the terms & conditions.</span>
				<button type="submit" name="signup" class="submit-btn">Register</button>

			</form>

			<!-- Password Visible Script For Login -->
			
			<script>
				function myFunction()
				{
					var x = document.getElementById("register_password");
					var y = document.getElementById("hide1");
					var z = document.getElementById("hide2");

					if(x.type == 'password')
					{
						x.type = 'text';
						y.style.display = "block";
						z.style.display = "none";
					}
					else
					{
						x.type = 'password';
						y.style.display = "none";
						z.style.display = "block";
					}
				}
			</script>

		</div>
		
	</div>



	<script>
		var x = document.getElementById("login");
		var y = document.getElementById("register");
		var z = document.getElementById("btn");

		function register()
		{
			x.style.left = "-400px";
			y.style.left = "50px";
			z.style.left = "110px";
		}

		function login()
		{
			x.style.left = "50px";
			y.style.left = "450px";
			z.style.left = "0";
		}

	</script>

	<?php

		if(isset($_POST['submit']))
		{
			// username and password sent from form
			$db = mysqli_connect("localhost", "root", "", "food-order");
			$username=mysqli_real_escape_string($db,$_POST['username']);
			$password=mysqli_real_escape_string($db,$_POST['password']);
			$selectsql="SELECT username,password FROM signup WHERE username='$username' and password='$password'";
			$result=mysqli_query($db,$selectsql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active=$row['active'];
			$username=$row['username'];
			$pass=$row['password'];
			$count=mysqli_num_rows($result);
			// If result matched $username and $password, table row must be 1 row
			if($count==1)
			{
				$_SESSION['login'] = true;
				$_SESSION['login_user']=$username;
				$_SESSION['user']=$username;
				$_SESSION['pass']=$password;
				header('location:order.php');
				echo "<script>alert('Login Successfull')</script>";
				echo "<script>window.open('index.php','_self')</script>";

			}
			else
			{
				echo "<script>alert('Username or Password did not match.')</script>";
				echo "<script>window.open('login.php','_self')</script>";
				// echo('Your username or Password is incorrect...please try again');
			}
		}

	?>

</body>
</html>
<?php
	include('partials-front/footer.php');
?>