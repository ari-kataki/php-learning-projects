<?php
require 'DBconnector.php';

$message = '';

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Registrazione completata! Effettua il login.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Inserisci username e password.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id_utente, username, password_hash FROM Utenti WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['id_utente'] = $user['id_utente'];
                $_SESSION['username'] = $user['username'];

                header('Location: homepage.php');
                exit();
            } else {
                $message = "Credenziali non valide.";
            }

        } catch (\PDOException $e) {
            $message = "Errore DB durante il login: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login Utente</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
<div class="form-container">
    <h1>Accedi a VUNTED</h1>

    <?php if ($message): ?>
        <div class="<?php echo (strpos($message, 'completata') !== false) ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="login-button">Accedi</button>
    </form>
    <p style="text-align: center; margin-top: 15px;"><a href="registrazione.php">Non hai un account? Registrati.</a></p>
</div>
</body>
</html>