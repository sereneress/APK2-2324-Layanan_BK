<?php
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $role = login($username, $password);
    if ($role) {
        switch ($role) {
            case "admin":
                echo "<script>
                   alert('Login berhasil sebagai Admin!');
                   window.location.href = '../admin/index.php';
               </script>";
                break;
            case "petugas":
                echo "<script>
                   alert('Login berhasil sebagai Petugas!');
                   window.location.href = '../petugas/index.php';
               </script>";
                break;
        }
        exit();
    } else {
        echo "<script>
           alert('Login gagal! Periksa username atau password.');
       </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Layanan Bimbingan Konseling BK</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-image: url('https://www.smkmvp.sch.id/argon/img/background/SekolahSamping.png');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            width: 360px;
            text-align: center;
        }

        h3 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            font-size: 16px;
            font-weight: 500;
            color: #34495e;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }

        button:hover {
            background-color: #1d6f8f;
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .register-link a {
            color: #2980b9;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h3>Layanan Bimbingan Konseling</h3>
        <form method="POST">
            <input type="text" name="username" placeholder="Username / Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
            <div class="register-link">
                <p>Belum punya akun? <a href="register.php">Register Here!</a></p>
            </div>
        </form>
    </div>

</body>

</html>