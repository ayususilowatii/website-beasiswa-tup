<?php
include 'database/connection.php';

// Check if the filename is set in the URL
if (isset($_GET['file'])) {
    // Sanitize the filename to prevent directory traversal attacks
    $filename = basename($_GET['file']); // Get the base name to avoid path traversal
    $file_path = '../../uploads/' . $filename; // Adjust this path as necessary

    // Check if the file exists
    if (file_exists($file_path)) {
        // Set headers to initiate file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Clear output buffer before reading the file
        ob_clean();
        flush();
        readfile($file_path);
        exit; // Stop further execution
    } else {
        echo "<script>alert('File tidak ditemukan.'); window.location.href='../hasil.php';</script>";
    }
} else {
    echo "<script>alert('Nama file tidak ditentukan.'); window.location.href='../hasil.php';</script>";
}
?>
