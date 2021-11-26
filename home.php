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
    $listhandphone = mysqli_query($link, "SELECT handphone.nama_hp, manufaktur.nama_manufaktur, os.nama_os, handphone.cpu, handphone.ram, handphone.storage, handphone.harga, handphone.release_date from handphone INNER JOIN manufaktur ON handphone.id_manufaktur = manufaktur.id_manufaktur INNER JOIN os ON handphone.id_os = os.id_os WHERE handphone.is_delete = 0 AND nama_hp LIKE '%" . $search . "%'");
} else {
    $listhandphone = mysqli_query($link, "SELECT handphone.nama_hp, manufaktur.nama_manufaktur, os.nama_os, handphone.cpu, handphone.ram, handphone.storage, handphone.harga, handphone.release_date from handphone INNER JOIN manufaktur ON handphone.id_manufaktur = manufaktur.id_manufaktur INNER JOIN os ON handphone.id_os = os.id_os WHERE handphone.is_delete = 0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
            background-color: rgb(233, 228, 201);
        }

        h1 {
            margin-left: 10px;
            margin-right: 10px;
            color: rgb(48, 46, 34);
        }

        h3 {
            text-align: center;
            color: rgb(74, 71, 53);
            font-weight: bold;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-color: rgb(74, 71, 53);
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(48, 46, 34);
            color: rgb(219, 211, 171);
        }

        tr {
            text-align: center;
            color: rgb(74, 71, 53);
        }

        td {
            padding: 10px 10px 10px 10px;
            color: rgb(74, 71, 53);
        }

        p {
            text-align: center;
        }

        .Tabel {
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
            border-style: double;
            border-width: 5px;
            background-color: rgb(255, 250, 227);
            border-color: rgb(74, 71, 53);
        }

        .TabelSearch {
            width: 35%;
            padding: 5px 5px 5px 5px;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            border-style: double;
            border-width: 5px;
            background-color: rgb(219, 204, 162);
            border-color: rgb(74, 71, 53);
        }

        .buttonSearch {
            background-color: rgb(74, 71, 53);
            color: rgb(255, 250, 227);
            border-color: rgb(74, 71, 53);
            border-radius: 3px;
        }

        .searchLabel {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to Sanggraloka.</h1>

    <div class="TabelSearch">
        <form action="home.php" method="GET" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td class="searchLabel">Search by Name:</td>
                    <td><input type="text" name="search"></td>
                </tr>
                <td />
                <td><input class="buttonSearch" type="submit" value="Search" /></td>
            </table>
        </form>
    </div>

    <div class="Tabel">
        <h3>Katalog Handphone</h3>
        <table width='80%' border=2>
            <tr class="Search">
                <th>Nama HP</th>
                <th>Manufaktur</th>
                <th>OS</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>Storage</th>
                <th>Harga</th>
                <th>Release Date</th>
            </tr>

            <?php
            while ($item = mysqli_fetch_array($listhandphone)) {
                echo "<tr>";
                echo "<td>" . $item['nama_hp'] . "</td>";
                echo "<td>" . $item['nama_manufaktur'] . "</td>";
                echo "<td>" . $item['nama_os'] . "</td>";
                echo "<td>" . $item['cpu'] . "</td>";
                echo "<td>" . $item['ram'] . "</td>";
                echo "<td>" . $item['storage'] . "</td>";
                echo "<td>" . $item['harga'] . "</td>";
                echo "<td>" . $item['release_date'] . "</td>";
            }
            ?>
        </table><br>
    </div>

    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>
</body>

</html>

<?php

?>