<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa Non-Akademik</title>
    <link rel="stylesheet" href="../asset/css/artikel.css?v=1.1">
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="telyu">
                <img src="..\asset\img\telyu.png" alt="Logo Kampus" height="60">
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
    
    <header>
        <h1>Beasiswa Non-Akademik</h1>
    </header>
    
    <main>
    <div class="content">
        <div class="flex-container"> 
            <div class="image-container1">
                <img src="../asset/img/non-akademik.jpeg" alt="Beasiswa Non-Akademik" style="width:100%; max-width:400px;">
            </div>

            <div class="article1">
                <h2>Syarat dan Ketentuan</h2>
                <p><strong>Syarat:</strong> IPK minimal 3.0, Menjuarai perlombaan bidang Non-Akademik minimal tingkat Nasional.</p>
                <p><strong>Dokumen yang Diperlukan:</strong></p>
                <ul>
                    <li>KTM (Kartu Tanda Mahasiswa)</li>
                    <li>Transkrip nilai terakhir</li>
                    <li>Sertifikat kejuaraan</li>
                    <li>Pas foto ukuran 4x6</li>
                </ul>
                <h2>Benefit</h2>
                <ul>
                    <li>Biaya pendidikan UKT</li>
                    <li>Biaya hidup Rp400.000 per-bulan</li>
                </ul>
                <section>
                    <h2>Informasi Kontak</h2>
                    <p>Jika ada pertanyaan lebih lanjut, silakan hubungi kami di <strong>admin@telkomuniversity.ac.id</strong>.</p>
                </section>
            </div>
        </div>

        <section class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Penjelasan Singkat Penerima Beasiswa</h1>
                    <p>Beasiswa ini diberikan kepada mahasiswa berprestasi dalam bidang non-akademik, seperti olahraga, seni, dan kreativitas lainnya. Setiap pendaftar harus memenuhi syarat-syarat yang telah ditetapkan dan melalui seleksi ketat.</p>
                    <p>Penerima beasiswa akan mendapatkan bantuan biaya pendidikan dan biaya hidup untuk satu semester. Beasiswa dapat diperpanjang jika penerima terus memenuhi persyaratan prestasi.</p>
                </div>
                <div class="col-md-6">
                    <h3>History Pendaftar Beasiswa Non-Akademik</h3>
                    <canvas id="nonAcademicChart"></canvas> <!-- Placeholder for Bar Chart -->
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctxNonAcademic = document.getElementById('nonAcademicChart').getContext('2d');
            const nonAcademicChart = new Chart(ctxNonAcademic, {
                type: 'bar',
                data: {
                    labels: ['2020', '2021', '2022', '2023'],
                    datasets: [{
                        label: 'Jumlah Pendaftar Non-Akademik',
                        data: [40, 65, 85, 105], 
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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
    </div>
</main>

</body>
</html>
