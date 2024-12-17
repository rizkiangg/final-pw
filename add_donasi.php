<?php
include 'layout/header.php'; 

if (isset($_POST['tambah'])) {
    if (tambah_donatur($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
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
    <h1>Tambah Donatur</h1>
    
    <form action="" method="post">
        <div>
            <label for="nama_donatur">Nama Donatur</label>
            <input type="text" name="nama_donatur" id="nama_donatur" placeholder="Nama Donatur..." required>
        </div>
        <div>
            <label for="pesan">Pesan</label>
            <input type="text" name="pesan" id="pesan" placeholder="Pesan..." required>
        </div>
        <div>
            <label for="jumlah_donasi">Jumlah Donasi</label>
            <input type="number" name="jumlah_donasi" id="jumlah_donasi" placeholder="Jumlah Donasi..." min="1" required>
        </div>
        <button type="submit" name="tambah">Tambah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>