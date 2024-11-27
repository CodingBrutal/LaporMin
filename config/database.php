<?php
   $host = 'localhost'; // Host database Anda
   $dbname = 'lapormin'; // Nama database Anda
   $username = 'root'; // Username database Anda
   $password = 'internet';
   $conn = new mysqli($host, $username, $password, $dbname);
   
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
