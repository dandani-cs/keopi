<?php

$db_name = "epiz_31692043_keopidb";
$db_username = "epiz_31692043";
$db_pass = "AVcoLaXFsz";
$db_host = "sql111.epizy.com";

$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die(mysqli_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
