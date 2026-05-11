<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Replace with your desired admin credentials or database check
    if ($username === 'admin' && $password === 'password123') {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Be You Salon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Login</h1>

    <?php if($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <label>
            Username:
            <input type="text" name="username" required>
        </label>

        <label>
            Password:
            <input type="password" name="password" required>
        </label>

        <button type="submit">Login</button>
    </form>
</body>
</html>
