<?php
include '../database/connection.php';

// Fetch all applications from the database
$query = "SELECT * FROM daftar"; // Adjust this query if you need to filter by user
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/pendaftaran.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="telyu">
                <img src="..\asset\img\telyu.png" alt="Logo Kampus" height="60">
                <span class="span1-text">Hasil Pendaftaran Beasiswa</span>
            </div>
            <ul>
                <li><a href="dashboard.php">Kategori Beasiswa</a></li>
                <li><a href="pendaftaran.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../function/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Results Section -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Daftar Pendaftaran Beasiswa</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>NIM Mahasiswa</th>
                    <th>Semester</th>
                    <th>IPK Terakhir</th>
                    <th>Pilihan Beasiswa</th>
                    <th>Berkas Syarat</th>
                    <th>Status Ajuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results and display them
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { //Perulangan
                        echo "<tr>
                                <td>" . htmlspecialchars($row['nama']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['no_hp']) . "</td>
                                <td>" . htmlspecialchars($row['nim_mhs']) . "</td>
                                <td>" . htmlspecialchars($row['semester']) . "</td>
                                <td>" . htmlspecialchars($row['last_ipk']) . "</td>
                                <td>" . htmlspecialchars($row['beasiswa']) . "</td>                        
                                <td><a href='/website-beasiswa-tup/uploads/" . htmlspecialchars($row['syarat_berkas']) . "' target='_blank'>Lihat Berkas</a></td>
                                <td>";

                        // Check status ajuan 
                        echo ($row["status_ajuan"] == '1') ? "Sudah terverifikasi" : "Belum diverifikasi";

                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Belum ada pendaftaran</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
