<?php
include_once("config.php");

//Inisialisasi sesi
session_start();

//Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $kamar = mysqli_query($link, "SELECT * FROM kamar WHERE is_delete=0 AND tipe_kamar LIKE '%" . $search . "%' OR harga_kamar LIKE '%" . $search . "%' ");
} else {
    $kamar = mysqli_query($link, "SELECT * FROM kamar WHERE is_delete=0 ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome Sanggraloka</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        body {
            margin: 0;
            padding: 0;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Poppins;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        }

        h1 {
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
            color: white;
        }

        h3 {
            text-align: center;
            color: #052a4a;
            font-weight: bold;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-color: #0f0c29;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: #052a4a;
            color: #ffffff;
        }

        tr {
            text-align: center;
            color: #052a4a;
        }

        td {
            padding: 10px 10px 10px 10px;
            color: #052a4a;
        }

        p {
            margin-top: 10px;
            margin-left: 10px;
            text-align: left;
        }

        .Tabel {
            position: relative;
            left: 12%;
            width: 75%;
            border-radius: 30px;
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
            border-style: solid;
            border-width: 5px;
            background-color: #e4edf5;
            border-color: #052a4a;
        }

        .TableSearch {
            border-radius: 30px;
            width: 35%;
            padding: 5px 5px 5px 5px;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            border-style: solid;
            border-width: 5px;
            background-color: #e4edf5;
            border-color: #052a4a;
        }

        .buttonSearch {
            background-color: #052a4a;
            color: rgb(255, 250, 227);
            border-color: rgb(74, 71, 53);
            border-radius: 3px;
        }

        .searchLabel {
            color: #052a4a;
            font-weight: bold;
        }

        .td {
            border-radius: 30px;
        }

        .title {
            padding-top: 50px;
            text-align: center;
            padding-bottom: 20px;
        }

        .top-bar {
            z-index: 999;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            width: auto;
            background-color: #0f0c29;
            border-bottom: 3px solid salmon;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <p>
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
    </div>
    <h1 class="title">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to Sanggraloka.</h1>
    <div class="TableSearch">
        <form action="homeUsers.php" method="GET" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td class="searchLabel">Cari:</td>
                    <td><input class="td" type="text" name="search"></td>
                </tr>
                <td />
                <td><input class="buttonSearch" type="submit" value="Search" /></td>
            </table>
        </form>
    </div>

    <div class="Tabel">
        <h3>List Kamar Sanggraloka</h3>
        <table width='80%' border=2>
            <tr class="Search">
                <th>ID Kamar</th>
                <th>Nomor Kamar</th>
                <th>Tipe Kamar</th>
                <th>Harga Kamar</th>
            </tr>

            <?php
            while ($item = mysqli_fetch_array($kamar)) {
                echo "<tr>";
                echo "<td>" . $item['id_kamar'] . "</td>";
                echo "<td>" . $item['nama_kamar'] . "</td>";
                echo "<td>" . $item['tipe_kamar'] . "</td>";
                echo "<td>" . $item['harga_kamar'] . "</td>";
            }
            ?>
        </table><br>
        <h3>Reservasi Kamar Hotel</h3>
        <form action="homeUsers.php" method="post" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama_tamu"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email_tamu"></td>
                </tr>
                <tr>
                    <td>NO HP</td>
                    <td><input type="text" name="no_hp"></td>
                </tr>
                <tr>
                    <td>ID Kamar</td>
                    <td><input type="text" name="id_kamar"></td>
                </tr>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td><input type="text" name="tgl_masuk"></td>
                </tr>
                <tr>
                    <td>Tanggal Keluar</td>
                    <td><input type="text" name="tgl_keluar"></td>
                </tr>
                <tr>
                    <td>Durasi(/hari)</td>
                    <td><input type="text" name="durasi"></td>
                </tr>
                <td></td>
                <td><input class="searchLabel" type="submit" name="Submit" value="Add"></td>
                </tr>

            </table>
        </form>
    </div>

    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $nama_tamu = $_POST['nama_tamu'];
        $email_tamu = $_POST['email_tamu'];
        $no_hp = $_POST['no_hp'];
        $id_kamar = $_POST['id_kamar'];
        $tgl_masuk = $_POST['tgl_masuk'];
        $tgl_keluar = $_POST['tgl_keluar'];
        $durasi = $_POST['durasi'];

        // Insert user data into table 
        $post = "INSERT INTO tamu(id_tamu, nama_tamu, no_hp, email_tamu, is_delete) VALUES ('','$nama_tamu','$no_hp','$email_tamu','')";
        $result = mysqli_query($link, $post);

        $tamu = mysqli_query($link, "SELECT * FROM tamu WHERE is_delete=0 ORDER BY id_tamu ASC");

        while ($item = mysqli_fetch_array($tamu)) {
            $id_tamu1 = $item['id_tamu'];
        }

        $postSecond = "INSERT INTO reservasi(id_reservasi, durasi, tgl_masuk, tgl_keluar,id_tamu, id_kamar, is_delete) VALUES ('',$durasi, $tgl_masuk, $tgl_keluar, $id_tamu1, $id_kamar, '')";

        $resultSec = mysqli_query($link, $postSecond);

        // Show message when user added 
        $message = "Terimakasih $nama_tamu sudah melakukan reservasi di Sanggraloka";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    ?>
</body>

</html>

<?php

?>