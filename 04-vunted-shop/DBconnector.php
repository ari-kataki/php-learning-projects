<?php
$host = 'localhost';
$db   = 'vuntedd';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) session_start();

function check_login_required() {
    if (!isset($_SESSION['id_utente'])) {
        header('Location: login.php');
        exit();
    }
}
?>
