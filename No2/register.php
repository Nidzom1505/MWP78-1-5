<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $cek = pg_query_params($conn, 'SELECT * FROM "user" WHERE username = $1', array($username));

        if ($cek && pg_num_rows($cek) > 0) {
            echo "Username sudah digunakan!";
        } else {
            $query = pg_query_params($conn, 'INSERT INTO "user" (username, password) VALUES ($1, $2)', array($username, $password));

            if ($query) {
                header("Location: profil.php");
                exit();
            } else {
                echo "Gagal menyimpan data.";
            }
        }
    } else {
        echo "Username dan password tidak boleh kosong!";
    }
}
?>