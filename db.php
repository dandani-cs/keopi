<?php

$conn = new mysqli('localhost', 'root', '', 'keopi_menu');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>