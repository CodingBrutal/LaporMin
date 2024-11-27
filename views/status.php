<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Laporan</title>
    <style>
        #imagePreview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="font-family: 'Poppins', sans-serif;">
        <div class="card shadow-lg p-3 mt-5 mb-5 bg-body-tertiary rounded border-2" style="width: 50rem;">
            <div class="card-body text-center">
                <h5 class="card-title text-center mb-3 fs-1" style="font-weight: 700; color: #03254C;">Isi untuk Lapor!</h5>
                <form id="laporanForm" enctype="multipart/form-data">
                    <div class="text-start">
                        <label for="nama" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Nama Lengkap</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control border-2 border-dark" id="nama" name="nama" required>
                        </div>
                    </div>

                    <div class="text-start">
                        <label for="email" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control border-2 border-dark" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="text-start">
                        <label for="lokasi" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Lokasi</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control border-2 border-dark" id="lokasi" name="lokasi" required>
                        </div>
                    </div>

                    <div class="text-start">
                        <label for="jenisFasilitas" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Jenis Fasilitas</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control border-2 border-dark" id="jenisFasilitas" name="jenisFasilitas" required>
                        </div>
                    </div>

                    <div class="text-start">
                        <label for="detailLaporan" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Detail Laporan</label>
                        <textarea class="form-control border-dark border-2" id="detailLaporan" name="detailLaporan" rows="3" required></textarea>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="image" class="form-label mb-0" style="font-size: 12px; font-weight: 600;">Upload gambar:</label>
                        <input class="form-control border-dark border-2" type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
                        <img id="imagePreview" src="#" alt="Preview Gambar">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn ms-5 me-5" style="background-color: #03254C; color: white; font-weight: 500; border-radius: 7px;">Kirim</button>
                    </ form>
            </div>
        </div>
    </div>

    <!-- Modal untuk notifikasi dengan card -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded border-2" style="width: 30rem;">
                        <div class="card-body text-center">
                            <h3 style="font-weight: 700;">Status laporan anda</h3>
                            <img src="asset/image/logo2.png" alt="..." style="width: 200px;">
                            <h5 id="responseId" style="font-weight: 900; padding-right: 1rem;">Selesai</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk menampilkan preview gambar
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        }

        // Menangani pengiriman formulir
        document.getElementById('laporanForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: 'http://43.218.129.220/send_message.php', // Pastikan URL ini sesuai dengan endpoint yang Anda inginkan
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Memeriksa apakah pengiriman berhasil
                    if (response.success) {
                        document.getElementById('responseId').textContent = 'Selesai'; // Ganti dengan status yang sesuai
                        $('#responseModal').modal('show'); // Tampilkan modal notifikasi
                    } else {
                        document.getElementById('responseId').textContent = 'Terjadi kesalahan saat mengirim laporan.';
                        $('#responseModal').modal('show'); // Tampilkan modal notifikasi
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error: " + textStatus, errorThrown);
                    document.getElementById('responseId').textContent = 'Terjadi kesalahan saat mengirim laporan.';
                    $('#responseModal').modal('show'); // Tampilkan modal notifikasi
                }
            });
        });
    </script>
</body>
</html>