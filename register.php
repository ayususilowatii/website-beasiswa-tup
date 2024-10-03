<?php
session_start();

// Koneksi ke database
include 'database/connection.php';

$registration_success = false; // Flag untuk memeriksa status registrasi
$error = ""; // Inisialisasi variabel error

// Jika form register disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password sebelum disimpan

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika email sudah ada, set variabel error
        $error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Insert data ke database beserta role
        $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $password);
        if ($stmt->execute()) {
            // Registrasi berhasil, set flag untuk menampilkan pesan berhasil
            $registration_success = true;
        } else {
            $error = "Registrasi gagal. Silakan coba lagi.";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="asset/css/style.css">
    
    <script>
        // Fungsi untuk menampilkan pop-up
        function showErrorPopup(message) {
            alert(message); // Tampilkan pesan error dalam alert
        }

        function showSuccessPopup() {
            alert("Registrasi berhasil! Anda akan dialihkan ke halaman login.");
            // Setelah alert, redirect ke halaman login setelah 1 detik
            setTimeout(function() {
                window.location.href = "login.php";
            }, 1000); // Redirect setelah 1 detik
        }
    </script>
</head>
<body>

    <!-- Navigasi -->
    <nav>
        <div class="container">
            <div class="logo-text">
                <img src="asset/img/telyu.png" alt="Logo Kampus" height="50"> <!-- Logo Kampus -->
                <span class="navbar-text">Platform Beasiswa Telkom University</span>
            </div>
        </div>
    </nav>
    
    <h2>Registrasi Akun Pendaftaran Beasiswa</h2>

    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Register</button>
    </form>

    <div class="menu">
        <p>Sudah punya akun? <a href="login.php">Login</a> untuk masuk.</p>
    </div>

    <!-- Jika terdapat error, tampilkan pop-up error -->
    <?php if (!empty($error)): ?>
        <script>
            showErrorPopup("<?= $error ?>"); // Tampilkan error di alert
        </script>
    <?php endif; ?>

    <!-- Jika registrasi berhasil, jalankan JavaScript untuk menampilkan pop-up dan redirect -->
    <?php if ($registration_success): ?>
        <script>
            showSuccessPopup(); // Panggil fungsi untuk pop-up sukses
        </script>
    <?php endif; ?>
</body>
</html>
