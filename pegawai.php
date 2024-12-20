<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kepegawaian</title>
    <link rel="icon" type="image/x-icon" href="images/logo2.ico">

    <!-- Link ke CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                            <a class="nav-link" href="./index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./profil.php">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pegawai.php">Data Pegawai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pengaturan.php">Pengaturan</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="row">
                    <h2>DATA PEGAWAI</h2>
                </div>
                <div class="row" style="padding-bottom: 10px;">
                    <button type="button" class="btn btn-success btn-sm">Tambah Data</button>
                </div>
                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once __DIR__ . '\classes\Database.php';
                            class Pegawai
                            {
                                private $db;
                                public function __construct()
                                {
                                    $database = new Database();
                                    $this->db = $database->connect();
                                }

                                public function getAllEmployee()
                                {
                                    $query = $this->db->prepare("SELECT * FROM employee");
                                    $query->execute();
                                    return $query->fetchAll(PDO::FETCH_ASSOC);
                                }
                            }

                            $pegawai = new Pegawai();
                            $datapegawai = $pegawai->getAllEmployee();

                            $nom = 1;
                            foreach ($datapegawai as $peg) {
                            ?>
                                <tr>
                                    <td><?php echo $nom; ?></td>
                                    <td><?php echo $peg['nip']; ?></td>
                                    <td><?php echo $peg['nama']; ?></td>
                                    <td><?php echo $peg['alamat']; ?></td>
                                    <td><?php echo $peg['no_hp']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm">Edit</button> | <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            <?php
                                $nom++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div style="height:350px;">&nbsp;</div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Website Anda | Semua hak dilindungi</p>
    </footer>

    <!-- Script JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>