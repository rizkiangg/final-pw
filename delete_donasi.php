<?php

$title = 'Delete Donasi';

include 'config/app.php';


$id_donatur = (int)$_GET['id_donatur'];

if (delete_donasi($id_donatur) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'index.php';
    </script>";
}