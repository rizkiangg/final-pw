<?php
include '../config/app.php';

$card = select("SELECT * FROM kegiatan LIMIT 2");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="p-3 content-center bg-[#EAE3DE] sticky top-0 z-50">
        <div class="content-center mx-32 flex justify-between">
            <img src="../assets/icons/navLogo.svg" width="216.62" class="cursor-pointer" alt="logo" onclick="document.location.href = 'homepage.php'">
            <div class="flex space-x-12 text-[#314E52] text-xl">
                <a href="#" class="cursor-pointer content-center">Contact</a>
                <a href="#" class="cursor-pointer content-center">About</a>
                <a href="#" class="cursor-pointer content-center">Login</a>
            </div>
        </div>
    </div>
    <div class="h-[80vh] bg-cover bg-center bg-fixed flex justify-center items-center text-center" style="background-image: url('../assets/img/hero.jpg');">
    </div>
    <div class="bg-[#314E52] py-14 px-40">
        <div class="content-center my-10 text-white">
            <p class="text-xl">OPPIM Crew</p>
            <p class="mt-5">OPPIM adalah organisasi sosial kepemudaan yang berfungsi sebagai wadah pengembangan generasi muda di Mlobo, Karangwuni. Kami hadir untuk mendorong partisipasi aktif pemuda dalam kegiatan sosial, pemberdayaan masyarakat, dan pengembangan diri, guna menciptakan masyarakat yang mandiri, kreatif, dan berdaya saing.

Dengan semangat gotong royong dan kepedulian terhadap lingkungan sekitar, OPPIM menjalankan berbagai program seperti pelatihan keterampilan, kegiatan olahraga dan seni, bakti sosial, serta inisiatif untuk mendukung pembangunan berkelanjutan di wilayah kami.

Kami percaya bahwa pemuda adalah aset penting bagi bangsa. Melalui komitmen kami untuk terus berinovasi dan berkontribusi, kami berharap dapat menjadi pelopor perubahan positif yang berdampak bagi masyarakat.

Mari bergabung bersama kami untuk membangun masa depan yang lebih baik, penuh harapan, dan penuh karya!
            </p>
            <div class="mt-10">
                <h1 class="text-xl">Kegiatan Kami</h1>
                <?php foreach ($card as $index => $kegiatan) : ?>
                    <?php if ($index % 2 == 0) : ?>
                        <div class="mt-10 bg-[#314E52] px-8 justify-between space-x-7 flex flex-col lg:flex-row rounded-md text-[#EAE3DE]">
                            <div class="w-auto my-5">
                                <img src="../assets/img/<?= htmlspecialchars($kegiatan['foto']); ?>" class="w-80 h-80 rounded-md object-cover" alt="">
                            </div>
                            <div class="mt-7 py-3 w-[75%]">
                                <h2 class="text-2xl border-b-2 border-[#EAE3DE] pb-2"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="mt-7 text-2xl"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="mt-5 h-auto line-clamp-6">
                                    <?= htmlspecialchars($kegiatan['deskripsi']); ?>
                                </p>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="mt-10 text-[#314E52] px-8 justify-between space-x-7 flex flex-col lg:flex-row rounded-md bg-[#EAE3DE]">
                            <div class="mt-7 py-3 w-full lg:w-[75%]">
                                <h2 class="text-2xl border-b-2 border-[#314E52] pb-2"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="mt-7 text-2xl"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="mt-5 line-clamp-6">
                                    <?= htmlspecialchars($kegiatan['deskripsi']); ?>
                                </p>
                            </div>
                            <div class="w-full lg:w-auto my-5">
                                <?php 
                                $photos = explode(',', $kegiatan['foto']);
                                foreach ($photos as $photo) : ?>
                                    <a href="../assets/img/<?= trim($photo); ?>" class="block mb-2">
                                        <img src="../assets/img/<?= trim($photo); ?>" alt="Foto Kegiatan" class="w-80 h-80 rounded-md object-cover mx-auto lg:mx-0">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="mt-10 space-x-8 flex justify-end">
                <a href="#" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Dana Masuk</a>
                <a href="#" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Kegiatan Lainnya</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include '../components/footer.php';