<?php 

$title = 'Daftar Kegiatan';

include 'layout/header.php';

$limit = 10; // Jumlah item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

$total = count(select("SELECT * FROM kegiatan"));
$pages = ceil($total / $limit);

$data_kegiatan = select("SELECT * FROM kegiatan LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        img {
            max-width: 100px; /* Atur ukuran maksimum gambar */
            height: auto;
        }
    </style>
    <script>
        function searchKegiatan() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
</head>
<body>
    <h1>Daftar Kegiatan</h1>
    <a href="add_keg.php">Tambah Kegiatan</a>
    <br>
    <br>
    <input type="text" id="search" placeholder="Search by name" onkeyup="searchKegiatan()">
    <span>
        <?php if ($total > 0) : ?>
            <?= $total; ?> Kegiatan ditemukan
        <?php else : ?>
            Kegiatan tidak ditemukan
        <?php endif; ?>
    </span>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php $no = $start + 1; ?>
            <?php foreach ($data_kegiatan as $kegiatan) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($kegiatan['nama_keg']); ?></td>
                    <td><?= htmlspecialchars($kegiatan['deskripsi']); ?></td>
                    <td><?= date('d/m/Y', strtotime($kegiatan['tgl_keg'])) ?></td>
                    <td>
                    <?php 
                    $photos = explode(',', $kegiatan['foto']);
                    foreach ($photos as $photo) : ?>
                        <a href="assets/img/<?= trim($photo); ?>">
                            <img src="assets/img/<?= trim($photo); ?>" alt="Foto Kegiatan">
                        </a>
                    <?php endforeach; ?>
                    </td>
                    <td>
                        <a href="edit_keg.php?id_kegiatan=<?= $kegiatan['id_kegiatan']; ?>">edit</a>
                        <a href="delete_keg.php?id_kegiatan=<?= $kegiatan['id_kegiatan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($total > $limit) : ?>
    <div>
        <?php if ($page > 1) : ?>
            <a href="?page=<?= $page - 1; ?>">Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <?php if ($i == $page) : ?>
                <a href="?page=<?= $i; ?>" style="font-weight: bold;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?page=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($page < $pages) : ?>
            <a href="?page=<?= $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</body>
</html>

