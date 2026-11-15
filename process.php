<?php

session_start();

$host = "localhost";
$dbname = "opentra_db";
$dbuser = "root";
$dbpass = "";

try {

    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['username'] = $user['username'];

        header("Location: manage.php");
        exit();

    } else {

        echo "Invalid username or password.";
    }

} catch (PDOException $e) {

    die("Login failed. Please try again.");

}

?>