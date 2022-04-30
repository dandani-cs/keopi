<?php 
session_start(); //starts the session
header("location:products.php"); // redirects if user is not logged in


$con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error()); //Connect to server
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM products WHERE product_num='$id'");
header("location: products.php");
 ?>