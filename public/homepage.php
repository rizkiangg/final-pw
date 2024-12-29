<?php
include '../config/app.php';

$card = select("SELECT * FROM kegiatan LIMIT 2");
$carousel = select("SELECT * FROM kegiatan");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .carousel-container::-webkit-scrollbar {
            display: none;
        }
        .carousel-container {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
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
            <div class="mt-10" id="carousel">
                <h1 class="text-xl">Kegiatan Lain</h1>
                <div class="relative mt-5">
                    <button id="prev" class="absolute left-0 w-9 top-1/2 transform -translate-y-1/2 opacity-75 bg-[#314E52] text-[#EAE3DE] p-2 rounded-full ml-10">‹</button>
                    <div class="carousel-container flex space-x-4 py-4 overflow-x-auto">
                        <?php foreach (array_slice($carousel, 0, 5) as $kegiatan) : ?>
                            <div class="carousel-card bg-[#EAE3DE] text-[#314E52] rounded-lg shadow-md p-4 w-80 flex-shrink-0">
                                <?php 
                                $photos = explode(',', $kegiatan['foto']);
                                $firstPhoto = trim($photos[0]);
                                ?>
                                <img src="../assets/img/<?= htmlspecialchars($firstPhoto); ?>" alt="Foto Kegiatan" class="w-full h-40 object-cover rounded-md mb-4">
                                <h2 class="text-2xl font-bold mb-2 truncate"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="text-lg text-[#314E52] mb-4"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="text-[#314E52] line-clamp-3"><?= htmlspecialchars($kegiatan['deskripsi']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button id="next" class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-10 opacity-75 bg-[#314E52] w-9 text-[#EAE3DE] p-2 rounded-full">›</button>
                </div>
            </div>
            <div class="mt-10 space-x-8 flex justify-end">
                <a href="#" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Dana Masuk</a>
                <a href="#" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Kegiatan Lainnya</a>
            </div>
        </div>
    </div>
    <script>
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const carouselContainer = document.querySelector('.carousel-container');

        prevButton.addEventListener('click', () => {
            carouselContainer.scrollBy({
                left: -carouselContainer.clientWidth,
                behavior: 'smooth'
            });
        });

        nextButton.addEventListener('click', () => {
            carouselContainer.scrollBy({
                left: carouselContainer.clientWidth,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
<?php
include '../components/footer.php';