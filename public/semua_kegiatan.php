<?php
session_start();
$title = 'Daftar Kegiatan';

include '../config/app.php';

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
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
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

<body class="bg-gray-100">
    <div class="p-3 content-center bg-[#EAE3DE] shadow sticky top-0 z-50">
        <div class="content-center mx-32 flex justify-between">
            <img src="../assets/icons/navLogo.svg" width="216.62" class="cursor-pointer" alt="logo" onclick="document.location.href = 'homepage.php'">
            <div class="flex space-x-12 text-[#314E52] text-xl">
                <a href="#footer" class="cursor-pointer content-center">Contact</a>
                <a href="#" class="cursor-pointer content-center">About</a>
                <a href="#" class="cursor-pointer content-center">Login</a>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-4">
        <a href="homepage.php" class="py-2 my-10 px-4 bg-[#EAE3DE] text-[#314E52] rounded-sm ">Kembali</a>
        <h1 class="text-2xl my-10 font-bold mb-4 text-[#314E52]">Daftar Kegiatan</h1>
        <input type="text" id="search" class="p-2 rounded-sm" placeholder="Search by name" onkeyup="searchKegiatan()">
        <span class="text-[#314E52]">
            <?php if ($total > 0) : ?>
                <?= $total; ?> Kegiatan ditemukan
                <?php else : ?>
                    Kegiatan tidak ditemukan
                    <?php endif; ?>
                </span>
                <br>
                <table class="min-w-full bg-white border my-10">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-2 px-4 border-b">No</th>
                            <th class="py-2 px-4 border-b">Nama Kegiatan</th>
                            <th class="py-2 px-4 border-b">Deskripsi</th>
                            <th class="py-2 px-4 border-b">Tanggal</th>
                            <th class="py-2 px-4 border-b">Foto</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php $no = $start + 1; ?>
                <?php foreach ($data_kegiatan as $kegiatan) : ?>
                    <tr class="hover:bg-gray-100 odd:bg-gray-200 even:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?= $no++; ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($kegiatan['nama_keg']); ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($kegiatan['deskripsi']); ?></td>
                        <td class="py-2 px-4 border-b"><?= date('d/m/Y', strtotime($kegiatan['tgl_keg'])) ?></td>
                        <td class="py-2 px-4 border-b">
                            <?php 
                            $photos = explode(',', $kegiatan['foto']);
                            foreach ($photos as $photo) : ?>
                                <a href="../assets/img/<?= trim($photo); ?>" class="block mb-2">
                                    <img src="../assets/img/<?= trim($photo); ?>" alt="Foto Kegiatan" class="h-20 w-20 object-cover">
                                </a>
                                <?php endforeach; ?>
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
                        </body>
                        </html>
                        
                        <?php include '../components/footer.php'; ?>