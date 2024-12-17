<?php 
include 'layout/header.php';

$limit = 10; // Jumlah item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

$total = count(select("SELECT * FROM donasi"));
$pages = ceil($total / $limit);

$data_donasi = select("SELECT * FROM donasi LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Donatur</title>
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
    </style>
    <script>
        function searchDonatur() {
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
    <h1>Daftar Donatur</h1>
    <a href="add_donasi.php">Tambah Donatur</a>
    <br>
    <br>
    <input type="text" id="search" placeholder="Search by name" onkeyup="searchDonatur()">
    <span>
        <?php if ($total > 0) : ?>
            <?= $total; ?> Donatur ditemukan
        <?php else : ?>
            Donatur tidak ditemukan
        <?php endif; ?>
    </span>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Donatur</th>
                <th>Pesan</th>
                <th>Jumlah donasi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php $no = $start + 1; ?>
            <?php foreach ($data_donasi as $donasi) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($donasi['nama_donatur']); ?></td>
                    <td><?= htmlspecialchars($donasi['pesan']); ?></td>
                    <td>Rp<?= number_format($donasi['jumlah_donasi'], 2, ',', '.'); ?></td>
                    <td><?= date('d/m/Y | h:i:s', strtotime($donasi['tanggal'])) ?></td>
                    <td>
                        <a href="edit_donasi.php?id_donatur=<?= $donasi['id_donatur']; ?>">edit</a>
                        <a href="delete_donasi.php?id_donatur=<?= $donasi['id_donatur']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus donasi ini?')">delete</a>
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

<?php
include 'layout/footer.php';
?>