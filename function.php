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

if (isset($_POST['hapuspelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    $hapuspelanggan = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    if ($hapuspelanggan) {
        // kalau sukses
        header('location:pelanggan.php');
    } else {
        echo '<script> 
        alert("Gagal Hapus Pelanggan")
        window.location.href="pelanggan.php"
        </script>';
    }
}

if (isset($_POST['editpelanggan'])) {
    // initial variable
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $id_pelanggan = $_POST['id_pelanggan'];

    $editpelanggan = mysqli_query($koneksi, "UPDATE pelanggan SET 
        nama_pelanggan='$nama_pelanggan', 
        no_telp='$no_telp', 
        alamat='$alamat' 
            WHERE id_pelanggan='$id_pelanggan'");

    if ($editpelanggan) {
        // kalau sukses
        header('location:pelanggan.php');
    } else {
        echo '<script> 
            alert("Gagal Edit Pelanggan")
            window.location.href="pelanggan.php"
            </script>';
    }
}

if (isset($_POST['tambahproduk'])) {
    //deskripsi initial variable
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $insert_produk = mysqli_query($koneksi, "INSERT INTO produk(nama_produk, deskripsi, harga, stok) VALUES ('$nama_produk','$deskripsi','$harga','$stock')");

    if ($insert_produk) {
        header('location:stock.php');
    } else {
        echo '
        <script>
        alert("Gagal Tambah Produk")
        window.location.href="stock.php"
        </script>';
    }
}