<?php
session_start();

// Koneksi ke database
include 'database/connection.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['nama'])) {
    header("Location: page/dashboard.php");
    exit();
}

// Proses login jika method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Mengikat parameter email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password yang diinput dengan password yang tersimpan di database
        if (password_verify($password, $user['password'])) {
            // Set session untuk menyimpan nama pengguna
            $_SESSION['nama'] = $user['nama'];

            // Redirect ke dashboard pengguna biasa
            header("Location: page/dashboard.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Pengguna tidak ditemukan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="asset/css/style.css?v=1.0">
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
    
    <h1>Login Akun Pendaftaran Beasiswa</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p> <!-- Tampilkan pesan error jika ada -->
    <?php endif; ?>

    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="menu">
        <p>Belum punya akun? <a href="register.php">Register</a> untuk membuat akun.</p>
    </div>
</body>
</html>
