<?php
require_once "DbConnector.php";

$db = new DbConnector("localhost", "root", "", "bacheca");


$sql = "SELECT * FROM  messages ORDER BY date_message DESC LIMIT 0, 10";

$stmt = $db->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
</head>
<body>
    <div>

    </div>
</body>

