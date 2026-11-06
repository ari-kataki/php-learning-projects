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

if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['tokens'][$page]['post']) {
    header('Location: index.php');
    exit;
}

if (empty(trim($_POST['message']))) {
    header('Location: index.php');
    exit;
}

$connection = new DbConnector('localhost', 'root', 'root', 'itsumbria_coding');

$statement = $connection->prepare('INSERT INTO posts (content, user_id, creation_date) VALUES (:content, :user_id, NOW())');
$statement->bindParam(':content', $_POST['message']);
$statement->bindParam(':user_id', $_SESSION['user-id']);
$statement->execute();

header('Location: index.php?page=' . $page);
exit;