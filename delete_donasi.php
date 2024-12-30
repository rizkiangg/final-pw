<?php
session_start();

// Check if the user is logged in and their level
if (!isset($_SESSION['loggedin']) || $_SESSION['level'] != 1) {
    echo "<script>
    alert('Access denied');
    document.location.href = 'daftar_donasi.php';
    </script>";
    exit;
}

$title = 'Delete Donasi';

include 'config/app.php';

$id_donatur = (int)$_GET['id_donatur'];

if (delete_donasi($id_donatur) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'daftar_donasi.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'daftar_donasi.php';
    </script>";
}
?>