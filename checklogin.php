<?php
session_start();
$email = ($_POST['email']);
$password = ($_POST['password']);
$db_name = "epiz_31692043_keopidb";
$db_username = "epiz_31692043";
$db_pass = "AVcoLaXFsz";
$db_host = "sql111.epizy.com";
$con = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die(mysqli_error()); //Connect to server
$query = "SELECT * FROM users WHERE email='$email'";
$results = mysqli_query($con, $query); //Query the users table if there are matching rows equal to $username
$exists = mysqli_num_rows($results); //Checks if username exists
$table_users = "";
$table_password = "";
$role = 0;
if($results != "") //IF there are no returning rows or no existing username
{
	Print '<script>alert("username fetched!");</script>';
	while($row = mysqli_fetch_assoc($results)) //display all rows from query
	{
		$table_users = $row['email']; // the first username row is passed on to $table_users, and so on until the query is finished
		$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
		$role = $row['is_admin'];
	}
	if(($email == $table_users) || ($password == $table_password)) // checks if there are any matching fields
	{
		if($password == $table_password)
		{
			$_SESSION['email'] = $email;
			$_SESSION['is_admin'] = $role; //set the username in a session. This serves as a global variable
			header("location: products.php"); // redirects the user to the authenticated home page
		}
	}
	else
	{
		Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
		Print '<script>window.location.assign("login.html");</script>'; // redirects to login.php
	}
}
else
{
	Print '<script>alert("Incorrect Username!");</script>'; //Prompts the user
	Print '<script>window.location.assign("login.html");</script>'; // redirects to login.php
}
?>
