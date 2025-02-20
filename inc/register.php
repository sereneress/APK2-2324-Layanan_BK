<?php
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_tipe = $_POST['id_tipe'];

    $result = register($username, $password, $id_tipe);
    if ($result === true) {
        echo "<script>
           alert('Registrasi berhasil!');
           window.location.href = 'login.php';
       </script>";
    } else {
        echo "<script>
           alert('Registrasi gagal coba lagi!');
       </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Layanan Bimbingan Konseling</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e1e4e8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
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
        input[type="email"],
        select,
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

        .login-link {
            margin-top: 20px;
            font-size: 14px;
            color:rgb(255, 255, 255);
        }

        .login-link a {
            color: #2980b9;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .select-container {
    width: 250px;
    margin: 20px;
    font-family: Arial, sans-serif;
}

select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

select:hover {
    border-color: #66b2ff;
    background-color: #e6f0ff;
}

select:focus {
    outline: none;
    border-color: #0099cc;
    box-shadow: 0 0 5px rgba(0, 153, 204, 0.5);
}

label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 8px;
    display: block;
    color: #333;
}

    </style>
</head>

<body>

    <div class="register-container">
        <h3>Daftar Layanan Bimbingan Konseling</h3>
        <form method="POST">
                <label for="id_tipe">Pilih Tipe Pengguna:</label>
                <select name="id_tipe" id="id_tipe">
                    <option value="1">Admin</option>
                    <option value="2">Pengguna</option>
                </select>

            <label for="id_tipe">Email</label>
            <input type="text" name="username" placeholder="Email" required><br>
            <label for="id_tipe">Password</label>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
            <div class="register-link">
                <p>Sudah punya akun?? <a href="login.php">Login Here!</a></p>
            </div>
        </form>
    </div>

</body>

</html>