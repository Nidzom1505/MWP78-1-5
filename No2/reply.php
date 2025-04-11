<?php
session_start();
include 'koneksi.php';

$username = $_SESSION['username']; // asumsi sudah login
$isi = $_POST['isi'];
$id_postingan = $_POST['id']; // ini id dari postingan yang dibalas

$query = "INSERT INTO reply (id_postingan, username, isi) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($id_postingan, 'admin', $isi));

if ($result) {
    echo "Sukses";
} else {
    echo "Gagal";
}
?>