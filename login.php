<?php
// Start the session to handle login
session_start();

// If user is already logged in, redirect to index.php
if (isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to home page
    exit; // Ensure no further code is executed after the redirect
}

// Include database configuration
require_once('config/database.php');

// Process login when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to get the user based on email
    $query = "SELECT * FROM user WHERE email = ? LIMIT 1"; // Use ? instead of :email
    
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind the email parameter
    $stmt->bind_param('s', $email);
    
    // Execute the statement
    $stmt->execute();

    // Check if the user exists
    $result = $stmt->get_result(); // Use get_result() to fetch data

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password matches
        if ($password === $user['password']) {
            // If login is successful, set session variables and redirect to the homepage
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama'] = $user['nama'];
            header("Location: index.php");
            exit; // Ensure no further code is executed after the redirect
        } else {
            // Password is incorrect
            $error = "Incorrect email or password.";
        }
    } else {
        // User does not exist in the database
        $error = "Email not registered.";
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
    <title>Login</title>
</head>
<body>
    <img src="asset/image/logo2.png" class="rounded mx-auto d-block mt-2" alt="Logo" style="width: 200px;">
    <div class="container d-flex justify-content-center align-items-center" style="font-family: 'Poppins', sans-serif;">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded border-2" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-3 fs-1" style="font-weight: 700; color: #03254C;">Login</h5>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <!-- Email Input -->
                    <div class="email">
                        <label for="email" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white border-2 border-dark">
                                <img src="asset/image/mail.png" alt="mail" style="width: 20px;">
                            </span>
                            <input type="email" class="form-control fw-bold border-2 border-dark" id="email" name="email" required>
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

                    <a href="#" class="text-decoration-none text-end d-block mb-2" style="font-size: 15px; font-weight: 600; color: #03254C;">Forgot password?</a>
                    <!-- Login Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn ms-5 me-5" style="background-color: #03254C; color: white; font-weight: 500; border-radius: 50rem;">Login</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mt-2" style="font-size: 12px; font-weight: 600; color: #03254C;">Don't have an account? <a href="register.php" class="text-primary">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
