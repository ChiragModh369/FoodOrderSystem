<?php
    include('../config/constants.php');
?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <!-- <link rel="stylesheet" href="../css/admin.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            *
            {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: poppins;
            }
            body
            {
                background-color: #E8EDF2;
            }
            div.container
            {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                display: flex;
                flex-direction: row;
                align-items: center;
                background-color: white;
                padding: 30px;
                box-shadow: 0 50px 50px -50px darkslategray;
            }
            div.container div.myform
            {
                width: 270px;
                margin-right: 30px;
            }
            div.container div.myform h2
            {
                color: #1c1c1e;
                margin-bottom: 20px;
            }
            div.container div.myform input
            {
                border: none;
                outline: none;
                border-radius: 0;
                width: 100%;
                border-bottom: 2px solid #1c1c1e;
                margin-bottom: 25px;
                padding: 7px 0;
                font-size: 14px;
            }
            div.container div.myform button
            {
                color: white;
                background-color: #1c1c1e;
                border: none;
                outline: none;
                border-radius:  2px;
                font-size: 14px;
                padding: 5px 12px;
                cursor: pointer;
            }
            div.container div.image img
            {
                width: 300px;
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
                top: -20px;
                left: 0;
                color: #03a9f4;
                font-size: 12px;
            }
            
            /* Password Visible Button CSS */
            span
            {
                position: absolute;
                right: 12px;
                transform: translate(50%, -50%);
                top: 30%;
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
        
        <div class="container">
            <div class="myform">
            
            <!-- <br><br> -->

            <?php
                // if(isset($_SESSION['login']))
                // {
                //     echo $_SESSION['login'];
                //     unset($_SESSION['login']);
                // }

                // if(isset($_SESSION['no-login-message']))
                // {
                //    echo $_SESSION['no-login-message'];
                //     unset($_SESSION['no-login-message']);
                // }
            ?>
            <!-- <br><br> -->

            <!-- Login Form Starts Here -->

            <form action="" method="POST" >
                <h2>ADMIN LOGIN</h2>
                <!-- Username: <br> -->
                <div class="inputBox">
                <input type="text" name="username" required>
                <label>Username</label>
                </div>

                <div class="inputBox">
                <!-- Password: <br> -->
                <input type="password" name="password" id="myInput" required> 
                <label>Password</label>
                <span class="eye" onclick="myFunction()">
                    <i id="hide1" class="fa fa-eye"></i>
                    <i id="hide2" class="fa fa-eye-slash"></i>
                 </span>
                </div>

                <button type="submit" name="submit">LOGIN</button>
                <!-- <input type="submit" name="submit" value="Login" class="btn-primary"> -->
                <!-- <br><br> -->
            </form>

            <!-- Login Form Ends Here -->
            

            <!-- <p class="text-center">Created By - <a href="www.chiragmodh.com">Chirag Modh</a></p> -->
            </div>

            <div class="image">
                <img src="../images/image.jpg">
            </div>

        </div>

        <script>
            function myFunction()
            {
                var x = document.getElementById("myInput");
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

    </body>
</html>

<?php
    // Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Process for login

        // 1.Get the data from login form
        // $username=$_POST['username'];
        //  $raw_password = md5($conn, $_POST['password']);
        //  $password = mysqli_real_escape_string($conn, $raw_password);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password=md5($_POST['password']);
        

        // 2.Sql to check whether the username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3.Execute the query
        $res = mysqli_query($conn, $sql);

        // 4.count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user available and Login Success

            $_SESSION['login'] = "<div class='success text-center'>Welcome $username</div>";
            $_SESSION['user'] = $username; //To check whether the user logged in or not and logout will unset it
            echo "<script>alert('Login Successfull')</script>";

            // Redirect to homepage or Dashboard

            // header('location'.SITEURL.'index.php');
            echo "<script>window.open('index.php','_self')</script>";

        }
        else
        {
            // User not available

            // $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            echo "<script>alert('Username or Password did not match.')</script>";

            // Redirect to homepage or Dashboard

            // header('location'.SITEURL.'login.php');
            echo "<script>window.open('login.php','_self')</script>";

        }



    }

?>