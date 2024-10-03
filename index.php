<?php
session_start();

# File: index.php
# Author: Ayu Susilowati
# Date: October 3, 2024

// Koneksi ke database
include 'database/connection.php';

// Jika form register disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password sebelum disimpan

    // Cek apakah email sudah terdaftar
    $checkEmail = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Insert data ke database
        $sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman login setelah registrasi berhasil
            header("Location: login.php");
            exit();
        } else {
            $error = "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="asset/css/style.css">
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
    
    <!-- Section Registrasi -->
    <div class="form-section">
        <h2>Registrasi Akun Pendaftaran Beasiswa</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p> <!-- Tampilkan pesan error jika ada -->
        <?php endif; ?>

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
    </div>

</body>
</html>
