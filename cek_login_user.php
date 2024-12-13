<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Cek login untuk admin
    if ($username == "admin" && $password == md5("admin")) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['akses'] = "admin";

        header("location:dashboard_admin.php");
    } else {
        // Cek login untuk dokter
        $query = "SELECT * FROM dokter WHERE nama = '$username' && password = '$password'";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['nama'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['id_poli'] = $data['id_poli'];
            $_SESSION['akses'] = "dokter";

            header("location:dashboard_dokter.php");
        } else {
            // Menampilkan SweetAlert jika login gagal
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Login Gagal",
                            text: "Username atau password salah!",
                            confirmButtonText: "OK",
                            didClose: () => {
                                window.location.href = "login_user.php";
                            }
                        });
                    });
                  </script>';
        }
    }
}
?>