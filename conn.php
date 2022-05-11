<?php

$db_name = "epiz_31692043_keopidb";
$db_username = "epiz_31692043";
$db_pass = "AVcoLaXFsz";
$db_host = "sql111.epizy.com";
$conn = new mysqli("$db_host","$db_username","$db_pass", "$db_name");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>