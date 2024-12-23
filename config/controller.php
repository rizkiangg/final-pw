<?php

function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_donatur($post)
{
    global $db;

    $nama_donatur = htmlspecialchars($post['nama_donatur']);
    $pesan = htmlspecialchars($post['pesan']);
    $jumlah_donasi = htmlspecialchars($post['jumlah_donasi']);

    $query = "INSERT INTO donasi (nama_donatur, pesan, jumlah_donasi, tanggal) VALUES ('$nama_donatur', '$pesan', '$jumlah_donasi', CURRENT_TIMESTAMP())";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_donatur($post)
{
    global $db;

    $id_donatur = htmlspecialchars($post['id_donatur']);
    $nama_donatur = htmlspecialchars($post['nama_donatur']);
    $pesan = htmlspecialchars($post['pesan']);
    $jumlah_donasi = htmlspecialchars($post['jumlah_donasi']);

    $query = "UPDATE donasi SET nama_donatur = '$nama_donatur', pesan = '$pesan', jumlah_donasi = '$jumlah_donasi' WHERE id_donatur = $id_donatur";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_donasi($id_donatur)
{
    global $db;
    $query = "DELETE FROM donasi WHERE id_donatur = $id_donatur";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function cari_barang($nama_donatur)
{
    $query = "SELECT * FROM barang WHERE nama_donatur LIKE '%$nama_donatur%'";
    return select($query);
}

function tambah_kegiatan($post)
{
    global $db;

    $nama_kegiatan = htmlspecialchars($post['nama_kegiatan']);
    $lokasi = htmlspecialchars($post['lokasi']);
    $tgl_keg = htmlspecialchars($post['tanggal']);
    $jenis_kegiatan = htmlspecialchars($post['jenis_kegiatan']);
    $foto = upload_file();
    $deskripsi = htmlspecialchars($post['deskripsi']);
    $budget = htmlspecialchars($post['budget']);

    if (!$foto) {
        return false;
    }

    $stmt = $db->prepare("INSERT INTO kegiatan (nama_kegiatan, tgl_keg, lokasi, jenis_kegiatan, foto, deskripsi, budget) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssd", $nama_kegiatan, $tgl_keg, $lokasi, $jenis_kegiatan, $foto, $deskripsi, $budget);
    $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    return $affected_rows;
}

function upload_file()
{
    $nama_file = $_FILES['foto']['name'];
    $ukuran_file = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    $extensi_valid = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    $extensi_file = explode('.', $nama_file);
    $extensi_file = strtolower(end($extensi_file));

    if (!in_array($extensi_file, $extensi_valid)) {
        echo "<script>
            alert('Format file tidak valid');
            document.location.href = 'add_keg.php';
        </script>";
        die();
    }
    if ($ukuran_file > 20480000) { // 20MB
        echo "<script>
            alert('Ukuran file terlalu besar');
            document.location.href = 'add_keg.php';
        </script>";
        die();
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $extensi_file;

    move_uploaded_file($tmp_name, 'assets/img/' . $nama_file_baru);

    return $nama_file_baru;
}

function edit_kegiatan($post)
{
    global $db;

    $id_kegiatan = htmlspecialchars($post['id_kegiatan']);
    $nama_kegiatan = htmlspecialchars($post['nama_kegiatan']);
    $lokasi = htmlspecialchars($post['lokasi']);
    $tgl_keg = htmlspecialchars($post['tanggal']);
    $jenis_kegiatan = htmlspecialchars($post['jenis_kegiatan']);
    $deskripsi = htmlspecialchars($post['deskripsi']);
    $budget = htmlspecialchars($post['budget']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = htmlspecialchars($post['foto_lama']);
    } else {
        $foto = upload_file();
    }

    $stmt = $db->prepare("UPDATE kegiatan SET nama_keg = ?, tgl_keg = ?, lokasi = ?, jenis_keg = ?, foto = ?, deskripsi = ?, budget = ? WHERE id_kegiatan = ?");
    $stmt->bind_param("ssssssdi", $nama_kegiatan, $tgl_keg, $lokasi, $jenis_kegiatan, $foto, $deskripsi, $budget, $id_kegiatan);
    $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    return $affected_rows;
}

function delete_kegiatan($id_kegiatan)
{
    global $db;
    $query = "DELETE FROM kegiatan WHERE id_kegiatan = $id_kegiatan";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}