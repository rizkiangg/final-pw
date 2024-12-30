<?php
session_start();
include '../config/app.php';

$card = select("SELECT * FROM kegiatan LIMIT 2");
$carousel = select("SELECT * FROM kegiatan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .carousel-container::-webkit-scrollbar {
            display: none;
        }
        .carousel-container {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        html {
            scroll-behavior: smooth;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal-content {
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            background-color: white;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactLink = document.querySelector('a[href="#footer"]');
            contactLink.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelector('#footer').scrollIntoView({ behavior: 'smooth' });
            });

            const modal = document.getElementById('activityModal');
            const modalContent = document.getElementById('modalContent');
            const closeBtn = document.getElementsByClassName('close')[0];

            document.querySelectorAll('.carousel-card').forEach(function(card) {
                card.addEventListener('click', function() {
                    const activityData = JSON.parse(this.dataset.activity);
                    modalContent.innerHTML = `
                        <h2 class="text-2xl font-bold mb-4">${activityData.nama_keg}</h2>
                        <p><strong>Lokasi:</strong> ${activityData.lokasi}</p>
                        <p><strong>Tanggal:</strong> ${activityData.tgl_keg}</p>
                        <p><strong>Deskripsi:</strong> ${activityData.deskripsi}</p>
                        <div class="mt-4">
                            ${activityData.foto.split(',').map(photo => `<img src="../assets/img/${photo.trim()}" alt="${activityData.nama_keg}" class="w-full h-80 object-cover mb-4">`).join('')}
                        </div>
                    `;
                    modal.style.display = 'block';
                });
            });

            closeBtn.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            // Infinite scrolling for carousel
            const carouselContainer = document.querySelector('.carousel-container');
            let isDown = false;
            let startX;
            let scrollLeft;

            carouselContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                carouselContainer.classList.add('active');
                startX = e.pageX - carouselContainer.offsetLeft;
                scrollLeft = carouselContainer.scrollLeft;
            });

            carouselContainer.addEventListener('mouseleave', () => {
                isDown = false;
                carouselContainer.classList.remove('active');
            });

            carouselContainer.addEventListener('mouseup', () => {
                isDown = false;
                carouselContainer.classList.remove('active');
            });

            carouselContainer.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - carouselContainer.offsetLeft;
                const walk = (x - startX) * 3; //scroll-fast
                carouselContainer.scrollLeft = scrollLeft - walk;
            });

            document.getElementById('prev').addEventListener('click', () => {
                carouselContainer.scrollLeft -= carouselContainer.clientWidth;
            });

            document.getElementById('next').addEventListener('click', () => {
                carouselContainer.scrollLeft += carouselContainer.clientWidth;
            });

            // Disable buttons if not logged in
            const isLoggedIn = <?= isset($_SESSION['loggedin']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                document.getElementById('danaMasukBtn').addEventListener('click', function(event) {
                    event.preventDefault();
                    alert('Please log in to access this page.');
                    window.location.href = 'login.php';
                });
                document.getElementById('kegiatanLainnyaBtn').addEventListener('click', function(event) {
                    event.preventDefault();
                    alert('Please log in to access this page.');
                    window.location.href = 'login.php';
                });
            }
        });
    </script>
</head>
<body>
    <div class="p-3 content-center bg-[#EAE3DE] shadow sticky top-0 z-50">
        <div class="content-center mx-32 flex justify-between">
            <img src="../assets/icons/navLogo.svg" width="216.62" class="cursor-pointer" alt="logo" onclick="document.location.href = 'homepage.php'">
            <div class="flex space-x-12 text-[#314E52] text-xl">
                <a href="#footer" class="cursor-pointer content-center">Contact</a>
                <a href="#" class="cursor-pointer content-center">About</a>
                <?php if (!isset($_SESSION['loggedin'])): ?>
                    <a href="login.php" class="cursor-pointer content-center">Login</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['loggedin'])): ?>
                    <a href="logout.php" class="cursor-pointer content-center">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="h-[80vh] bg-cover bg-center bg-fixed flex justify-center items-center text-center" style="background-image: url('../assets/img/hero.jpg');">
    </div>
    <div class="bg-[#314E52] py-14 px-40">
        <div class="content-center my-10 text-white">
            <p class="text-xl">OPPIM Crew</p>
            <p class="mt-5">OPPIM adalah organisasi sosial kepemudaan yang berfungsi sebagai wadah pengembangan generasi muda di Mlobo, Karangwuni. Kami hadir untuk mendorong partisipasi aktif pemuda dalam kegiatan sosial, pemberdayaan masyarakat, dan pengembangan diri, guna menciptakan masyarakat yang mandiri, kreatif, dan berdaya saing.
            </p>
            <div class="mt-10">
                <h1 class="text-xl">Kegiatan Kami</h1>
                <?php foreach ($card as $index => $kegiatan) : ?>
                    <?php if ($index % 2 == 0) : ?>
                        <div class="mt-10 bg-[#314E52] px-8 justify-between space-y-7 lg:space-y-0 lg:space-x-7 flex flex-col lg:flex-row rounded-md text-white">
                            <div class="w-full lg:w-auto my-5">
                                <img src="../assets/img/<?= htmlspecialchars($kegiatan['foto']); ?>" class="w-full lg:w-80 h-80 rounded-md object-cover" alt="">
                            </div>
                            <div class="mt-7 py-3 w-full lg:w-[75%]">
                                <h2 class="text-2xl border-b-2 border-[#EAE3DE] pb-2"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="mt-7 text-2xl"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="mt-5 h-auto line-clamp-6">
                                    <?= htmlspecialchars($kegiatan['deskripsi']); ?>
                                </p>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="mt-10 text-[#314E52] px-8 justify-between space-y-7 lg:space-y-0 lg:space-x-7 flex flex-col lg:flex-row rounded-md bg-[#EAE3DE]">
                            <div class="mt-7 py-3 w-full lg:w-[75%]">
                                <h2 class="text-2xl border-b-2 border-[#314E52] pb-2"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="mt-7 text-2xl"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="mt-5 h-auto line-clamp-6">
                                    <?= htmlspecialchars($kegiatan['deskripsi']); ?>
                                </p>
                            </div>
                            <div class="w-full lg:w-auto my-5">
                                <?php 
                                $photos = explode(',', $kegiatan['foto']);
                                foreach ($photos as $photo) : ?>
                                    <a href="../assets/img/<?= trim($photo); ?>" class="block mb-2">
                                        <img src="../assets/img/<?= trim($photo); ?>" alt="Foto Kegiatan" class="w-full lg:w-80 h-80 rounded-md object-cover mx-auto lg:mx-0">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="mt-10" id="carousel">
                <h1 class="text-xl text-white ">Kegiatan Lain</h1>
                <div class="relative mt-5">
                    <button id="prev" class="absolute left-0 w-9 top-1/2 transform -translate-y-1/2 opacity-75 bg-[#314E52] text-[#EAE3DE] p-2 rounded-full ml-2 lg:ml-10">‹</button>
                    <div class="carousel-container flex space-x-4 py-4 overflow-x-auto cursor-pointer">
                        <?php foreach ($carousel as $kegiatan) : ?>
                            <div class="carousel-card bg-[#EAE3DE] text-[#314E52] rounded-lg shadow-md p-4 w-64 lg:w-80 flex-shrink-0" data-activity='<?= json_encode($kegiatan); ?>'>
                                <img src="../assets/img/<?= htmlspecialchars(trim(explode(',', $kegiatan['foto'])[0])); ?>" alt="Foto Kegiatan" class="w-full h-40 object-cover mb-4 rounded-md">
                                <h2 class="text-xl"><?= htmlspecialchars($kegiatan['nama_keg']); ?></h2>
                                <p class="mt-2"><?= htmlspecialchars($kegiatan['lokasi']); ?></p>
                                <p class="mt-2 line-clamp-3"><?= htmlspecialchars($kegiatan['deskripsi']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button id="next" class="absolute right-0 w-9 top-1/2 transform -translate-y-1/2 opacity-75 bg-[#314E52] text-[#EAE3DE] p-2 rounded-full mr-2 lg:mr-10">›</button>
                </div>
            </div>
            <div class="mt-10 space-x-8 flex justify-end">
                <a href="daftar_dana.php" id="danaMasukBtn" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Dana Masuk</a>
                <a href="semua_kegiatan.php" id="kegiatanLainnyaBtn" class="py-2 px-11 bg-[#EAE3DE] rounded-sm text-[#314E52] content-center">Kegiatan Lainnya</a>
            </div>
        </div>
    </div>

    <div id="activityModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>
</body>
</html>
<?php
include '../components/footer.php';