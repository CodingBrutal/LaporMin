<?php
// Menghubungkan ke database
include 'config/database.php';

// Memulai sesi
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input tidak kosong
    if (!empty($nama) && !empty($email) && !empty($password)) {
        try {
            // Periksa apakah email sudah terdaftar
            $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Email sudah terdaftar!'); window.history.back();</script>";
            } else {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Query untuk menambahkan pengguna baru
                $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (:nama, :email, :password)");
                $stmt->bindParam(':nama', $nama);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);

                if ($stmt->execute()) {
                    echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
                } else {
                    echo "<script>alert('Registrasi gagal!'); window.history.back();</script>";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
    }
}
?>
