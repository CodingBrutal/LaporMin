<?php
// Start the session at the top
session_start();

// If the user clicks the logout button
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to login page
    exit;
}

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Simple routing and input sanitization
$page = isset($_GET['page']) ? basename($_GET['page']) : 'home'; // Avoid potential LFI

// Function to load views
function loadView($page) {
    $viewFile = __DIR__ . "/views/$page.php";
    
    // Check if the view file exists
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        // If file does not exist, show 404
        echo "<h2>404 Not Found</h2><p>Sorry, the page you are looking for does not exist.</p>";
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
    <title><?= ucfirst($page) ?> | Website</title>
    <style>
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=home">Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=cek-lapor">Cek Lapor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="?logout=true">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
    <div class="container">
        <?php
        // Load the view based on the page
        loadView($page);
        ?>
        <!-- Logout Button with User Name -->
        <a href="?logout=true" class="btn btn-danger logout-btn">
            Logout <?php echo $_SESSION["nama"]; ?>
        </a> 
    </div>
</body>
</html>
