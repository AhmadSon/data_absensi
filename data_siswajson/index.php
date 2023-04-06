<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>TI.21.A.1</title>
</head>

<body>

    <?php
    $divClass = "ul.breadcrumb";

    $data = file_get_contents('https://api.steinhq.com/v1/storages/642a1ee5eced9b09e9c762e8/21a1');

    $batas = 10;
    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

    $previous = $halaman - 1;
    $next = $halaman + 1;

    $data = json_decode($data, true);
    $total_data = count($data);
    $total_halaman = ceil($total_data / $batas);

    $awal_data = ($batas * $halaman) - $batas;


    echo "<table border ='2' align = 'center'>";
    echo "<tr><th>No</th><th>NIM</th><th>Nama</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>";

    $no = $awal_data + 1;
    for ($i = $awal_data; $i < $awal_data + $batas; $i++) {
        if (isset($data[$i])) {
            $item = $data[$i];

            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $item['NIM'] . "</td>";
            echo "<td>" . $item['Nama'] . "</td>";
            echo "<td>" . $item['1'] . "</td>";
            echo "<td>" . $item['2'] . "</td>";
            echo "<td>" . $item['3'] . "</td>";
            echo "<td>" . $item['4'] . "</td>";

            echo "</tr>";
            $no++;
        }
    }
    echo "</table>";

    // Membuat navigasi halaman
    echo "<div class='pagination'>";
    if ($total_halaman > 1) {
        // Tombol "Sebelumnya"
        if ($halaman > 1) {
            echo "<a href='?halaman=" . ($halaman - 1) . "'>Sebelumnya</a>";
        } else {
            echo "<a class='disabled'>Sebelumnya</a>";
        }

        // Tombol halaman
        for ($i = 1; $i <= $total_halaman; $i++) {
            if ($i == $halaman) {
                echo "<a class='active'>" . $i . "</a>";
            } else {
                echo "<a href='?halaman=" . $i . "'>" . $i . "</a>";
            }
        }

        // Tombol "Selanjutnya"
        if ($halaman < $total_halaman) {
            echo "<a href='?halaman=" . ($halaman + 1) . "'>Selanjutnya</a>";
        } else {
            echo "<a class='disabled'>Selanjutnya</a>";
        }
    }
    echo "</div>";

    ?>

</body>


</html>