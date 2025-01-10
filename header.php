<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kepegawaian</title>
    <link rel="icon" type="image/x-icon" href="images/logo2.ico">

    <!-- Link ke CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <!-- Header -->
    <header class="bg-primary text-white text-center py-4">
        <h1>APLIKASI PENGELOLAAN DATA PEGAWAI</h1>
        <?php
        session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit();
        }

        echo "<h3>Welcome, " . htmlspecialchars($_SESSION['username']) . " | <a href='logout.php' class='btn btn-danger'>Logout</a></h3>";
        ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column p-3">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pegawai.php"><i class="fa-solid fa-users"></i> Data Pegawai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./profil.php"><i class="fa-regular fa-id-card"></i> Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pengaturan.php"><i class="fa-solid fa-gears"></i> Pengaturan</a>
                        </li>
                    </ul>
                </div>
            </nav>