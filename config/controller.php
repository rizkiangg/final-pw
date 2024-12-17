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

    $nama_donatur = $post['nama_donatur'];
    $pesan = $post['pesan'];
    $jumlah_donasi = $post['jumlah_donasi'];

    $query = "INSERT INTO donasi (nama_donatur, pesan, jumlah_donasi, tanggal) VALUES ('$nama_donatur', '$pesan', '$jumlah_donasi', CURRENT_TIMESTAMP())";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_donatur($post)
{
    global $db;

    $id_donatur = $post['id_donatur'];
    $nama_donatur = $post['nama_donatur'];
    $pesan = $post['pesan'];
    $jumlah_donasi = $post['jumlah_donasi'];

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
