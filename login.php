<?php
// Menghubungkan ke database
include 'config/database.php';

// Memulai sesi
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input tidak kosong
    if (!empty($email) && !empty($password)) {
        try {
            // Query untuk mencari pengguna berdasarkan email
            $stmt = $conn->prepare("SELECT password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Jika email ditemukan
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verifikasi password dengan hash
                if (password_verify($password, $user['password'])) {
                    // Simpan sesi jika login berhasil
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];

                    // Redirect ke halaman dashboard atau halaman lain setelah login
                    header('Location: dashboard.php');
                    exit();
                } else {
                    echo "<script>alert('Password salah!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Email tidak terdaftar!'); window.history.back();</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
    }
}
?>
