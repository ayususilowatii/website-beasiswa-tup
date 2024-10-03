<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa Akademik</title>
    <link rel="stylesheet" href="../asset/css/artikel.css?v=1.1">
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="telyu">
                <img src="../asset/img/telyu.png" alt="Logo Kampus Telkom University" height="60">
                <span class="span-text">Pendaftaran Beasiswa</span>
            </div>
            <ul>
                <li><a href="dashboard.php">Kategori Beasiswa</a></li>
                <li><a href="pendaftaran.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../function/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <h1>Beasiswa Akademik</h1>
    </header>

<!-- Main Content -->
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="image-container">
                    <img src="../asset/img/akademik.jpeg" alt="Gambar Beasiswa Akademik" style="width:100%; max-width:600px;">
                </div>
            </div>

            <div class="col-md-6">
                <h2>Syarat dan Ketentuan</h2>
                <p><strong>Syarat:</strong> IPK minimal 3.0 dan Menjuarai perlombaan bidang Akademik tingkat Nasional.</p>
                <p><strong>Dokumen yang Diperlukan:</strong></p>
                <ul>
                    <li>Kartu Tanda Mahasiswa (KTM)</li>
                    <li>Transkrip nilai terakhir</li>
                    <li>Surat pernyataan tidak menerima beasiswa lain</li>
                    <li>Pas foto ukuran 4x6</li>
                </ul>
                <h2>Benefit</h2>
                <ul>
                    <li>Biaya pendidikan UKT</li>
                    <li>Biaya hidup Rp500.000 per-bulan</li>
                </ul>

                <!-- Bagian Informasi Kontak -->
                <h2>Informasi Kontak</h2>
                <p>Jika ada pertanyaan lebih lanjut, silakan hubungi kami di <strong>admin@telkomuniversity.ac.id</strong>.</p>
            </div>
        </div>

        <!-- Bagian Bawah untuk Penjelasan Beasiswa dan Grafik -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Penjelasan Singkat Penerima Beasiswa</h1>
                <p>Beasiswa ini diberikan kepada mahasiswa berprestasi baik di bidang akademik maupun non-akademik. Setiap pendaftar harus memenuhi syarat-syarat yang telah ditetapkan, dan seleksi dilakukan secara ketat.</p>
                <p>Penerima beasiswa akan mendapatkan bantuan biaya pendidikan untuk satu semester, dengan peluang untuk memperpanjang beasiswa di semester berikutnya jika syarat prestasi terus terpenuhi.</p>
            </div>
            <div class="col-md-6">
                <h3>History Pendaftar Beasiswa</h3>
                <canvas id="scholarshipChart"></canvas> <!-- Placeholder for Bar Chart -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('scholarshipChart').getContext('2d');
        const scholarshipChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023'], // Contoh tahun
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: [50, 75, 100, 125], //Contoh data
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</main>


</body>
</html>
