<?php 

$title = 'Daftar Donatur';


include '../config/app.php';

$limit = 15; // Jumlah item per halaman
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
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-[#EAE3DE] text-[#314E52]">
<div class="p-3 content-center bg-[#EAE3DE] sticky shadow top-0 z-50">
        <div class="content-center mx-32 flex justify-between">
            <img src="../assets/icons/navLogo.svg" width="216.62" class="cursor-pointer" alt="logo" onclick="document.location.href = 'homepage.php'">
            <div class="flex space-x-12 text-[#314E52] text-xl">
                <a href="#" class="cursor-pointer content-center">Contact</a>
                <a href="#" class="cursor-pointer content-center">About</a>
                <a href="#" class="cursor-pointer content-center">Login</a>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-4 my-6">
        <a href="homepage.php" class="py-2 my-7 px-4 bg-[#314E52] text-[#EAE3DE] rounded-sm">Kembali</a>
        <h1 class="text-2xl font-bold my-4">Rekam Dana Masuk</h1>
        <input type="text" id="search" placeholder="Search by name" onkeyup="searchDonatur()" class="mb-4 p-2 border border-gray-300 rounded">
        <span>
            <?php if ($total > 0) : ?>
                <?= $total; ?> Data ditemukan
            <?php else : ?>
                Data tidak ditemukan
            <?php endif; ?>
        </span>
        <br>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-[#314E52] text-white text-left">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Nama Donatur</th>
                    <th class="py-2 px-4 border-b">Pesan</th>
                    <th class="py-2 px-4 border-b">Jumlah donasi</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php $no = $start + 1; ?>
                <?php foreach ($data_donasi as $donasi) : ?>
                    <tr class="odd:bg-gray-100 even:bg-[#edf1f1] hover:bg-gray-200 text-left">
                        <td class="py-2 px-4 border-b"><?= $no++; ?></td>
                        <td class="py-2 px-4 border-b"><?= !empty($donasi['nama_donatur']) ? htmlspecialchars($donasi['nama_donatur']) : 'Tanpa nama'; ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($donasi['pesan']); ?></td>
                        <td class="py-2 px-4 border-b">Rp<?= number_format($donasi['jumlah_donasi'], 2, ',', '.'); ?></td>
                        <td class="py-2 px-4 border-b"><?= date('d/m/Y | h:i:s', strtotime($donasi['tanggal'])) ?></td>
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
include '../components/footer-gr.php';