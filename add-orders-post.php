<?php
$db_name = "epiz_31692043_keopidb";
$db_username = "epiz_31692043";
$db_pass = "AVcoLaXFsz";
$db_host = "sql111.epizy.com";
$con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_amount = $_POST["totalPrice"];
    $qty = $_POST["totalQty"];
    $customer_name = $_POST['customerName'];
    $transaction = $_POST['transaction'];
    mysqli_query($con, "INSERT INTO orders (total_amount, quantity, customer_name) VALUES ('$total_amount', '$qty', '$customer_name')");

    $query = "SELECT * FROM orders ORDER BY order_num DESC LIMIT 1";
    $results = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($results)) {
      for ($i = 0; $i < count($_POST["productNum"]); $i++) {
        $product_num = $_POST["productNum"][$i];
        $order_num = $row["order_num"];
        $prodqty = $_POST["prodQuantity"][$i];
        mysqli_query($con, "INSERT INTO transactions (product_num, order_num, qty) VALUES ('$product_num', '$order_num', '$prodqty')");

      } // for loop end
    } // while results end
    header("location: orders.php");
  } // if POST end
 ?>
