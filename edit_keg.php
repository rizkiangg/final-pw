<?php

$title = 'Edit Kegiatan';
include 'layout/header.php';

$id_kegiatan = isset($_GET['id_kegiatan']) ? (int)$_GET['id_kegiatan'] : 0;

$kegiatan = select("SELECT * FROM kegiatan WHERE id_kegiatan = $id_kegiatan");

if (empty($kegiatan)) {
    echo "<script>
        alert('Data tidak ditemukan');
        document.location.href = 'kegiatan.php';
    </script>";
    exit;
}

$kegiatan = $kegiatan[0];

if (isset($_POST['ubah'])) {
    if (edit_kegiatan($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'kegiatan.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'kegiatan.php';
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

    form {
        display: grid;
        gap: 1rem;
    }

    form div {
        display: grid;
        gap: .5rem;
    }

    img {
        max-width: 100px;
        height: auto;
    }
</style>

<div>
    <h1>Edit Kegiatan</h1>
    <input type="text" value="<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>" hidden>
    <input type="text" value="<?= htmlspecialchars($kegiatan['foto']); ?>" hidden>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kegiatan" value="<?= htmlspecialchars($kegiatan['id_kegiatan']) ?>">
        <div>
            <label for="nama_keg">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_keg" placeholder="Nama Kegiatan..." value="<?= htmlspecialchars($kegiatan['nama_keg']); ?>" required>
        </div>
        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi..." value="<?= htmlspecialchars($kegiatan['lokasi']); ?>" required>
        </div>
        <div>
            <label for="tgl_keg">Tanggal Kegiatan</label>
            <input type="date" name="tanggal" id="tgl_keg" value="<?= htmlspecialchars($kegiatan['tgl_keg']); ?>" required>
        </div>
        <div>
            <label>Jenis Kegiatan</label>
            <select name="jenis_kegiatan" id="jenis_keg">
                <option value="Keagamaan" <?= $kegiatan['jenis_keg'] == 'Keagamaan' ? 'selected' : ''; ?>>Keagamaan</option>
                <option value="Kewarganegaraan" <?= $kegiatan['jenis_keg'] == 'Kewarganegaraan' ? 'selected' : ''; ?>>Kewarganegaraan</option>
                <option value="Hiburan" <?= $kegiatan['jenis_keg'] == 'Hiburan' ? 'selected' : ''; ?>>Hiburan</option>
                <option value="Kemanusiaan" <?= $kegiatan['jenis_keg'] == 'Kemanusiaan' ? 'selected' : ''; ?>>Kemanusiaan</option>
                <option value="Musyawarah" <?= $kegiatan['jenis_keg'] == 'Musyawarah' ? 'selected' : ''; ?>>Musyawarah</option>
                <option value="Lainnya" <?= $kegiatan['jenis_keg'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
            </select>
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
            <?php if (!empty($kegiatan['foto'])) : ?>
                <img src="assets/img/<?= $kegiatan['foto']; ?>" alt="Foto Kegiatan">
            <?php else : ?>
                Foto tidak tersedia
            <?php endif; ?>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi..." required><?= htmlspecialchars($kegiatan['deskripsi']); ?></textarea>
        </div>
        <div>
            <label for="budget">Budget</label>
            <input type="number" name="budget" id="budget" placeholder="Budget..." value="<?= htmlspecialchars($kegiatan['budget']); ?>" required>
        </div>
        <button type="submit" name="ubah">Edit</button>
    </form>
</div>
