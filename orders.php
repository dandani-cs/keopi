<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="master.css">
  <link rel="stylesheet" href="css/reports_styles.css" />

  <title>Keopi</title>

  <?php

  $db_name = "keopidb";
  $db_username = "root";
  $db_pass = "";
  $db_host = "localhost";
  $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

   ?>
   <?php  session_start();
    if($_SESSION['email']){ // will check if the user is logged-in

    }else{ // will return to login page if user is not logged in
      header("location:login.html");
    }
    $userRole = $_SESSION['is_admin']; //gets user role?>
</head>
<body>

 <div class="container-fluid" style="height:100%;">
    <div class="row gx-5">
      <div class="d-flex flex-row min-vh-100" id="" style="padding-left: 0px;">
        <div class="side-nav d-none d-md-block">
            <div class="text-center pt-3 mb-3">
                <img src="img/keopi-logo-transparent-black.png" style="width: 100%;" />
                <div class="d-flex flex-column">
            <?php
            if($userRole == 1){
            print
            '
                <a class="side-nav-item" href="user_management.php">
                    <div class="px-3 py-3">
                        <p class="my-0">User Management</p>
                    </div>
                </a>
                 <a class="side-nav-item side-nav-selected" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item" href="add-orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Order</p>
                    </div>
                </a>
                <a class="side-nav-item" href="products.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Products</p>
                    </div>
                </a>
                <a class="side-nav-item " href="reports_admin.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Reports</p>
                    </div>
                </a>
                <a class="side-nav-item" href="logout.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Logout</p>
                    </div>
                </a>';
                }
                else{
                  print '
                   <a class="side-nav-item side-nav-selected" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item" href="add-orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Order</p>
                    </div>
                </a>
                <a class="side-nav-item " href="reports_user.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Reports</p>
                    </div>
                </a>
                <a class="side-nav-item" href="logout.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Logout</p>
                    </div>
                </a>
                ';
                }
           ?>



            </div>
        </div>
      </div>

      <div class="col-sm-6 main-content">
        <div class="heading">
          <h1>ORDERS</h1>
        </div>
        <div class="row">
          <div class="col-sm-12 d-flex flex-row-reverse">
            <a href="add-orders.php"> <button type="button" name="button" class="btn btn-primary"> <i class="bi bi-plus-circle-fill"></i> Add transaction</button></a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-hover">
              <thead class="thead-light ">
                <th>Order Number</th>
                <th>Customer</th>
                <th>Price</th>
                <th>Actions</th>
              </thead>
              <?php
              $query = "SELECT * FROM orders;";
              $results = mysqli_query($con, $query);

              while ($row = mysqli_fetch_array($results)) {
                $order_num = $row["order_num"];

                $transactionArray = "[";

                $query2 = "SELECT * FROM transactions where order_num = " . $order_num;
                $transactionResults = mysqli_query($con, $query2);

                while ($row2 = mysqli_fetch_array($transactionResults)) {
                  $transNum = $row2["transaction_num"];
                  $transProd = $row2["product_num"];
                  $transQty = $row2["qty"];

                  $query3 = "SELECT * FROM products WHERE product_num = " . $row2["product_num"] . " LIMIT 1;";
                  $prodResults = mysqli_query($con, $query3);

                  while ($row3 = mysqli_fetch_array($prodResults)) {
                    $transProd = $row3["name"];
                  }

                  $transactionArray .= "{name: \"$transProd\", qty: $transQty},";
                }
                $transactionArray = rtrim($transactionArray, ',');
                $transactionArray .= "]";

                Print '<tr onclick=\'showOrderDetails("' . $row["order_num"] . '", "' . $row["order_date"] . '", "' . $row["quantity"] . '", "' . $row["total_amount"] . '", "' . $row["is_cancelled"] . '", '. $transactionArray .')\'>
                  <td class="align-middle">#' . $row["order_num"] . '</td>
                  <td class="align-middle">' . $row["customer_name"] . '</td>
                  <td class="align-middle">Php. ' . $row["total_amount"] . '</td>';

                  if ($row["is_cancelled"] == 0) {
                    Print '<td class="align-middle"> <a href="cancel-orders.php?NUM=' . $row["order_num"] . '"> <button type="button" name="button" class="btn btn-primary"><i class="bi bi-x-circle-fill"></i></button></a> </td>';
                  } else {
                    Print '<td class="align-middle"><button type="button" name="button" class="btn btn-primary cancelled" disabled><i class="bi bi-x-circle-fill"></i></button></td>';
                  }

                Print '</tr>';
              }
               ?>
            </table>
          </div>
        </div>
      </div>

      <div class="col-sm-4 side-content">
        <div class="order-details-tab">
          <div class="row">
            <div class="col-sm-12">
              <h4> ORDER DETAILS </h4>
            </div>
          </div>
          <div class="order-item">
            <div class="row">
              <div class="col-sm-12 order-header">
                <h5> Order # <span id="orderNum"></span> </h5>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 order-details-lbl">
                <p>Order Date</p>
              </div>
              <div class="col-sm-6">
                <span id="orderDate"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 order-details-lbl">
                <p>Order time</p>
              </div>
              <div class="col-sm-6">
                <span id="orderTime"></span>
              </div>
            </div>

            <div class="row">
              <table class="table">
                <thead>
                  <th>Orders</th>
                </thead>
                <tbody id="orderItems">
                </tbody>
              </table>
              <p>   </p>
            </div>

            <div class="row summary d-flex justify-content-end">
              <div class="col-sm-4">
                <p> TOTAL QUANTITY </p>
              </div>
              <div class="col-sm-4">
                <h5> <span id="totalQty"></span> </h5>
              </div>
            </div>
            <div class="row d-flex justify-content-end">
              <div class="col-sm-3">
                <p> TOTAL PRICE </p>
              </div>
              <div class="col-sm-4">
                <h5>Php <span id="totalAmt"></span> </h5>
              </div>
            </div>
            <div class="row d-flex justify-content-end">
              <div class="col-sm-6">
                <a href="/keopi/cancel_orders.php?NUM=" id="cancelBtn"><button type="button" name="button" class="btn btn-primary" id="checkCancelled"><i class="bi bi-x-circle-fill"></i> CANCEL ORDER</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript">

    function showOrderDetails(orderNum, orderDate, totalQty, totalAmt, is_cancelled, transactions) {
      document.getElementById("orderNum").innerHTML = orderNum;
      document.getElementById("orderDate").innerHTML = orderDate.split(" ")[0];
      document.getElementById("orderTime").innerHTML = orderDate.split(" ")[1];
      document.getElementById("totalQty").innerHTML = totalQty;
      document.getElementById("totalAmt").innerHTML = totalAmt;

      document.getElementById('orderItems').innerHTML = "";

      if (is_cancelled == "1") {
        document.getElementById('checkCancelled').disabled = true;
        document.getElementById('cancelBtn').setAttribute("href", "#");
      } else {
        document.getElementById('checkCancelled').disabled = false;
        document.getElementById('cancelBtn').setAttribute("href", "cancel_orders.php?NUM=" + orderNum);
      }



      transactions.forEach((item, i) => {
        var text = '<tr><td class="align-middle"> <input type="text" name="transaction[]" value="' + item.name + '" disabled> </td><td class="align-middle"> <input type="number" name="prodQuantity[]" value="' + item.qty + '" disabled> </td></tr>';
        document.getElementById('orderItems').innerHTML += text;
      });

    }
  </script>
</body>
</html>
