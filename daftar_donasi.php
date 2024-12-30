<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "<script>
    alert('Please log in to access this page.');
    document.location.href = 'public/login.php';
    </script>";
    exit;
}

// Check if the user's level is 1
if ($_SESSION['level'] != 1) {
    echo "<script>
    alert('Access denied');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Dashboard';

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
    <title>Daftar Donasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <a href="add_donasi.php" class="text-blue-500 hover:underline">Tambah Donatur</a>
        <br>
        <br>
        <input type="text" id="search" placeholder="Search by name" onkeyup="searchDonatur()" class="mb-4 p-2 border border-gray-300 rounded">
        <span>
            <?php if ($total > 0) : ?>
                <?= $total; ?> Donatur ditemukan
            <?php else : ?>
                Donatur tidak ditemukan
            <?php endif; ?>
        </span>
        <br>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Nama Donatur</th>
                    <th class="py-2 px-4 border-b">Pesan</th>
                    <th class="py-2 px-4 border-b">Jumlah donasi</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php $no = $start + 1; ?>
                <?php foreach ($data_donasi as $donasi) : ?>
                    <tr class="odd:bg-gray-100 even:bg-white hover:bg-gray-200">
                        <td class="py-2 px-4 border-b"><?= $no++; ?></td>
                        <td class="py-2 px-4 border-b"><?= !empty($donasi['nama_donatur']) ? htmlspecialchars($donasi['nama_donatur']) : 'Tanpa nama'; ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($donasi['pesan']); ?></td>
                        <td class="py-2 px-4 border-b">Rp<?= number_format($donasi['jumlah_donasi'], 2, ',', '.'); ?></td>
                        <td class="py-2 px-4 border-b"><?= date('d/m/Y | h:i:s', strtotime($donasi['tanggal'])) ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="edit_donasi.php?id_donatur=<?= $donasi['id_donatur']; ?>" class="text-blue-500 hover:underline">edit</a>
                            <a href="delete_donasi.php?id_donatur=<?= $donasi['id_donatur']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus donasi ini?')" class="text-red-500 hover:underline">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($total > $limit) : ?>
        <div class="mt-4">
            <?php if ($page > 1) : ?>
                <a href="?page=<?= $page - 1; ?>" class="text-blue-500 hover:underline">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <?php if ($i == $page) : ?>
                    <a href="?page=<?= $i; ?>" class="font-bold text-blue-500"><?= $i; ?></a>
                <?php else : ?>
                    <a href="?page=<?= $i; ?>" class="text-blue-500 hover:underline"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $pages) : ?>
                <a href="?page=<?= $page + 1; ?>" class="text-blue-500 hover:underline">Next</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
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
</body>
</html>

<?php
include 'layout/footer.php';
?>