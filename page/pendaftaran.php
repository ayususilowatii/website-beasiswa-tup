<?php
include '../database/connection.php';

if(isset($_POST['submit'])) {
    // Get input values
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomorhp = $_POST['noHp'];
    $nim_mhs = $_POST['nim_mhs'];
    $semester = $_POST['semester'];
    $ipk = $_POST['last_ipk']; 
    $beasiswa = $_POST['beasiswa'];

    // Handle file upload
    $berkas = $_FILES['berkas']['name'];
    $berkas_tmp = $_FILES['berkas']['tmp_name'];
    $berkas_size = $_FILES['berkas']['size'];
    $berkas_type = $_FILES['berkas']['type'];
    $berkas_error = $_FILES['berkas']['error'];

    // Check file extension
    $berkas_ext = pathinfo($berkas, PATHINFO_EXTENSION);
    $berkas_ext = strtolower($berkas_ext); // Convert to lowercase for consistency

    // Set default status
    $status = '0';

    // Check for empty inputs
    if($nama == '' || $email == '' || $nomorhp == '' || $nim_mhs == ''|| $semester == '' || $ipk == '' || $berkas == '') {
        echo "<script>alert('Semua kolom harus diisi')</script>";
    } else {
        // Validate the scholarship
        if($beasiswa == '0' || $beasiswa == '') {
            echo "Tidak Memenuhi Syarat beasiswa";
        }

        // Proceed with file upload if there are no errors
        if($berkas_error == 0) {
            // Only allow specific file extensions
            if(in_array($berkas_ext, ['pdf', 'doc', 'docx'])) {
                // Move the uploaded file to the 'uploads' directory
                $upload_dir = '../uploads/';
                $berkas_path = $upload_dir . $berkas;
                if(move_uploaded_file($berkas_tmp, $berkas_path)) {
                    // File uploaded successfully, insert data into the database
                    $sql = "INSERT INTO daftar (nama, email, no_hp, nim_mhs, semester, last_ipk, beasiswa, syarat_berkas, status_ajuan) 
                            VALUES ('$nama', '$email', '$nomorhp','$nim_mhs', '$semester', '$ipk', '$beasiswa', '$berkas', '$status')";

                    if(mysqli_query($conn, $sql)) {
                        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='hasil.php';</script>";
                    } else {
                        echo "<script>alert('Data gagal ditambahkan ke database')</script>";
                    }
                } else {
                    echo "<script>alert('Gagal mengupload berkas')</script>";
                }
            } else {
                echo "<script>alert('Berkas tidak diperbolehkan. Harus dalam format pdf, doc, docx, atau zip.')</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan dalam upload berkas')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
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
                <span class="span1-text">Pendaftaran Beasiswa</span>
            </div>
            <ul>
                <li><a href="dashboard.php">Kategori Beasiswa</a></li>
                <li><a href="pendaftaran.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../function/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>


   <!-- Form Section -->
<div class="container mt-5">
    <div class="form-section bg-light p-4 shadow rounded">
        <h3>Form Pendaftaran</h3>
        <form id="beasiswaForm" action="" method="POST" enctype="multipart/form-data">
            <!-- Two-column layout -->
            <div class="row">
                <div class="col-md-6">
                    <!-- Masukkan Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <!-- Masukkan Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Masukkan Nomor HP -->
                    <div class="mb-3">
                        <label for="noHp" class="form-label">No. HP</label>
                        <input type="tel" class="form-control" id="noHp" name="noHp" pattern="[0-9]+" required>
                    </div>

                    <!--Masukkan NIM -->
                    <div class="mb-3">
                        <label for="nim_mhs" class="form-label">NIM Mahasiswa</label>
                        <input type="text" class="form-control" id="nim_mhs" name="nim_mhs" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Semester Saat Ini -->
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester Saat Ini</label>
                        <select class="form-select" id="semester" name="semester" required>
                            <option value="" disabled selected>Pilih Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>

                    <!-- IPK (diambil secara otomatis) -->
                    <div class="mb-3">
                        <label for="ipk" class="form-label">IPK Terakhir</label>
                        <input type="text" class="form-control" id="ipk" disabled required>
                        <input type="hidden" name="last_ipk" id="last_ipk">
                    </div>

                    <!-- Pilihan Beasiswa (hanya aktif jika IPK >= 3) -->
                    <div class="mb-3">
                        <label for="beasiswa" class="form-label">Pilih Beasiswa</label>
                        <select class="form-select" id="beasiswa" name="beasiswa" disabled>
                            <option value="" disabled selected>Pilih Beasiswa</option>
                            <option value="akademik">Beasiswa Akademik</option>
                            <option value="non-akademik">Beasiswa Non-Akademik</option>
                        </select>
                    </div>

                    <!-- Upload Berkas Syarat -->
                    <div class="mb-3">
                        <label for="berkas" class="form-label">Upload Berkas Syarat</label>
                        <span>Semua berkas syarat digabung menjadi satu format .pdf</span>
                        <input class="form-control" type="file" id="berkas" name="berkas" required>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-flex justify-content-between mt-4">
                <button type="reset" class="btn btn-outline-danger">Batal</button>
                <button type="submit" name="submit" id="submitBtn" class="button" disabled>Daftar</button>
            </div>
        </form>
    </div>
</div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Logic -->
    <script>
    // JavaScript Logic
document.addEventListener('DOMContentLoaded', function () {
    const ipkField = document.getElementById('ipk');
    const beasiswaSelect = document.getElementById('beasiswa');
    const submitBtn = document.getElementById('submitBtn');
    const semesterSelect = document.getElementById('semester');
    const emailInput = document.getElementById('email');
    const noHpInput = document.getElementById('noHp');

    // Define IPK values based on semester
    const ipkValues = {
        1: 2.00,  
        2: 3.10,  
        3: 3.20, 
        4: 3.30,   
        5: 3.40,  
        6: 3.50,  
        7: 3.60,  
        8: 3.70,
    };

    // Update IPK when semester changes
    semesterSelect.addEventListener('change', function () {
        const selectedSemester = semesterSelect.value;
        const ipkValue = ipkValues[selectedSemester] || 0;

        ipkField.value = ipkValue.toFixed(2);
        document.getElementById('last_ipk').value = ipkValue;

        // Enable beasiswa select if IPK is >= 3
        beasiswaSelect.disabled = ipkValue < 3;
        if (ipkValue < 3) {
            beasiswaSelect.value = '';
        }
    });

    // Enable submit button when all required fields are filled
    document.getElementById('beasiswaForm').addEventListener('input', function () {
        submitBtn.disabled = !this.checkValidity();
    });

    // Custom validation for email and phone number
    emailInput.addEventListener('input', function () {
        if (!emailInput.value.includes('@')) {
            emailInput.setCustomValidity('Email harus mengandung karakter @');
            emailInput.reportValidity();
        } else {
            emailInput.setCustomValidity('');
        }
    });

    noHpInput.addEventListener('input', function () {
        const phonePattern = /^[0-9]+$/;
        if (!phonePattern.test(noHpInput.value)) {
            noHpInput.setCustomValidity('Nomor HP hanya boleh berisi angka');
            noHpInput.reportValidity();
        } else {
            noHpInput.setCustomValidity('');
        }
    });

    // Custom validation for empty fields before submission
    document.getElementById('beasiswaForm').addEventListener('submit', function (e) {
        const nama = document.getElementById('nama').value;
        const email = emailInput.value;
        const nomorhp = noHpInput.value;
        const semester = semesterSelect.value;
        const ipk = document.getElementById('last_ipk').value;
        const beasiswa = beasiswaSelect.value;
        const berkas = document.getElementById('berkas').value;

        // Check if any field is empty
        if (nama === '' || email === '' || nomorhp === '' || semester === '' || ipk === '' || berkas === '' || beasiswa === '') {
            alert('Semua kolom harus diisi!');
            e.preventDefault();  // Prevent form submission
        }

        // Final validation for phone number and email
        if (!email.includes('@')) {
            alert('Email harus mengandung karakter @!');
            e.preventDefault();
        }

        if (!/^[0-9]+$/.test(nomorhp)) {
            alert('Nomor HP hanya boleh berisi angka!');
            e.preventDefault();
        }
    });
});
    </script>
</body>
</html>
