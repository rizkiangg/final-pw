<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'crud_php');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user into database with level set to 2
    $sql = "INSERT INTO users (username, email, password, level) VALUES ('$username', '$email', '$password', 2)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'login.php';
    </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'register.php';
    </script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body style="background-image: url('../assets/icons/logo.svg');" class="bg-[#EAE3DE] flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form action="register.php" method="post" class="space-y-6">
            <div>
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" id="username" name="username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600">Register</button>
        </form>
        <div class="text-center flex space-x-2">
            <p>Sudah punya akun?</p>
            <a href="login.php" class="hover:underline">Login</a>
        </div>
    </div>
</body>
</html>