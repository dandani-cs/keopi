<?php
  $order_num = $_GET["NUM"];

  $db_name = "keopidb";
  $db_username = "root";
  $db_pass = "";
  $db_host = "localhost";
  $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

  $query = "UPDATE orders SET is_cancelled = 1 WHERE order_num = $order_num;";
  $results = mysqli_query($con, $query);

  $query = "UPDATE transactions SET cancelled = 1 WHERE order_num = $order_num;";
  $results = mysqli_query($con, $query);

  header("location: orders.php");

 ?>
