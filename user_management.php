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

  <title>Keopi | User Management</title>
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



  <div class="container-fluid" style="height:100%;">
    <div class="row gx-5">
      <div class="col-sm-2 nav-col">
        <div class="profile-mini text-center">
          <img src="img/logo.png" class="rounded mx-auto d-block profile-pic title">
        </div>
        <ul class="nav flex-column nav-pills nav-justified">
          <?php 
            if($userRole == 1){ //page option will appear if user role is admin
            print  '<li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="user_management.php"><i class="bi bi-people-fill"></i>User Management</a>
                    </li>';
            }else{ // will redirect to orders page if staff
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
          if($userRole == 1){ //page option will appear if user role is admin
          print  '<li class="nav-item">
            <a class="nav-link" href="products.php"><i class="bi bi-archive-fill"></i>Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="bi bi-clipboard-data-fill"></i>Reports</a>
          </li>';
          }else{ //will redicect to orders page if staff
            header("location:add-orders.php");
          }
           ?>
          <li class="nav-item">
            <a class="nav-link logout" href="logout.php"><i class="bi bi-box-arrow-left"></i>Log Out</a>
          </li>
        </ul>
      </div>

<!-- adding user php code starts here -->
<?php 
if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
{
        if(isset($_POST['email'])) //Added an if to keep the page secured
        { 
        $email = $_POST['email'];
        $password = $_POST['password'];
        $is_admin = 0;

        
           if (isset($_POST['admin'])){
            $is_admin = 1;
         }
       


        $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error()); //Connect to server
        $get_email = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
        
        if(mysqli_num_rows($get_email)>0 ){

            $message = "User Already Exist!";

        }else {

            $message = "Added User Successfuly!";
           mysqli_query($con, "INSERT INTO users (email, password, is_admin) VALUES
          ('$email','$password','$is_admin')"); //product insert query

        }
      }
    }
      ?>


      <div class="col-sm-6 main-content">
        <div class="heading">
          <h1>USERS</h1>
        </div>
        <div class="row">
         
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-hover" id="table">
              <thead class="thead-light ">
                <th>User ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Delete</th>
              </thead>
              <!-- fetch table data from the DB -->
             <?php 
              $con = mysqli_connect("localhost", "root", "", "keopidb") or die(mysqli_error());
              $query = mysqli_query($con, "Select * from users");

              while($row = mysqli_fetch_array($query))
              {
                
                Print "<tr>";
                Print '<td class="align-middle">#' . $row['userid']. "</td>";
                Print '<td class="align-middle">' .$row['email']. "</td>";
                Print '<td class="align-middle">'; if($row['is_admin']){ print "Admin" ;}else{ print "Staff";}; print "</td>";
               Print '<td><a href="#" onclick="deleteFunction('.$row['userid'].')" class="btn btn-primary"><i class="bi bi-trash-fill"></i></a></td>';
               Print '</tr>';
              }
              ?>
              
            </table>
          </div>
        </div>
        <a href="add_user.php" class="btn btn-primary"><i class="bi bi-plus-circle-fill"> </i>Add User</a>
       
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
              <h4> User Details </h4>
            </div>
          </div>
          <div class="order-item">
            

            <div class="row">
              <table class="table">
                <thead>
                  <th></th>
                </thead>
                <tr>
                  <td class="align-middle">User ID</td>
                  <td class="align-middle"><p name="prod_num" id="prod_num"></p></td>
                </tr>
                <tr>
                  <td class="align-middle">Email</td>
                  <td class="align-middle"><p name="prod_name" id="prod_name"></p></td>
                </tr>
                <tr>
                  <td class="align-middle">Role</td>
                  <td class="align-middle"><p name="prod_price" id="prod_price"></p></td>
                </tr>
              </table>
              <div class="form-text">
               
              </div>
            </div>

            

            <div class="row d-flex justify-content-end">
              <div class="col-sm-6">
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
  function deleteFunction(userid)
  {
    var r=confirm("Are you sure you want to delete this user?");
    if (r==true)
    {
      window.location.assign("delete_user.php?userid=" + userid);
    }
  }
</script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>