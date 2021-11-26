<?php
// include database connection file 
include_once("config.php");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $id_kamar = $_POST['id_kamar'];
    $nama_kamar = $_POST['nama_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga_kamar = $_POST['harga_kamar'];

    // update data 
    $result = mysqli_query($link, "UPDATE kamar SET nama_kamar='$nama_kamar', tipe_kamar ='$tipe_kamar', harga_kamar='$harga_kamar' WHERE id_kamar=$id_kamar");

    // Redirect to homepage to display updated data in list 
    header("Location: homeAdmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM kamar WHERE id_kamar=$id");

while ($kamar = mysqli_fetch_array($result)) {
    $nama_kamar = $kamar['nama_kamar'];
    $tipe_kamar = $kamar['tipe_kamar'];
    $harga_kamar = $kamar['harga_kamar'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Daftar Kamar Hotel</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
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

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
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
        .ButtonBlue {
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
    </style>
</head>

<body>

    <body><a href="homeAdmin.php">Back to Home</a>
        <br /><br />

        <h2>Edit Kamar Hotel</h2>

        <div class="Tabel">
            <form name="update_kamar" method="post" action="editKamar.php">
                <table border="0">
                    <tr>
                        <td>Nama Kamar</td>
                        <td><input type="text" name="nama_kamar" value=<?php echo $nama_kamar; ?>></td>
                    </tr>

                    <tr>
                        <td>Tipe Kamar</td>
                        <td><input type="text" name="tipe_kamar" value=<?php echo $tipe_kamar; ?>></td>
                    </tr>

                    <tr>
                        <td>Harga Kamar</td>
                        <td><input type="text" name="harga_kamar" value=<?php echo $harga_kamar; ?>></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id_kamar" value=<?php echo $_GET['id']; ?>></td>
                        <td><input class="ButtonBlue" type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>