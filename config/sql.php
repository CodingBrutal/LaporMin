<?php
// Konfigurasi database
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "lapormin"; 

try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Koneksi berhasil!";
}
catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
