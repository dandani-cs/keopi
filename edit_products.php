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
  </head>
  <body>
    <?php 
    session_start();
    if($_SESSION['email']){ // will check if the user is logged-in

    }else{ // will return to login page if user is not logged in
      header("location:login.html");
    }
    $userRole = $_SESSION['is_admin']; //gets user role
     ?>
    <!-- side nav -->
    <div class="container-fluid" style="height:100%;">
      <div class="row ">
        <div class="col-sm-2 nav-col">
        <div class="profile-mini text-center">
          <img src="img/logo.png" class="rounded mx-auto d-block profile-pic title">
        </div>
        <ul class="nav flex-column nav-pills nav-justified">
          <?php 
            if($userRole == 1){
            print  '<li class="nav-item">
                      <a class="nav-link" aria-current="page" href="user_management.php"><i class="bi bi-people-fill"></i>User Management</a>
                    </li>';
            }else{
              header("location:add-orders.php");
            }
           ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="bi bi-basket-fill"></i>Transact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-bag-plus-fill"></i>Add transaction</a>
          </li>
          <?php 
          if($userRole == 1){
          print  '<li class="nav-item">
            <a class="nav-link active" href="products.php"><i class="bi bi-archive-fill"></i>Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="bi bi-clipboard-data-fill"></i>Reports</a>
          </li>';
          }else{
            header("location:add-orders.php");
          }
           ?>
          <li class="nav-item">
            <a class="nav-link logout" href="logout.php"><i class="bi bi-box-arrow-left"></i>Log Out</a>
          </li>
        </ul>
      </div>

        <!-- main content container -->
        <div class="col-9 main-content" style="width: 83%;">
          <div class="heading">
            <h1>EDIT PRODUCT</h1>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <?php 
              if(!empty($_GET['id']))
              {
                $id = $_GET['id'];
                $_SESSION['id'] = $id;
                $id_exists = true;
                $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error());
                $query = mysqli_query($con, "SELECT * FROM products WHERE product_num='
                  $id'");
                $count = mysqli_num_rows($query);
                if($count > 0)
                {
                  while($row = mysqli_fetch_array($query)){
                    if($id_exists)
                    {
                     print  '<form method="POST" action="edit_products.php">';
                     print '<div class="form-group">';
                     print'<label for=product_number>Product Number</label>';
                     print  '<h4 style="margin-left:10px;">#'.$row['product_num'].'</h4>';
                     print     '<label for="product_name">Product Name</label>';
                     print  '<input  class="form-control" type="text" name="product_name" placeholder="Enter Product Name Here" value="' .$row['name'].'" required>';
                     print  '<label for="product_price">Product Price</label>';
                     print   '<div class="input-group">';
                     print    '<div class="input-group-prepend">
                     <span class="input-group-text">₱</span>
                     </div>';

                     print '<input class="form-control" type="text" name="product_price" placeholder="Enter Product Price Here" value="'.$row['price'] .'"
                     required>';
                     print   '</div>

                     <label for="product_desc">Description</label>
                     <input type="text" name="product_desc" class="form-control" rows="5" value="'.$row['description'].'">
                     </div> 
                     <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="bi bi-plus-circle-fill"> </i>Edit Product
                     </button>
                    <a href="products.php" class="btn btn-primary"><i class="bi bi-x-circle-fill"></i> Cancel</a>
                     </form>';
                   }else
                   {
                    Print '<h2 align="center">There is no data to be edited.</h2>';
                  }
                }
              }
            }

            ?> 
              </div>
            </div>

          </div>
        </div>
      </div>

      <script type="text/javascript">
      </script>

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    </body>
    </html>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
   {
    $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error()); //Connect to server
    $id = $_SESSION['id'];
    $prod_name = ($_POST['product_name']);
    $prod_price = ($_POST['product_price']);
    $prod_desc = ($_POST['product_desc']);


    mysqli_query($con, "UPDATE products SET name='$prod_name', price='$prod_price',
      description='$prod_desc' WHERE product_num='$id'") ;
    header("location: products.php");
  }
?>
    
