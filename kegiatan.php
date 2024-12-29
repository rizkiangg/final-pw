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

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Kegiatan</h1>
    <a href="add_keg.php" class="text-blue-500 hover:underline">Tambah Kegiatan</a>
    <br><br>
    <input type="text" id="search" placeholder="Search by name" onkeyup="searchKegiatan()">
    <span>
        <?php if ($total > 0) : ?>
            <?= $total; ?> Kegiatan ditemukan
        <?php else : ?>
            Kegiatan tidak ditemukan
        <?php endif; ?>
    </span>
    <br>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Kegiatan</th>
                <th class="py-2 px-4 border-b">Deskripsi</th>
                <th class="py-2 px-4 border-b">Tanggal</th>
                <th class="py-2 px-4 border-b">Foto</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php $no = $start + 1; ?>
            <?php foreach ($data_kegiatan as $kegiatan) : ?>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b"><?= $no++; ?></td>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($kegiatan['nama_keg']); ?></td>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($kegiatan['deskripsi']); ?></td>
                    <td class="py-2 px-4 border-b"><?= date('d/m/Y', strtotime($kegiatan['tgl_keg'])) ?></td>
                    <td class="py-2 px-4 border-b">
                        <?php 
                        $photos = explode(',', $kegiatan['foto']);
                        foreach ($photos as $photo) : ?>
                            <a href="assets/img/<?= trim($photo); ?>" class="block mb-2">
                                <img src="assets/img/<?= trim($photo); ?>" alt="Foto Kegiatan" class="h-20 w-20 object-cover">
                            </a>
                        <?php endforeach; ?>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="edit_keg.php?id_kegiatan=<?= $kegiatan['id_kegiatan']; ?>" class="text-blue-500 hover:underline">edit</a>
                        <a href="delete_keg.php?id_kegiatan=<?= $kegiatan['id_kegiatan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" class="text-red-500 hover:underline">delete</a>
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

<?php
include 'layout/footer.php';
?>
