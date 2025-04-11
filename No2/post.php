<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $username = 'user_demo'; // Ganti dengan dari session login
    $isi = trim($_POST['isi']);

    if (!empty($isi)) {
        $query = pg_query($conn, "INSERT INTO postingan (username, isi) VALUES ('admin', '$isi')");

        if ($query) {
            echo 'sukses';
        } else {
            echo 'gagal';
        }
    } else {
        echo 'kosong';
    }
}
?>
