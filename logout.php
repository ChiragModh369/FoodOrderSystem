<?php
session_start();
if(!isset($_SESSION['username'])){
	echo "<script>alert('Logout Successfull')</script>";
	echo "<script>window.open('index.php','_self')</script>";
	// header("location:index.php");
}

session_unset();

session_destroy();

echo "you have Succesfully logout";

?>