<?php
// Start session and include database configuration
session_start();
require_once('config/database.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    
    // Check if the email already exists
    $query = "SELECT * FROM user WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        // If the email is unique, insert the new user into the database
        $query = "INSERT INTO user (email, nama, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $email, $nama, $password); // Store the plain password for now (ideally, you should hash it)
        if ($stmt->execute()) {
            // Registration success, redirect to login page
            header("Location: login.php");
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <img src="asset/image/logo2.png" class="rounded mx-auto d-block mt-2" alt="Logo" style="width: 200px;">
    <div class="container d-flex justify-content-center align-items-center" style="font-family: 'Poppins', sans-serif;">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded border-2" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-3 fs-1" style="font-weight: 700; color: #03254C;">Register</h5>

                <!-- Display error message if there's any -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="register.php" method="POST">
                    <!-- Email Input -->
                    <div class="mail">
                        <label for="email" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-2 border-dark">
                                <img src="asset/image/mail.png" alt="mail" style="width: 20px;">
                            </span>
                            <input type="email" class="form-control fw-bold border-2 border-dark" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <!-- Name Input -->
                    <div class="nama">
                        <label for="nama" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Name</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-2 border-dark">
                                <img src="asset/image/user.png" alt="user icon" style="width: 20px;">
                            </span>
                            <input type="text" class="form-control fw-bold border-2 border-dark" id="nama" name="nama" required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="password">
                        <label for="password" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-2 border-dark">
                                <img src="asset/image/lock.png" alt="password icon" style="width: 20px;">
                            </span>
                            <input type="password" class="form-control fw-bold border-2 border-dark" id="password" name="password" required>
                        </div>
                    </div>

                    <!-- Register Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn ms-5 me-5" style="background-color: #03254C; color: white; font-weight: 500; border-radius: 50rem;">Register</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mt-2" style="font-size: 12px; font-weight: 600; color: #03254C;">Already have an account? <a href="login.php">Login now</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
