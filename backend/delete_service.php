<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: ../admin.php'); exit; }
require_once '../config.php';
$pdo = getDB();

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id=?");
    $stmt->execute([$id]);
}

header('Location: ../dashboard.php');
exit;
?>
