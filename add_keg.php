<?php

$title = 'Tambah Kegiatan';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (tambah_kegiatan($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'kegiatan.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'kegiatan.php';
        </script>";
    }
}

$tittle = "Tambah Kegiatan";
?>
<link rel="stylesheet" href="./styles.css">

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Kegiatan</h1>
    
    <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan..." required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi..." required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi..." required class="mt-1 block p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="jenis_kegiatan" class="block text-sm font-medium text-gray-700">Jenis Kegiatan</label>
            <select name="jenis_kegiatan" id="jenis_kegiatan" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="Keagamaan">Keagamaan</option>
                <option value="Kewarganegaraan">Kewarganegaraan</option>
                <option value="Hiburan">Hiburan</option>
                <option value="Kemanusiaan">Kemanusiaan</option>
                <option value="Musyawarah">Musyawarah</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto[]" id="foto" multiple required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            <div class="preview mt-2"></div>
        </div>
        <div>
            <label for="budget" class="block text-sm font-medium text-gray-700">Budget</label>
            <input type="number" name="budget" id="budget" placeholder="Budget..." required class="mt-1 block p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button type="submit" name="tambah" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah</button>
    </form>
</div>

<script>
    function previewImages() {
        var preview = document.querySelector('.preview');
        preview.innerHTML = '';
        var files = document.getElementById('foto').files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('h-20', 'w-20', 'object-cover', 'mr-2', 'mb-2');
                preview.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    }

    document.getElementById('foto').addEventListener('change', previewImages);
</script>

<?php
include 'layout/footer.php';
?>
