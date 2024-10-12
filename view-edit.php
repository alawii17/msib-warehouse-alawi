<?php
require_once 'config.php';
require_once 'gudangService.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update()) {
        header("Location: index.php");
    } else {
        echo "Gagal mengubah data Gudang";
    }
} else {
    $stmt = $gudang->show($gudang->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $gudang->name = $data['name'];
    $gudang->location = $data['location'];
    $gudang->capacity = $data['capacity'];
    $gudang->status = $data['status'];
    $gudang->opening_hour = $data['opening_hour'];
    $gudang->closing_hour = $data['closing_hour'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Edit Gudang</h1>

                <form action="view-edit.php?id=<?php echo $gudang->id; ?>" method="post"
                    class="shadow p-4 bg-light rounded">
                    <div class="mb-3">
                        <label for="name">Nama Gudang</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="<?php echo $gudang->name; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location">Lokasi</label>
                        <input type="text" class="form-control" name="location" id="location"
                            value="<?php echo $gudang->location; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity">Kapasitas</label>
                        <input type="number" class="form-control" name="capacity" id="capacity"
                            value="<?php echo $gudang->capacity; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="aktif" <?php echo ($gudang->status == 'aktif') ? 'selected' : ''; ?>>Aktif
                            </option>
                            <option value="tidak_aktif"
                                <?php echo ($gudang->status == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="opening_hour">Waktu Buka</label>
                        <input type="time" class="form-control" name="opening_hour" id="opening_hour"
                            value="<?php echo $gudang->opening_hour; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="closing_hour">Waktu Tutup</label>
                        <input type="time" class="form-control" name="closing_hour" id="closing_hour"
                            value="<?php echo $gudang->closing_hour; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Edit</button>
                </form>

                <div class="flex-start mt-3">
                    <a href="index.php" class="btn btn-danger mb-5">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>