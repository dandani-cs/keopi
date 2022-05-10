<?php 
session_start(); //starts the session
header("location:products.php"); // redirects if user is not logged in


$db_name = "epiz_31692043_keopidb";
$db_username = "epiz_31692043";
$db_pass = "AVcoLaXFsz";
$db_host = "sql111.epizy.com";
$con = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die(mysqli_error()); //Connect to server
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM products WHERE product_num='$id'");
header("location: products.php");
 ?>