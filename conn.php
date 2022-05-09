<?php

$conn = new mysqli('localhost', 'root', '', 'Keopi_Menu');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>