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
  <title>Keopi | Products</title>
</head>
<body>


<?php 
session_start();
if($_SESSION['email']){//will check if the user is logged-in

}else{ // will return to login page if user not logged-in
  header("location:login.html");
}
$userRole = $_SESSION['is_admin']; //gets user role
 ?>

 <!-- navbar -->
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
                <a class="side-nav-item " href="add-orders.php">
                    <div class="px-3 py-3">
                        <p class="my-0">Add Order</p>
                    </div>
                </a>
                <a class="side-nav-item side-nav-selected" href="products.php">
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
                  header('location:add-orders.php');
                }
           ?>

               
                
            </div>
        </div>
      </div>

    <!-- php code for adding products starts here -->
<?php   
        if(isset($_POST['product_name'])) //Added an if to keep the page secured
        { 
        $product_num = ($_POST['product_number']);
        $name = ($_POST['product_name']);
        $price = ($_POST['product_price']);
        $description = ($_POST['product_desc']);
        $db_name = "epiz_31692043_keopidb";
        $db_username = "epiz_31692043";
        $db_pass = "AVcoLaXFsz";
        $db_host = "sql111.epizy.com";
        $con = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die(mysqli_error()); //Connect to server
        $get_productNum = mysqli_query($con,"SELECT * FROM products WHERE product_num='$product_num'");
        $get_productName = mysqli_query($con,"SELECT * FROM products WHERE name='$name'");

        if(mysqli_num_rows($get_productNum)>0 ||mysqli_num_rows($get_productName)>0){

            $message = "Item Already Exist!";

        }else {

            $message = "Added Items Successfuly!";
           mysqli_query($con, "INSERT INTO products (product_num, name, price, description) VALUES
          ('$product_num','$name','$price','$description')"); //product insert query

        }
      }
      ?>

      <!-- main page container -->
      <div class="col-sm-6 main-content">
        <div class="heading">
          <h1>PRODUCTS</h1>
        </div>
        <div class="row">
         
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-hover" id="table">
              <thead class="thead-light ">
                <th>Product Number</th>
                <th>Name</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
              </thead>

              <!-- table data from DB -->
              <?php 
              $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error());
              $query = mysqli_query($con, "SELECT * FROM products");

              while($row = mysqli_fetch_array($query))
              {
                Print "<tr>";
                Print '<td class="align-middle">#' . $row['product_num']. "</td>";
                Print '<td class="align-middle">' .$row['name']. "</td>";
                Print '<td class="align-middle">???' .$row['price']. "</td>";
                Print '<td style="display:none;">'.$row['description']. "</td>";
                Print '<td class="align-middle"> <a href="edit_products.php?id='.$row['product_num'].'" name="button" class="btn btn-primary"><i class="bi bi-pen-fill"></i></a> </td>';
               Print '<td><a href="#" onclick="deleteFunction('.$row['product_num'].')" class="btn btn-primary"><i class="bi bi-trash-fill"></i></a></td>';
               Print '</tr>';
              }
              ?>
              
            </table>
          </div>
        </div>
        <a href="add_products.php" class="btn btn-primary"><i class="bi bi-plus-circle-fill"> </i>Add Product</a>
       
        <div class="row mt-5">
          <div class="col-sm-6">
            <div class="img-links">
             
            </div>
          </div>

          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-12">
              
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-sm-12">
               
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4 side-content">
        <div class="order-details-tab">
          <div class="row">
            <div class="col-sm-12">
              <h4> Product Details </h4>
            </div>
          </div>
          <div class="order-item">
            

            <div class="row">
              <table class="table">
                <thead>
                  <th></th>
                </thead>
                <tr>
                  <td class="align-middle">Product Number</td>
                  <td class="align-middle"><p name="prod_num" id="prod_num"></p></td>
                </tr>
                <tr>
                  <td class="align-middle">Product Name</td>
                  <td class="align-middle"><p name="prod_name" id="prod_name"></p></td>
                </tr>
                <tr>
                  <td class="align-middle">Product Price</td>
                  <td class="align-middle"><p name="prod_price" id="prod_price"></p></td>
                </tr>
              </table>
              <div class="form-text">
                Product Descripion:
              </div>
              <p  id="prod_desc"></p>
            </div>

            

            <div class="row d-flex justify-content-end">
              <div class="col-sm-6">
                <!-- <a href="edit_products.php?id='<?php $productnum_Holder ?>'"><button type="button" name="button" class="btn btn-primary"><i class="bi bi-pen-fill"></i> Edit Product</button></a>  -->
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <script>
     var table = document.getElementById('table'),rIndex;

     for (var i = 0; i< table.rows.length; i++)
     {
       table.rows[i].onclick = function()
       {
        rIndex = this.rowIndex;
        document.getElementById("prod_num").innerHTML = this.cells[0].innerHTML;
        document.getElementById("prod_name").innerHTML = this.cells[1].innerHTML;
        document.getElementById("prod_price").innerHTML = this.cells[2].innerHTML;
        document.getElementById("prod_desc").innerHTML = this.cells[3].innerHTML;
       };

     }

  function deleteFunction(id)
  {
    var r=confirm("Are you sure you want to delete this product?");
    if (r==true)
    {
      window.location.assign("delete_products.php?id=" + id);
    }
  }
</script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>