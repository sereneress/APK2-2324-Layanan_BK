<?php
//set waktu
date_default_timezone_set('Asia/Jakarta');
$tgl = date('y-m-d H:i:s');

//Koneksi Data Base
$HOASTNAME = "localhost";
$DATABASE = "db_layanan_bk";
$USERNAME = "root";
$PASSWORD = "";

$KONEKSI = mysqli_connect($HOASTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$KONEKSI) {
    die("koneksi errorr coba lagii..!!!" . mysqli_connect_error($KONEKSI));
}

// ===========================
// FUNGSI REGISTER
// ===========================
function register($username, $password, $id_tipe)
{
    global $KONEKSI, $tgl;

    try {
        // 1. Cek apakah username sudah ada
        $checkUsername = mysqli_query($KONEKSI, "SELECT username FROM tbl_users WHERE username = '$username'");
        if (mysqli_num_rows($checkUsername) > 0) {
            return false;
        }

        // 2. Cek apakah tipe user valid
        $cekTipe = mysqli_query($KONEKSI, "SELECT id_tipe FROM tbl_tipe_user WHERE id_tipe = '$id_tipe'");
        if (mysqli_num_rows($cekTipe) == 0) {
            return false;
        }

        // 3. Hash password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // 4. Simpan data ke database
        $query = "INSERT INTO tbl_users (username, password, id_tipe, created_at) 
                VALUES ('$username', '$passwordHash', '$id_tipe', '$tgl')";

        if (mysqli_query($KONEKSI, $query)) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}


// ===========================
// FUNGSI LOGIN
// ===========================
function login($username, $password)
{
    global $KONEKSI;

    $query = "SELECT u.id_user, u.password, t.nama_tipe 
              FROM tbl_users u
              JOIN tbl_tipe_user t ON u.id_tipe = t.id_tipe
              WHERE u.username = '$username'";
              
    $result = mysqli_query($KONEKSI, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['role'] = $row['nama_tipe'];
            return $row['nama_tipe'];
        }
    }
    return false;
}

// ===========================
// FUNGSI LOGOUT
// ===========================
function logout()
{
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}


?>