<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tamu</title>
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
        }

        h2 {
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
            background-color: whitesmoke;
            border-style: solid;
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
    <a href="homeAdmin.php">Home</a>
    <br /><br />

    <div class="Tabel">
        <h2>Tambah Tamu</h2>
        <form action="addTamu.php" method="post" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama"></td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td><input type="text" name="no_hp"></td>
                </tr>
                <tr>
                    <td>Email Tamu</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="myButton" type="submit" name="Submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];

        // include database connection file 
        include_once("config.php");

        // Insert user data into table 
        $result = mysqli_query($link, "INSERT INTO tamu(nama_tamu, no_hp, email_tamu) VALUES('$nama', '$no_hp', '$email')");
        // Show message when user added 
        echo "Berhasil menambahkan $nama ke daftar pemesan kamar hotel! <br><a href='homeAdmin.php'>Kembali ke Home Admin</a>";
    }
    ?>
</body>

</html>