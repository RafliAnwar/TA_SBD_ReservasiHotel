<?php
// include database connection file 
include_once("config.php");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $id_tamu = $_POST['id_tamu'];
    $nama_tamu = $_POST['nama_tamu'];
    $no_hp = $_POST['no_hp'];
    $email_tamu = $_POST['email_tamu'];

    // update data 
    $result = mysqli_query($link, "UPDATE tamu SET nama_tamu='$nama_tamu', no_hp ='$no_hp', email_tamu='$email_tamu' WHERE id_tamu=$id_tamu");

    // Redirect to homepage to display updated data in list 
    header("Location: homeAdmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM tamu WHERE id_tamu=$id");

while ($tamu = mysqli_fetch_array($result)) {
    $nama_tamu = $tamu['nama_tamu'];
    $no_hp = $tamu['no_hp'];
    $email_tamu = $tamu['email_tamu'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Daftar Tamu</title>
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

        table {
            margin-left: auto;
            margin-right: auto;
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

        <h2>Edit Tamu</h2>

        <div class="Tabel">
            <form name="update_tamu" method="post" action="editTamu.php">
                <table border="0">
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama_tamu" value=<?php echo $nama_tamu; ?>></td>
                    </tr>

                    <tr>
                        <td>No HP</td>
                        <td><input type="text" name="no_hp" value=<?php echo $no_hp; ?>></td>
                    </tr>

                    <tr>
                        <td>Email Tamu</td>
                        <td><input type="text" name="email_tamu" value=<?php echo $email_tamu; ?>></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id_tamu" value=<?php echo $_GET['id']; ?>></td>
                        <td><input class="ButtonBlue" type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>