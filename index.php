<?php
require_once "config.php";
require_once "gudangService.php";

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

$stmt = $gudang->read();
$num = $stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Gudang MSIB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-center fw-bold">Daftar Gudang</h1>
            <a href="view-create.php" class="btn btn-primary">Tambah Gudang</a>
        </div>

        <?php
        if ($num > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped table-bordered">';
            echo '<thead class="table-dark">';
            echo '<th>ID</th><th>Nama Gudang</th><th>Lokasi</th><th>Kapasitas</th><th>Status</th><th>Waktu Buka</th><th>Waktu Tutup</th><th>Aksi</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo '<tr>';
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$location}</td>";
                echo "<td>{$capacity}</td>";
                echo "<td>{$status}</td>";
                echo "<td>{$opening_hour}</td>";
                echo "<td>{$closing_hour}</td>";
                echo "<td>";
                echo "<a href='view-edit.php?id={$id}' class='btn btn-warning btn-sm me-2'>Edit</a>";
                echo "<a href='delete.php?id={$id}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus Data ini?\")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "<p class='alert alert-info text-center'>Tidak ada data Gudang</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>