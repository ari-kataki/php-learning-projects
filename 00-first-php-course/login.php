<html>
    <body>
        <form method="post" action="">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
        <button type="submit">Invia</button>
        </form>
    </body>
</html>

<?php
require_once "DbConnector.php";

$db = new DbConnector("localhost", "root", "root", "bacheca");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Username: " . $_POST['username'];
    echo "Password: " . $_POST['password'];
}

$query = 'SELECT * FROM users WHERE username = :username AND password = :password';

$statement->bindParam('username', $_POST['nickname']);
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
$statement->bindParam('password', $hash);

$options = [
        'cost' => 12,
];
echo password_hash("password123", PASSWORD_BCRYPT, $options);
?>