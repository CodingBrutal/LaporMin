<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Menu</title>
</head>
<body>
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh; font-family: Poppins;">
        <h5 style="font-weight: 700;">Tap logo untuk lapor!</h5>
        <a href="index.php?page=formlapor" class="btn p-0" style="background: none; border: none;">
            <img src="asset/image/logo2.png" alt="logo" style="width: 200px;">
        </a>
        <div class="d-flex flex-column" style="width: 250px;">
            <!-- Redirect to ceklapor page -->
            <a href="index.php?page=ceklapor" class="btn mb-1" style="background-color: #03254C; color: white; font-weight: 500; border-radius: 6px; text-decoration: none; text-align: center;">Cek Laporan</a>
            <!-- Redirect to status page -->
            <a href="index.php?page=status" class="btn" style="background-color: #03254C; color: white; font-weight: 500; border-radius: 6px; text-decoration: none; text-align: center;">Status Laporan</a>
        </div>
    </div>

</body>
</html>
