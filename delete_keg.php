<?php
session_start();

// Check if the user is logged in and their level
if (!isset($_SESSION['loggedin']) || $_SESSION['level'] != 1) {
    echo "<script>
    alert('Access denied');
    document.location.href = 'index.php';
    </script>";
    exit;
}

$title = 'Delete Kegiatan';

include 'config/app.php';

$id_kegiatan = (int)$_GET['id_kegiatan'];

if (delete_kegiatan($id_kegiatan) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'kegiatan.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'kegiatan.php';
    </script>";
}
?>