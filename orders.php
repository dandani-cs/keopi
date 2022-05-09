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

  <title>Keopi</title>

  <?php

  $db_name = "keopidb";
  $db_username = "root";
  $db_pass = "";
  $db_host = "localhost";
  $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

   ?>
</head>
<body>

  <div class="container-fluid" style="height:100%;">
    <div class="row gx-5">
      <div class="col-sm-2 nav-col">
        <div class="profile-mini text-center">
          <img src="logo.png" class="rounded mx-auto d-block profile-pic title">
        </div>
        <ul class="nav flex-column nav-pills nav-justified">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-basket-fill"></i>Transact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-bag-plus-fill"></i>Add transaction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-archive-fill"></i>Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="bi bi-clipboard-data-fill"></i>Reports</a>
          </li>

          <li class="nav-item">
            <a class="nav-link logout"><i class="bi bi-box-arrow-left"></i>Log Out</a>
          </li>


        </ul>
      </div>

      <div class="col-sm-6 main-content">
        <div class="heading">
          <p>Today is...</p>
          <h1>FRI, APRIL 12, 2022</h1>
        </div>
        <div class="row">
          <div class="col-sm-12 d-flex flex-row-reverse">
            <a href="#"> <button type="button" name="button" class="btn btn-primary"> <i class="bi bi-plus-circle-fill"></i> Add transaction</button></a>
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

                Print '<tr onclick=\'showOrderDetails("' . $row["order_num"] . '", "' . $row["order_date"] . '", "' . $row["quantity"] . '", "' . $row["total_amount"] . '", '. $transactionArray .')\'>
                  <td class="align-middle">#' . $row["order_num"] . '</td>
                  <td class="align-middle">' . $row["customer_name"] . '</td>
                  <td class="align-middle">Php. ' . $row["total_amount"] . '</td>
                  <td class="align-middle"> <button type="button" name="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button> <button type="button" name="button" class="btn btn-primary" onclick="cancel"><i class="bi bi-trash3-fill"></i></button> </td>
                </tr>
                ';
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
                <h5> Order # <span id="orderNum">#2022456789</span> </h5>
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
              <p> <em>Special Instructions: Less ice on all</em>  </p>
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
                <a href="/keopi/cancel_orders.php?NUM=45" id="cancelBtn"><button type="button" name="button" class="btn btn-primary"><i class="bi bi-x-circle-fill"></i> CANCEL ORDER</button></a>
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
    function showOrderDetails(orderNum, orderDate, totalQty, totalAmt, transactions) {
      document.getElementById("orderNum").innerHTML = orderNum;
      document.getElementById("orderDate").innerHTML = orderDate.split(" ")[0];
      document.getElementById("orderTime").innerHTML = orderDate.split(" ")[1];
      document.getElementById("totalQty").innerHTML = totalQty;
      document.getElementById("totalAmt").innerHTML = totalAmt;

      document.getElementById('orderItems').innerHTML = "";

      document.getElementById('cancelBtn').setAttribute("href", "/keopi/cancel_orders.php?NUM=" + orderNum);

      transactions.forEach((item, i) => {
        var text = '<tr><td class="align-middle"> <input type="text" name="transaction[]" value="' + item.name + '" disabled> </td><td class="align-middle"> <input type="number" name="prodQuantity[]" value="' + item.qty + '" disabled> </td></tr>';
        document.getElementById('orderItems').innerHTML += text;
      });

    }
  </script>
</body>
</html>
