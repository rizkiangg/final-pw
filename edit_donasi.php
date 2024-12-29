<?php

$title = 'Edit Donatur';

include 'layout/header.php';

$id_donatur = (int)$_GET['id_donatur'];

$donatur = select("SELECT * FROM donasi WHERE id_donatur = $id_donatur")[0];

if (isset($_POST['ubah'])) {
    if (update_donatur($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'index.php';
        </script>";
    }
}
?>



<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Donatur</h1>
    
    <form action="" method="post" class="space-y-4">
        <input type="hidden" name="id_donatur" value="<?= htmlspecialchars($donatur['id_donatur']) ?>">
        <div>
            <label for="nama_donatur" class="block text-sm font-medium text-gray-700">Nama Donatur</label>
            <input type="text" name="nama_donatur" id="nama_donatur" value="<?= htmlspecialchars($donatur['nama_donatur']) ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
            <input type="text" name="pesan" id="pesan" value="<?= htmlspecialchars($donatur['pesan']) ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="jumlah_donasi" class="block text-sm font-medium text-gray-700">Jumlah Donasi</label>
            <input type="number" name="jumlah_donasi" id="jumlah_donasi" value="<?= htmlspecialchars($donatur['jumlah_donasi']) ?>" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button type="submit" name="ubah" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ubah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>