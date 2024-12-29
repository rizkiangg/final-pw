<?php

$title = 'Tambah Donasi';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (tambah_donatur($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'index.php';
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
</style>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Donasi</h1>
    
    <form action="" method="post" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Donatur</label>
            <div class="mt-2 space-y-2">
                <div>
                    <input type="radio" name="nama_donatur_option" id="tanpa_nama" value="Tanpa nama" required onclick="toggleNamaDonatur(false)" class="mr-2">
                    <label for="tanpa_nama" class="text-sm font-medium text-gray-700">Tanpa Nama</label>
                </div>
                <div>
                    <input type="radio" name="nama_donatur_option" id="dengan_nama" value="Dengan nama" required onclick="toggleNamaDonatur(true)" class="mr-2">
                    <label for="dengan_nama" class="text-sm font-medium text-gray-700">Dengan Nama</label>
                </div>
                <input type="text" name="nama_donatur" id="nama_donatur" placeholder="Nama Donatur..." required disabled class="mt-2 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <script>
                function toggleNamaDonatur(enable) {
                    document.getElementById('nama_donatur').disabled = !enable;
                    if (!enable) {
                        document.getElementById('nama_donatur').value = 'Tanpa nama';
                    } else {
                        document.getElementById('nama_donatur').value = '';
                    }
                }
            </script>
        </div>
        <div>
            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
            <input type="text" name="pesan" id="pesan" placeholder="Pesan..." required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="jumlah_donasi" class="block text-sm font-medium text-gray-700">Jumlah Donasi</label>
            <input type="number" name="jumlah_donasi" id="jumlah_donasi" placeholder="Jumlah Donasi..." min="1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button type="submit" name="tambah" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>