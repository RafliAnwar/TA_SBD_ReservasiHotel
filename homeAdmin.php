<?php
// Create database connection using config file
include_once("config.php");
// Fetch data
$tamu = mysqli_query($link, "SELECT * FROM tamu WHERE is_delete=0 ORDER BY id_tamu DESC");
$kamar = mysqli_query($link, "SELECT * FROM kamar WHERE is_delete=0 ORDER BY id_kamar DESC");
$reservasi = mysqli_query($link, "SELECT reservasi.id_reservasi, tamu.nama_tamu, tamu.email_tamu, kamar.nama_kamar, kamar.tipe_kamar, kamar.harga_kamar, reservasi.tgl_masuk, reservasi.tgl_keluar, reservasi.durasi, reservasi.durasi*kamar.harga_kamar as total FROM reservasi INNER join tamu ON tamu.id_tamu = reservasi.id_tamu INNER JOIN kamar ON reservasi.id_kamar = kamar.id_kamar WHERE reservasi.is_delete = 0 ORDER BY reservasi.id_reservasi DESC;");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Homepage</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        h1 {
            font-size: 60px;
            font-family: arial;
            text-align: start;
            padding-left: 20px;
            color: whitesmoke;
            text-shadow: -5px 5px 0px #00e6e6,
                -10px 10px 0px #01cccc,
                -15px 15px 0px #00bdbd;
        }
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }

        .ButtonGreen {
            background-color: #44c767;
            border-radius: 3px;
            border: 1px solid #18ab29;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-size: 13px;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #2f6627;
        }

        .myButtonBlue {
            box-shadow: inset 0px 1px 0px 0px #9fb4f2;
            background: linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
            background-color: #7892c2;
            border-radius: 3px;
            border: 1px solid #4e6096;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-size: 13px;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #283966;
        }

        .myButtonBlue:hover {
            background: linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
            background-color: #476e9e;
        }

        .myButtonBlue:active {
            position: relative;
            top: 1px;
        }

        .myButton {
            box-shadow: inset 0px 1px 0px 0px #cf866c;
            background: linear-gradient(to bottom, #d0451b 5%, #bc3315 100%);
            background-color: #d0451b;
            border-radius: 3px;
            border: 1px solid #942911;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-size: 13px;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #854629;
            margin-right: 30px;
        }

        .myButton:hover {
            background: linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
            background-color: #bc3315;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            border : 0px solid #ffffff;
            border-spacing: 0;
            overflow: hidden;
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {background-color: #f2f2f2;}

        th {
            background-color: #093985;
            color: white;
        }

        body {
            padding-left: 10px;
            background-color: white;
            font-family: Poppins;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1>Hi Admin !</h1>
    <h3>Tabel Tamu</h3>
    <table width='80%' border=1>
        <a href="addTamu.php">Tambah Tamu</a>
        <tr>
            <th>Nama Tamu</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($item = mysqli_fetch_array($tamu)) {
            echo "<tr>";
            echo "<td>" . $item['nama_tamu'] . "</td>";
            echo "<td>" . $item['no_hp'] . "</td>";
            echo "<td>" . $item['email_tamu'] . "</td>";
            echo "<td><a href='editTamu.php?id=$item[id_tamu]' class='myButton'>Edit</a><a href='softDelTamu.php?id=$item[id_tamu]' class='ButtonGreen''>Delete</a></td></tr>";
        }
        ?>
    </table>
    <h3>Tabel Kamar</h3>
    <table width='80%' border=1>
        <a href="addKamar.php">Tambah Kamar</a>
        <tr>
            <th>Nama Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga Kamar</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($item = mysqli_fetch_array($kamar)) {
            echo "<tr>";
            echo "<td>" . $item['nama_kamar'] . "</td>";
            echo "<td>" . $item['tipe_kamar'] . "</td>";
            echo "<td>" . $item['harga_kamar'] . "</td>";
            echo "<td><a href='editKamar.php?id=$item[id_kamar]'class='myButton'>Edit</a><a href='softDelKamar.php?id=$item[id_kamar]' class='ButtonGreen''>Delete</a></td></tr>";
        }
        ?>
    </table>
    <h3>Tabel Reservasi Kamar Hotel</h3>
    <table width='80%' border=1>
        <a href="addReservasi.php">Tambah Reservasi</a>
        <tr>
            <th>ID Reservasi</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga Kamar</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Durasi (/hari)</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($item = mysqli_fetch_array($reservasi)) {
            echo "<tr>";
            echo "<td>" . $item['id_reservasi'] . "</td>";
            echo "<td>" . $item['nama_tamu'] . "</td>";
            echo "<td>" . $item['email_tamu'] . "</td>";
            echo "<td>" . $item['nama_kamar'] . "</td>";
            echo "<td>" . $item['tipe_kamar'] . "</td>";
            echo "<td>" . $item['harga_kamar'] . "</td>";
            echo "<td>" . $item['tgl_masuk'] . "</td>";
            echo "<td>" . $item['tgl_keluar'] . "</td>";
            echo "<td>" . $item['durasi'] . "</td>";
            echo "<td>" . $item['total'] . "</td>";
            echo "<td><a href='editReservasi.php?id=$item[id_reservasi]'class='myButton'>Edit</a><a href='softDelReservasi.php?id=$item[id_reservasi]' class='ButtonGreen''>Delete</a></td></tr>";
        }
        ?>
    </table>
    <br /><br />
    <a href="viewSoftDel.php" class="myButton">Recycle Bin</a>
    <a href="logout.php" class="myButtonBlue">Sign Out</a>
</body>

</html>