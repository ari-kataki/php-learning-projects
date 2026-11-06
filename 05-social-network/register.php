<?php
require_once 'DbConnector.php';
session_start();

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    'cost' => 12
];
$username = null;
$password = null;
$password2 = null;
$registerError = false;
$passwordMismatch = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (array_key_exists('username', $_POST)) {
        $username = $_POST['username'];
    }
    if (array_key_exists('password', $_POST)) {
        $password = $_POST['password'];
    }
    if (array_key_exists('password2', $_POST)) {
        $password2 = $_POST['password2'];
    }

    if (empty($username) || empty($password) || empty($password2)) {
        $registerError = true;
    } elseif ($password !== $password2) {
        $passwordMismatch = true;
    } else {
        $connection = new DbConnector('localhost', 'root', 'root', 'itsumbria_coding');
        $statement = $connection->prepare('SELECT * FROM users WHERE username = ?');
        $statement->execute([$username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $registerError = true;
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
            $statement = $connection->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $statement->execute([$username, $hashedPassword]);
            header('Location: login.php');
            exit();
        }
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="login.css" />
    </head>
    <body>
        <div>
            <form method="post">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($username ?? '') ?>" />
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" />
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="password2" />
                </div>
                <?php if ($passwordMismatch) { ?>
                    <span>Passwords do not match</span>
                <?php } ?>
                <?php if ($registerError) { ?>
                    <span>Username already taken or fields are empty</span>
                <?php } ?>
                <div>
                    <button>Register</button>
                </div>
                <div>
                    <a href="login.php"><button type="button">Back to Login</button></a>
                </div>
            </form>
        </div>
    </body>
</html>