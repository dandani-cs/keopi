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

    <!-- side nav -->
    <div class="container-fluid" style="height:100%;">
      <div class="row ">
        <div class="col-sm-2 nav-col">
          <div class="profile-mini text-center">
            <img src="img/logo.png" class="rounded mx-auto d-block profile-pic title">
          </div>
          <ul class="nav flex-column nav-pills nav-justified">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#"><i class="bi bi-basket-fill"></i>Transact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-bag-plus-fill"></i>Add transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class="bi bi-archive-fill"></i>Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"><i class="bi bi-clipboard-data-fill"></i>Reports</a>
            </li>

            <li class="nav-item">
              <a class="nav-link logout"><i class="bi bi-box-arrow-left"></i>Log Out</a>
            </li>
          </ul>
        </div>

        <!-- main content container -->
        <div class="col-9 main-content" style="width: 83%;">
          <div class="heading">
            <h1>ADD PRODUCTS</h1>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <form method="POST" action="products.php">
                <div class="form-group">
                  <label for=product_number>Product Number</label>
                  <input type="text" name="product_number" class="form-control" placeholder="Enter Product Number Here" required>
                  <label for="product_name">Product Name</label>
                  <input  class="form-control" type="text" name="product_name" placeholder="Enter Product Name Here" required>
                  <label for="product_price">Product Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">₱</span>
                    </div>

                    <input class="form-control" type="text" name="product_price" placeholder="Enter Product Price Here" required>
                  </div>

                  <label for="product_desc">Description</label>
                  <input type="text" name="product_desc" class="form-control" rows="5"></textarea>
                </div> 
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="bi bi-plus-circle-fill"> </i>Add Product
          </button>
          <a href="products.php" class="btn btn-primary"><i class="bi bi-x-circle-fill"></i> Cancel</a>
          
            

      <!-- <?php 
   //      if(isset($_POST['product_name'])) //Added an if to keep the page secured
   //      { 
   //      $product_num = ($_POST['product_number']);
   //      $name = ($_POST['product_name']);
   //      $price = ($_POST['product_price']);
   //      $description = ($_POST['product_desc']);
        
      
        

   //        // <!-- Modal -->
   //     Print '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
   //     Print  '<div class="modal-dialog modal-dialog-centered" role="document">';
   //     Print  '<div class="modal-content">';
   //     Print  '<div class="modal-header">';
   //      Print       '<h5 class="modal-title" id="exampleModalLongTitle">Adding' .$name. 'to Products</h5>' ;
   //      Print  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'  ;    
   //      Print   ' <span aria-hidden="true">&times;</span>'   ;   
   //      Print   '</div>';
   //      Print    '<div class="modal-body">' ; 
   //      Print     '<h3>Product Name:</h3>'  ;
   //      Print '<br>'   ;     
   //      Print  $name;      
   //      print    '<br>' ;
   //      Print    '<h3>Product Price:</h3> '  ; 
   //       print    '<br>' ;
   //      Print $price;
   //       print    '<br>' ;
   //       print      ' <h3>Product Description</h3>';
   //      print    '<br>' ;
   //       print $description;      
   //       print'     </div>
   //            <div class="modal-footer">
   //              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
   //              <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"> </i>Add</button>
   //            </div>
   //          </div>
   //        </div>
   //      </div>';

   // $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error()); //Connect to server
   //      mysqli_query($con, "INSERT INTO products (product_num, name, price, description) VALUES
   //        ('$product_num','$name','$price','$description')"); //product insert query
   //    }
?>
 -->

              </form>
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