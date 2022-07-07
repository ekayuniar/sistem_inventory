<?php
session_start();

$koneksi = mysqli_connect('localhost', 'root', '', 'inventory');

if (isset($_POST['login'])) {
    //initial variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query(
        $koneksi,
        "SELECT * FROM user 
        WHERE username='$username' 
            AND password='$password'"
    );
    $hitung = mysqli_num_rows($check);

    if ($hitung > 0) {
        // jika datanya ada, dan ditemukan 
        // berhasil login
        $_SESSION['login'] = true;
        header('location:index.php');
    } else {
        //Datanya g ada
        // gagal login
        echo '
        <script>
        alert("Username atau Password salah")
        window.location.href="login.php"
        </script>';
    }
}

if (isset($_POST['tambahpelanggan'])) {
    // initial variable
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];

    $tambahpelanggan = mysqli_query(
        $koneksi,
        "INSERT INTO pelanggan (nama_pelanggan, no_telp, alamat) 
   VALUES ('$nama_pelanggan','$no_telp','$alamat')"
    );

    if ($tambahpelanggan) {
        // kalau sukses
        header('location:pelanggan.php');
    } else {
        echo '<script>
    alert("Gagal Tambag Pelanggan")
    window.location.href="pelanggan.php"
    </script>';
    }
}