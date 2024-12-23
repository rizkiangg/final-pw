<?php

$title = 'Tambah Kegiatan';

include 'layout/header.php';


if (isset($_POST['tambah'])) {
    if (tambah_kegiatan($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'kegiatan.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'kegiatan.php';
        </script>";
    }
}

$tittle = "Tambah Kegiatan";
?>

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }

    form {
        display: grid;
        gap: 1rem;
    }

    form div {
        display: grid;
        gap: .5rem;
    }
</style>

<div>
    <h1>Tambah Kegiatan</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan..." required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi..." required>
        </div>
        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" required>
        </div>
        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi..." required>
        </div>
        <div>
            <label for="jenis_kegiatan">Jenis Kegiatan</label>
            <select name="jenis_kegiatan" id="jenis_kegiatan" required>
                <option value="Keagamaan">Keagamaan</option>
                <option value="Kewarganegaraan">Kewarganegaraan</option>
                <option value="Hiburan">Hiburan</option>
                <option value="Kemanusiaan">Kemanusiaan</option>
                <option value="Musyawarah">Musyawarah</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto[]" id="foto" multiple required>
        </div>
        <div>
            <label for="budget">Budget</label>
            <input type="number" name="budget" id="budget" placeholder="Budget..." required>
        </div>
        <button type="submit" name="tambah">Tambah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>
