<?php
include 'layout/header.php';

$id_donatur = (int)$_GET['id_donatur'];

$donatur = select("SELECT * FROM donasi WHERE id_donatur = $id_donatur")[0];

if (isset($_POST['ubah'])) {
    if (update_donatur($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'index.php';
        </script>";
    }
}
?>

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
</style>

<div>
    <h1>Edit Donatur</h1>
    
    <form action="" method="post">
        <input type="hidden" name="id_donatur" value="<?= htmlspecialchars($donatur['id_donatur']) ?>">
        <div>
            <label for="nama">Nama donatur</label>
            <input type="text" name="nama_donatur" id="nama" value="<?= htmlspecialchars($donatur['nama_donatur']) ?>" placeholder="Nama donatur" required>
        </div>
        <div>
            <label for="pesan">Pesan</label>
            <input type="text" name="pesan" id="pesan" placeholder="Pesan donatur..." value="<?= htmlspecialchars($donatur['pesan']) ?>" required>
        </div>
        <div>
            <label for="jumlah">Jumlah donasi</label>
            <input type="number" name="jumlah_donasi" id="jumlah" placeholder="Jumlah donasi..." min="0" value="<?= htmlspecialchars($donatur['jumlah_donasi']) ?>" required>
        </div>
        <button type="submit" name="ubah">Edit</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>