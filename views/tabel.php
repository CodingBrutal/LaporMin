<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Admin</title>
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>List Laporan</h2>
            <!-- Form Pencarian -->
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Cari data..." id="searchInput">
                <button class="btn btn-primary" onclick="searchTable()">Cari</button>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Fasilitas</th>
                    <th>Detail</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Baris dengan data -->
                <tr>
                    <td>1</td>
                    <td>Fufufafa</td>
                    <td>Ruang M12</td>
                    <td>Kipas</td>
                    <td>Kipas senglek</td>
                    <td>
                        <button class="btn btn-success" onclick="toggleStatus(this)">Selesai</button>
                    </td>
                    <td>2024-11-23</td>
                    <td><img src="img/kipas.jpeg" alt="Gambar" class="img-thumbnail"></td>
                </tr>
                <!-- 4 Baris kosong -->
                <tr>
                    <td>2</td>
                    <td>ganjar</td>
                    <td>gazebo</td>
                    <td>stop kontak</td>
                    <td>stop kontak konslet</td>
                    <td>
                        <button class="btn btn-secondary" onclick="toggleStatus(this)">Proses</button>
                    </td>
                    <td>2024-11-23</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-secondary" disabled>Belum Ada Data</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-secondary" disabled>Belum Ada Data</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-secondary" disabled>Belum Ada Data</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-secondary" disabled>Belum Ada Data</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary" id="prevButton" onclick="changePage(-1)" disabled>Previous</button>
            <button class="btn btn-secondary" id="nextButton" onclick="changePage(1)">Next</button>
        </div>
        
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk pencarian sederhana
        function searchTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let rowContainsText = false;

                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().includes(input)) {
                        rowContainsText = true;
                        break;
                    }
                }

                rows[i].style.display = rowContainsText ? "" : "none";
            }
        }

        // Fungsi untuk toggle status antara "Selesai" dan "Proses"
        function toggleStatus(button) {
            if (button.innerText === "Selesai") {
                button.innerText = "Proses";
                button.classList.remove("btn-success");
                button.classList.add("btn-danger");
            } else if (button.innerText === "Proses") {
                button.innerText = "Selesai";
                button.classList.remove("btn-danger");
                button.classList.add("btn-success");
            }
        }

     const rowsPerPage = 5; // Jumlah baris per halaman
     let currentPage = 1;
 
// Fungsi untuk menampilkan baris sesuai halaman
    function displayPage(page) {
    const tableBody = document.getElementById("tableBody");
    const rows = Array.from(tableBody.getElementsByTagName("tr"));
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    
    // Sembunyikan semua baris
    rows.forEach(row => (row.style.display = "none"));

    // Tampilkan baris sesuai halaman
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    for (let i = start; i < end && i < rows.length; i++) {
        rows[i].style.display = "";
    }

    // Atur tombol pagination
    document.getElementById("prevButton").disabled = page === 1;
    document.getElementById("nextButton").disabled = page === totalPages;
}

    // Fungsi untuk mengganti halaman
    function changePage(direction) {
        currentPage += direction;
        displayPage(currentPage);
    }

    // Inisialisasi tampilan awal
    displayPage(currentPage);

    </script>
</body>
</html>
