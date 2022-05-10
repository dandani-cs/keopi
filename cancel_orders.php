<?php
  $order_num = $_GET["NUM"];

  $db_name = "epiz_31692043_keopidb";
  $db_username = "epiz_31692043";
  $db_pass = "AVcoLaXFsz";
  $db_host = "sql111.epizy.com";
  $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

  $query = "UPDATE orders SET is_cancelled = 1 WHERE order_num = $order_num;";
  $results = mysqli_query($con, $query);

  header("location: orders.php");

 ?>
