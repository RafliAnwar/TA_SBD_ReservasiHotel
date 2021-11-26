<?php
// include database connection file 
include_once("config.php");

$kamar = mysqli_query($link, "SELECT * FROM kamar WHERE is_delete=0 ORDER BY id_kamar");
$tamu = mysqli_query($link, "SELECT * FROM tamu WHERE is_delete=0 ORDER BY id_tamu");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $id_reservasi = $_POST['id_reservasi'];
    $durasi = $_POST['durasi'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $id_tamu = $_POST['id_tamu'];
    $id_kamar = $_POST['id_kamar'];
    // update data 
    $result = mysqli_query($link, "UPDATE reservasi SET durasi='$durasi', tgl_masuk='$tgl_masuk', 
    tgl_keluar='$tgl_keluar', id_tamu='$id_tamu', id_kamar='$id_kamar' WHERE id_reservasi= $id_reservasi");

    // Redirect to homepage to display updated data in list 
    header("Location: homeAdmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM reservasi WHERE id_reservasi=$id");

while ($rs = mysqli_fetch_array($result)) {
    $durasi = $rs['durasi'];
    $tgl_masuk = $rs['tgl_masuk'];
    $tgl_keluar = $rs['tgl_keluar'];
    $id_tamu = $rs['id_tamu'];
    $id_kamar = $rs['id_kamar'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Reservasi Kamar Hotel</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        .ButtonGreen {
            background-color: #052a4a;
            border-radius: 3px;
            border: 1px solid #052a4a;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-size: 13px;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #2f6627;
        }
        body{
            font-family: Poppins;
        }
        table {
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        h4 {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            background-color: #052a4a ;
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
        }
    </style>
</head>

<body>

    <body><a href="homeAdmin.php">Home Admin</a>
        <br /><br />

        <h2>Edit Reservasi Kamar Hotel</h2>

        <div class="Tabel">
            <form name="update_reservasi" method="post" action="editReservasi.php">
                <table border="0">
                    <tr>
                        <td>Durasi</td>
                        <td><input type="text" name="durasi" value=<?php echo $durasi; ?>></td>
                    </tr>

                    <tr>
                        <td>Tanggal Masuk</td>
                        <td><input type="text" name="tgl_masuk" value=<?php echo $tgl_masuk; ?>></td>
                    </tr>

                    <tr>
                        <td>Tanggal Keluar</td>
                        <td><input type="text" name="tgl_keluar" value=<?php echo $tgl_keluar; ?>></td>
                    </tr>

                    <tr>
                        <td>ID Tamu</td>
                        <td><input type="text" name="id_tamu" value=<?php echo $id_tamu; ?>></td>
                    </tr>

                    <tr>
                        <td>ID Kamar</td>
                        <td><input type="text" name="id_kamar" value=<?php echo $id_kamar; ?>></td>
                    </tr>

                    <tr>
                        <td><input type="hidden" name="id_reservasi" value=<?php echo $_GET['id']; ?>></td>
                        <td><input class="ButtonGreen" type="submit" name="update" value="Update"></td>
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
    </body>

</html>