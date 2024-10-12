<?php
require_once 'config.php';
require_once 'gudangService.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('Error id tidak ditemukan');

$gudang->delete();
header("Location: index.php");
exit();
?>