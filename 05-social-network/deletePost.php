<?php
require_once 'DbConnector.php';
session_start();

if (!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$page = $_POST['page'];
$postId = $_POST['post_id'];

if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['tokens'][$page]['delete_' . $postId]) {
    header('Location: index.php');
    exit;
}

$connection = new DbConnector('localhost', 'root', 'root', 'itsumbria_coding');

$accessStatement = $connection->prepare('SELECT access FROM Users WHERE id = :user_id');
$accessStatement->bindParam(':user_id', $_SESSION['user-id']);
$accessStatement->execute();
$access = $accessStatement->fetch(PDO::FETCH_ASSOC);

if ($access['access'] !== 'superadmin') {
    header('Location: index.php');
    exit;
}

$statement = $connection->prepare('UPDATE posts SET delete_date = NOW() WHERE id = :post_id AND delete_date IS NULL');
$statement->bindParam(':post_id', $postId);
$statement->execute();

header('Location: index.php?page=' . $page);
exit;