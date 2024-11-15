<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        /* Gaya dasar untuk body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Gaya untuk header */
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1em;
            text-align: center;
        }

        /* Gaya untuk footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            margin-top: auto;
        }

        /* Gaya untuk kontainer utama */
        .container {
            display: flex;
            flex: 1;
        }

        /* Gaya untuk sidebar */
        .sidebar {
            background-color: #f4f4f4;
            width: 250px;
            padding: 1em;
        }

        /* Gaya untuk konten utama */
        .content {
            flex: 1;
            padding: 1em;
        }

        /* Gaya untuk table */
        table,
        th,
        td {
            border: 1px solid blue;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        .center-h {
            display: flex;
            justify-content: center;
            /* Horizontal Centering */
            align-items: center;
            padding-bottom: 5px;
        }

        .center-hv {
            display: flex;
            justify-content: center;
            /* Horizontal Centering */
            align-items: center;
            /* Vertical Centering */
            height: 100vh;
            /* Membuat div memenuhi tinggi viewport */
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <h1>APLIKASI WEB</h1>
        <p>PENGELOLAAN DATA PEGAWAI</p>
    </header>

    <!-- Kontainer Utama -->
    <div class="container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Menu Aplikasi</h2>
            <ul>
                <li><a href="#">Data Pegawai</a></li>
                <li><a href="#">Kategori Pegawai</a></li>
                <li><a href="#">Laporan</a></li>
            </ul>
        </aside>

        <!-- Konten Utama -->
        <main class="content">
            <div class="center-h">
                <table style="width:70%; border: 1px;">
                    <tr>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <td>123</td>
                        <td>Maria Anders</td>
                        <td>Tegal</td>
                        <td><button type="button" class="btn btn-warning btn-sm">Edit</button> | Hapus</td>
                    </tr>
                    <tr>
                        <td>124</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                        <td>Edit | Hapus</td>
                    </tr>
                </table>
            </div>
            <div class="center-hv">
                <h1>DAFTAR DATA Lainnya</h1>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 MyWeb. Semua hak dilindungi.</p>
    </footer>



</body>

</html>