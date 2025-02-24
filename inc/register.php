<?php
@session_start(); //hanya bisa di acces oleh admin
require_once 'function.php';

//cek apakah suda login sebagai admin
// if (@$_SESSION['email']) {
//     if (@!$_SESSION['level']=="Admin") {
//         header("location:../inc/register.php");
//     } else {
//         if (@$_SESSION['level']=="Petugas") {
//             header("location:../petugas/index.php");
//         }elseif (@$_SESSION['level']=="Penyewa") {
//             header("location:../penyewa/index.php");
//         }elseif (@$_SESSION['level']=="owner") {
//             header("location:../owner/index.php");
//         }elseif (@$_SESSION['level']=="karyawan") {
//             header("location:../karyawan/index.php");
//         }
//     }
// }

//Registrasi
if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User Baru Berhasil Ditambahkan!!!');
        document.location.href='login.php';
        </script>";
    } else {
        echo mysqli_error($KONEKSI);
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
            background-image: url('https://www.smkmvp.sch.id/argon/img/background/SekolahSamping.png');
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
            color: rgb(255, 255, 255);
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
        <form method="post">
            <div class="form-group">
                <input class="form-control form-control-lg" value="<?php echo autonumber("tbl_users", "id_user", 7, "ADM"); ?>" id="Inputname" name="id_user" type="hidden" placeholder="Name">
                <input class="form-control form-control-lg" id="Inputname" name="nama" type="text" placeholder="Name">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="Inputemail" name="email" type="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="Inputpassword" name="password" type="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="Inputpassword2" name="password2" type="password" placeholder="Repeat Password">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="registrasi">Register Here</button>
        </form>
        <div class="register-link">
            <p>Sudah Punya Akun?? .<a href="login.php">Back To Login !</a></p>
        </div>
    </div>

</body>

</html>