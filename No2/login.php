<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Escape keyword "user"
        $query = pg_query_params($conn, 'SELECT * FROM "user" WHERE username = $1', array($username));

        if ($query && pg_num_rows($query) > 0) {
            $user = pg_fetch_assoc($query);

            if ($password === $user['password']) { // tidak pakai password_verify karena tidak hash
                // Simpan info login ke session
                $_SESSION['username'] = $user['username'];

                // Redirect ke halaman profil
                header("Location: profil.php");
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Akun tidak ditemukan!";
        }
    } else {
        echo "Username dan password harus diisi!";
    }
}
?>