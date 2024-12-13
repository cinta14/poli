<?php
session_start();
include_once 'navbar.php';

// Fungsi untuk redirect ke halaman login jika belum login
function redirectToLoginIfNotLoggedIn()
{
    if (!isset($_SESSION['username'])) {
        header("Location: loginAdmin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="app/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">

    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        /* Hero Section */
        .hero-section {
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 20px;
            margin-top: 10px;
        }

        /* Card Layout */
        .card-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card i {
            font-size: 34px;
            color: #007bff;
            /* Warna biru sesuai dengan bg-primary */
        }

        .card h3 {
            font-size: 24px;
            margin-top: 20px;
        }

        .card p {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
        }

        .card .btn {
            margin-top: 20px;
            background-color: #007bff;
            /* Warna biru sesuai dengan bg-primary */
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .card .btn:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 36px;
            }

            .hero-section p {
                font-size: 18px;
            }

            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 80%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section bg-primary">
        <h1>Selamat datang di Poliklinik</h1>
        <p>Pelayanan Kesehatan Terbaik Se Dunia</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="card-container">
            <!-- Pasien Card -->
            <div class="card">
                <i class="fas fa-hospital "></i> <!-- Icon warna biru menggunakan class text-primary -->
                <h3>Pasien</h3>
                <p>Sebagai Pasien dapat melakukan registrasi terlebih dahulu untuk melakukan pendaftaran Pasien.</p>
                <a href="login_pasien.php" class="btn">Login</a>
            </div>

            <!-- Dokter Card -->
            <div class="card">
                <i class="fas fa-user-md "></i> <!-- Icon warna biru menggunakan class text-primary -->
                <h3>Dokter</h3>
                <p>Sebagai Dokter dapat melakukan login terlebih dahulu untuk melakukan pelayanan Pasien.</p>
                <a href="login_user.php" class="btn">Login</a>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="app/dist/js/adminlte.min.js"></script>
</body>

</html>