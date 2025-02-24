<?php
session_start();
require_once 'function.php';

//cek session
if (@$_SESSION['email']) {
    if (@!$_SESSION['level'] == "admin") {
        header("location:../admin/index.php");
    } else {
        if (@$_SESSION['level'] == "petugas") {
            header("location:../petugas/index.php");
        } elseif (@$_SESSION['level'] == "penyewa") {
            header("location:../penyewa/index.php");
        } elseif (@$_SESSION['level'] == "owner") {
            header("location:../owner/index.php");
        } elseif (@$_SESSION['level'] == "karyawan") {
            header("location:../karyawan/index.php");
        }
    }
}

//cek login

// jika tombol signin (login) di tekan, maka akan mengirim variable yang ada form login yaitu username(email) dan password

if (isset($_POST['login'])) {
    $email = strtolower(stripslashes($_POST['email'])); //Email di input oleh user (di dalam post itu name form yg ada di bawah)
    $userpass = mysqli_real_escape_string($KONEKSI, $_POST['password']); //Password yang di input oleh user

    //lalu kita query ke data base
    $sql = mysqli_query($KONEKSI, "SELECT password, id_tipe FROM tbl_users WHERE email='$email' ");

    list($paswd, $role) = mysqli_fetch_array($sql);
    //echo $role;
    //ambil level role/user  sedang login

    $tipe_user = "SELECT * FROM tbl_tipe_user WHERE id_tipe_user='$role'";
    $hasil = mysqli_query($KONEKSI, $tipe_user);
    $row = mysqli_fetch_assoc($hasil);
    $level = $row['tipe_user'];
    //echo $level;
    //jika data di temukan dalam database, maka akan melakukan proses validasi dengan menggunakan password_verify

    if (mysqli_num_rows($sql) > 0) {
        /*jika ada data (>0) maka kita lakukan validasi
        $userpass ==> diambil dari form input yang dilakukan oleh user
        $paswd ==> password yang ada di database dalam bentuk HASH
        */
        if (password_verify($userpass, $paswd)) {
            //akan kita buat session
            $_SESSION['email'] = $email; //mengambil variable $email dari atas (isset)
            $_SESSION['level'] = $level; //mengambil variable $level dari atas (list)

            /*jika berhasil login, maka user akan kita arahkan ke halaman admin sesuai dengan level user 
            jika dia level admin ===>admin/index.php
            jika dia level petugas ===>petugas/index.php
            jika dia level penyewa ===>penyewa/index.php */

            if ($_SESSION['level'] == "Admin") {  //variable (Admin) itu di sesuaikan dengan data base begitupun semuanya
                header("location:../admin/index.php");
            } elseif ($_SESSION['level'] == "Pengguna") {
                header("location:../pengguna/index.php");
            } elseif ($_SESSION['level'] == "Siswa") {
                header("location:../siswa/index.php");
            }
        } else {
            echo '<script language="javascript">
            window.alert("LOGIN GAGAL, EMAIL ATAU PASSWORD ANDA SALAH !!");
            window.document.location.href="login.php";
            </script>';
        }
    } else {
        echo '<script language="javascript">
        window.alert("LOGIN GAGAL, EMAIL TIDAK DI TEMUKAN !!");
        window.document.location.href="login.php";
        </script>';
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
        <form method="post">
            <div class="form-group">
                <label class="form-label">Login<span class="text-danger"></span></label>
                <input class="form-control form-control-lg" id="Inputemail" name="email" type="text" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="form-label">Password<span class="text-danger"></span></label>
                <input class="form-control form-control-lg" id="Inputpassword" name="password" type="password" placeholder="Password">
            </div>

            <!--<div class="mb-4">
                        <label for="inputTypeUser" class="">Type User</label>
                        <select class="custom-select rounded-0" id="inputTypeUser" name="type_user" onchange="tipeUser(this.value);" required>
                            <option selected="" disabled="" value="">Select Type User..</option>
                            <option value="1">Admin</option>
                            <option value="2">Petugas</option>
                            <option value="3">Karyawan</option>
                            <option value="4">Owner</option>
                            <option value="5">Penyewa</option>
                        </select>
                    </div>

                    <div class="mb-4" id="x_branch" style="display:none;">
                        <label for="ddlBranch" class="">Cabang Apartement</label>
                        <select class="custom-select rounded-0"  id="ddlBranch" name="branch" required>
                            <option selected="" disabled="" value="">Pilih Cabang...</option>
                            <option value="1">Cabang 1</option>
                            <option value="2">Cabang 2</option>
                            <option value="3">Cabang 3</option>
                        </select>
                    </div>-->
            <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Login</button>
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="register.php">Register Here!</a></p>
        </div>
    </div>

</body>

</html>