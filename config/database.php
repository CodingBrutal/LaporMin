<?php
   $host = 'localhost'; // Host database Anda
   $dbname = 'lapormin'; // Nama database Anda
   $username = 'root'; // Username database Anda
   $password = '';

   try {
       // Membuat koneksi menggunakan PDO
       $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       // Jika berhasil
       echo "Connected to the database successfully!";
   } catch (PDOException $e) {
       // Jika gagal
       die("Connection failed: " . $e->getMessage());
   }
?>
