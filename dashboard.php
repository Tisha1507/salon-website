<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit;
}
require_once 'config.php';

$pdo = getDB();
$bookings = $pdo->query("SELECT * FROM bookings ORDER BY date DESC, time DESC")->fetchAll();
$services = $pdo->query("SELECT * FROM services ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Be You Salon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p style="text-align:center;"><a href="logout.php">Logout</a></p>

    <!-- Bookings Section -->
    <h2>Bookings</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Date</th><th>Time</th><th>Action</th>
        </tr>
        <?php foreach($bookings as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= htmlspecialchars($b['email']) ?></td>
            <td><?= htmlspecialchars($b['phone']) ?></td>
            <td><?= htmlspecialchars($b['service']) ?></td>
            <td><?= $b['date'] ?></td>
            <td><?= $b['time'] ?></td>
            <td><a href="backend/delete_booking.php?id=<?= $b['id'] ?>" style="color:red;">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Services Section -->
    <h2>Services</h2>
    <p style="text-align:center;"><a href="backend/add_service.php">Add New Service</a></p>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>Action</th>
        </tr>
        <?php foreach($services as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['description']) ?></td>
            <td>$<?= $s['price'] ?></td>
            <td><?= $s['image'] ? "<img src='images/{$s['image']}' width='50'>" : '' ?></td>
            <td>
                <a href="backend/edit_service.php?id=<?= $s['id'] ?>">Edit</a> |
                <a href="backend/delete_service.php?id=<?= $s['id'] ?>" style="color:red;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
