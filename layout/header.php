<?php
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-gray-800 text-white p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">MyWebsite</div>
            <ul class="flex space-x-4">
                <li><a href="index.php" class="hover:underline">Home</a></li>
                <li><a href="about.php" class="hover:underline">About</a></li>
                <li><a href="services.php" class="hover:underline">Services</a></li>
                <li><a href="kegiatan.php" class="hover:underline">Kegiatan</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>