<?php
require_once '../config.php';
$pdo = getDB();
$services = $pdo->query("SELECT * FROM services ORDER BY name ASC")->fetchAll();
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if ($name && $email && $phone && $service && $date && $time) {
        $stmt = $pdo->prepare("INSERT INTO bookings (name, email, phone, service, date, time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $service, $date, $time]);
        $success = "Booking submitted successfully!";
    } else {
        $success = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Be You Salon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Be You Salon</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="booking.php">Book Appointment</a> |
        <a href="services.php">Services</a> |
        <a href="contact.php">Contact</a>
    </nav>
</header>

<main>
    <h2>Book Your Appointment</h2>
    <?php if($success) echo "<p class='success'>$success</p>"; ?>
    <form method="POST">
        <label>Name:<input type="text" name="name" required></label>
        <label>Email:<input type="email" name="email" required></label>
        <label>Phone:<input type="text" name="phone" required></label>
        <label>Service:
            <select name="service" required>
                <option value="">Select a service</option>
                <?php foreach($services as $s): ?>
                    <option value="<?= htmlspecialchars($s['name']) ?>"><?= htmlspecialchars($s['name']) ?> - $<?= $s['price'] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Date:<input type="date" name="date" required min="<?= date('Y-m-d') ?>"></label>
        <label>Time:<input type="time" name="time" required></label>
        <button type="submit">Book Now</button>
    </form>
</main>

<footer>
    <p>&copy; 2025 Be You Salon</p>
</footer>
</body>
</html>
