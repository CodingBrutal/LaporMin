<?php
// Koneksi ke database
include("config/database.php");

// Cek apakah form telah disubmit
$id_lapor = "";
$result = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_lapor = $_POST['id_lapor'];

    // Query untuk mencari laporan berdasarkan id_lapor
    $stmt = $conn->prepare("SELECT * FROM data_user WHERE id_lapor = ?");
    $stmt->bind_param("s", $id_lapor);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Cek Laporan</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="font-family: 'Poppins', sans-serif; height: 100vh;">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded border-2" style="width: 500rem;">
            <div class="card-body text-center">
                <h3 style="font-weight: 700;">Cek Laporan Anda</h3>
                <img src="asset/image/logo2.png" alt="..." style="width: 200px;">
                <form method="POST" class="mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white border-2 border-dark">
                            <img src="asset/image/loupe.png" alt="search" style="width: 20px;">
                        </span>
                        <input type="text" class="form-control border-2 border-dark" name="id_lapor" placeholder="ID Laporan..." required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>

                <?php if ($result && $result->num_rows > 0): ?>
                    <h5 class="mt-3">Hasil Pencarian:</h5>
                    <div class="table-responsive">
                        <table id="resultTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Laporan</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Lokasi</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                    <th>Gambar</th> <!-- Kolom untuk gambar -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id_lapor']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                                        <td><?php echo htmlspecialchars($row['detail_lapor']); ?></td>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td>
                                            <img src="../<?php echo htmlspecialchars($row['url_gambar']); ?>" alt="Gambar Laporan" style="width: 50px; height: auto;">
                                        </td> <!-- Preview gambar -->
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
 </div>
                <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                    <p class="text-danger">Laporan tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resultTable').DataTable({
                responsive: true // Menambahkan opsi responsif
            });
        });
    </script>
</body>
</html>