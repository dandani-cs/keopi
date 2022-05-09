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
</head>
<body>
  <?php
   session_start();
    if($_SESSION['email']){ // will check if the user is logged-in

    }else{ // will return to login page if user is not logged in
      header("location:login.html");
    }
    $userRole = $_SESSION['is_admin']; //gets user role
     

  $db_name = "keopidb";
  $db_username = "root";
  $db_pass = "";
  $db_host = "localhost";
  $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

   ?>

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
                 <a class="side-nav-item" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="add-orders.php">
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
                   <a class="side-nav-item" href="orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Orders</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="add-orders.php">
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
          <h1>ADD ORDER</h1>
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
                <th>Prod Number</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
              </thead>

              <?php
              $query = "SELECT * FROM products ORDER BY name DESC";
              $results = mysqli_query($con, $query);

              while ($row = mysqli_fetch_array($results)) {
                Print '<tr>
                  <td class="align-middle">#'. $row["product_num"] .'</td>
                  <td class="align-middle">' . $row['name'] . '</td>
                  <td class="align-middle">Php. ' . $row['price'] . '</td>
                  <td class="align-middle"> <button type="button" name="button" onclick="orderName(' . $row["product_num"] . ', \''. $row["name"] .'\', '. $row["price"] . ')" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></button> </td>
                </tr>';
              }
               ?>
            </table>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adding <span id="selectedProd"></span> to order</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-text">
                  Enter quantity for item
                </div>
                <input type="number" id="itemQty" class="form-control" aria-describedby="passwordHelpBlock">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addTransaction()">Add</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-sm-6">
            <div class="img-links">
              <img src="classes-img.png" alt="">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-12">
                <img src="grades-img.png" alt="">
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-sm-12">
                <img src="repo-img.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4 side-content">
        <div class="order-details-tab">
          <div class="row">
            <div class="col-sm-12">
              <h4> CONFIRM ORDER </h4>
            </div>
          </div>
          <form action="add-orders-post.php" method="post" id="post">
            <div class="order-item">
            <div class="row">
              <div class="col-sm-auto order-details-lbl align-middle">
                <label for="customerName" class="form-label align-middle">Customer Name</label>
              </div>
              <div class="col-sm-auto">
                <input type="text" class="form-control" name="customerName" id="customerName">
              </div>
            </div>

            <div class="row">

              <table class="table">
                <thead>
                  <th>Orders</th>
                </thead>
                <tbody id="orderItems">
                  <!-- <tr>
                    <input type="hidden" name="productNum[]" value=""><td class="align-middle"> <input type="text" name="transaction[]" value="' + item.prodName + '" disabled> </td>
                    <td class="align-middle"> <input type="number" name="prodQuantity[]" value="' + item.prodQty + '" disabled> </td>
                    <td> <button type="button" name="button" class="btn btn-primary" onclick="removeTransaction(' + i + ')"><i class="bi bi-x-circle-fill"></i></button> </td>
                  </tr> -->
                </tbody>

              </table>
              <div class="form-text">
                Special instructions:
              </div>
              <textarea name="instructions" rows="3" class="form-control" rows="3" id="specialInstructions"></textarea>
            </div>

            <div class="summary">
              <div class="row d-flex justify-content-end">
                <div class="col-sm-4">
                  <p> TOTAL QUANTITY </p>
                </div>
                <div class="col-sm-4">
                  <h5> <span>  <input type="text" id="totalQty" name="totalQty" value="0"> </span> </h5>
                </div>
              </div>
              <div class="row d-flex justify-content-end">
                <div class="col-sm-3">
                  <p> TOTAL PRICE </p>
                </div>
                <div class="col-sm-4">
                  <h5>Php <span> <input type="text" name="totalPrice" id="totalPrice" value="0"> </span> </h5>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-end">
              <div class="col-sm-6">
                <a href="#"><button type="submit" name="button" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> CONFIRM ORDER</button></a>

              </div>
            </div>

          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var prodNum_temp, prodName_temp, prodPrice_temp;
    var transactions = [];
    var total_price = 0;
    var total_qty = 0;


    class Transaction {
      constructor(prodNum, prodName, prodQty, prodPrice) {
        this.prodNum = prodNum;
        this.prodName = prodName;
        this.prodQty = prodQty;
        this.prodPrice = prodPrice;
        this.prodTotal = prodPrice * prodQty;
      }
    }

    function orderName(prodNum, prodName, prodPrice) {
      document.getElementById('selectedProd').innerHTML = prodName;
      prodNum_temp = prodNum;
      prodName_temp = prodName;
      prodPrice_temp = prodPrice;
    }

    function addTransaction() {
      var qty = document.getElementById('itemQty').value;
      total_qty += parseInt(qty);
      var transaction = new Transaction(prodNum_temp, prodName_temp, qty, prodPrice_temp);
      transactions.push(transaction);
      total_price += transaction.prodTotal;


      var text = `<tr>
        <input type="hidden" form="post" name="productNum[]" value="` + transaction.prodNum + `" />
        <td class="align-middle"> <input type="text" form="post" name="transaction[]" value="` + transaction.prodName + `" readonly /> </td>
        <td class="align-middle"> <input type="number" form="post" name="prodQuantity[]" value="` + transaction.prodQty + `" readonly /> </td>
        <td>
          <button type="button" name="button" class="btn btn-primary" onclick="removeTransaction(` + (transactions.length - 1) + `)">
          <i class="bi bi-x-circle-fill"></i></button>
        </td>
      </tr>`;
      document.getElementById('orderItems').innerHTML += text;
      updateSummary();
    }

    function removeTransaction(ind) {
      var deleted = transactions.splice(ind, 1);
      total_price = 0;
      total_qty = 0;
      document.getElementById('orderItems').innerHTML = "";
      transactions.forEach((item, i) => {
        var text = '<tr><input type="hidden" name="productNum[]" value="' + item.prodNum + '"><td class="align-middle"> <input type="text" name="transaction[]" value="' + item.prodName + '" disabled> </td><td class="align-middle"> <input type="number" name="prodQuantity[]" value="' + item.prodQty + '" disabled> </td> <td> <button type="button" name="button" class="btn btn-primary" onclick="removeTransaction(' + i + ')"><i class="bi bi-x-circle-fill"></i></button> </td> </tr>';
        document.getElementById('orderItems').innerHTML += text;
        total_price += item.prodTotal;
        total_qty += parseInt(item.prodQty);
      });
      updateSummary();
    }

    function updateSummary() {
      document.getElementById("totalQty").value = total_qty;
      document.getElementById("totalPrice").value = total_price;
    }

  </script>

  <?php
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

    } // if POST end


   ?>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
