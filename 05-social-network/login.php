<?php
require_once 'DbConnector.php';
session_start();

$username = null;
$password = null;
$loginError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (array_key_exists('username', $_POST)) {
        $username = $_POST['username'];
    }
    if (array_key_exists('password', $_POST)) {
        $password = $_POST['password'];
    }

    if (empty($username) || empty($password)) {
        $loginError = true;
    } else {
        $connection = new DbConnector('localhost', 'root', 'root', 'itsumbria_coding');
        $statement = $connection->prepare('SELECT * FROM Users WHERE username = :username');
        $statement->execute([':username' => $username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['Password'])) {
            //setcookie('login', $user['username']);
            $_SESSION['user-id'] = $user['id'];
            header('Location: index.php');
            exit();
        } else {
            $loginError = true;
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
                <?php if ($loginError) { ?>
                    <span>username o password not valid0</span>
                <?php } ?>
                <div>
                    <button>Login</button>
                </div>
                <div>
                    <a href="register.php"><button type="button">Register</button></a>
                </div>
            </form>
        </div>
    </body>
</html>