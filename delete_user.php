<?php 
session_start(); //starts the session
header("location:user_management.php"); // redirects if user is not logged in


$con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error()); //Connect to server
$userid = $_GET['userid'];
mysqli_query($con, "DELETE FROM users WHERE userid='$userid'");
header("location: user_management.php");
 ?>