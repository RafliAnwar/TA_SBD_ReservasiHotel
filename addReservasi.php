<?php
include_once("config.php");

$tamu = mysqli_query($link, "SELECT * FROM tamu WHERE is_delete=0 ORDER BY id_tamu DESC");
$kamar = mysqli_query($link, "SELECT * FROM kamar WHERE is_delete=0 ORDER BY id_kamar DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservasi</title>
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

        table {
            margin-left: auto;
            margin-right: auto;
            border-style: solid;
            border-collapse: collapse;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
            color: whitesmoke;
        }

        h4 {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            background-color: #052a4a;
            color: white;
        }

        tr {
            text-align: center;
        }

        td {
            text-align: center;
            padding: 7px 10px 7px 10px;
        }

        .Tabel {
            border-radius: 30px;
            margin-bottom: 10px;
            margin-left: 35%;
            margin-right: 35%;
            border-style: solid;
            background-color: whitesmoke;
        }

        .myButton {
            box-shadow: inset 0px 0px 15px 3px #23395e;
            background: linear-gradient(to bottom, #2e466e 5%, #415989 100%);
            background-color: #2e466e;
            border-radius: 9px;
            border: 1px solid #1f2f47;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-family: Arial;
            font-size: 15px;
            padding: 6px 13px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #263666;
        }

        .myButton:hover {
            background: linear-gradient(to bottom, #415989 5%, #2e466e 100%);
            background-color: #415989;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }
    </style>
</head>

<body>
    <a href="homeAdmin.php">Back</a>
    <br /><br />

    <div class="Tabel">
        <h2>Reservasi Kamar Hotel</h2>
        <form action="addReservasi.php" method="post" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td>Durasi(/hari)</td>
                    <td><input type="text" name="durasi"></td>
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
                    <td>ID Tamu</td>
                    <td><input type="text" name="id_tamu"></td>
                </tr>
                <tr>
                    <td>ID Kamar</td>
                    <td><input type="text" name="id_kamar"></td>
                </tr>
                <td></td>
                <td><input class="myButton" type="submit" name="Submit" value="Add"></td>
                </tr>

            </table>
        </form>
    </div>

    <h3>ID Tamu dan ID Kamar dapat dilihat pada tabel dibawah ini</h3>

    <div class="Tabel">
        <h4>Tabel Tamu</h4>
        <table width='80%' border=1>
            <tr>
                <th>ID Tamu</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Email</th>
            </tr>

            <?php
            while ($item = mysqli_fetch_array($tamu)) {
                echo "<tr>";
                echo "<td>" . $item['id_tamu'] . "</td>";
                echo "<td>" . $item['nama_tamu'] . "</td>";
                echo "<td>" . $item['no_hp'] . "</td>";
                echo "<td>" . $item['email_tamu'] . "</td>";
            }
            ?>
        </table><br>
    </div>

    <div class="Tabel">
        <h4>Tabel Kamar</h4>
        <table width='80%' border=1>
            <tr>
                <th>ID Kamar</th>
                <th>Nama Kamar</th>
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
    </div>

    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $durasi = $_POST['durasi'];
        $tgl_masuk = $_POST['tgl_masuk'];
        $tgl_keluar = $_POST['tgl_keluar'];
        $id_tamu = $_POST['id_tamu'];
        $id_kamar = $_POST['id_kamar'];

        // include database connection file 
        include_once("config.php");

        // Insert user data into table 
        $result = mysqli_query($link, "INSERT INTO reservasi(durasi, tgl_masuk, tgl_keluar, id_tamu, id_kamar) VALUES('$durasi', '$tgl_masuk', '$tgl_keluar', '$id_tamu', '$id_kamar')");
        // Show message when user added 
        echo "Berhasil menambahkan Reservasi <br><a href='homeAdmin.php'>Kembali ke Home Admin</a>";
    }
    ?>
</body>

</html>