<?php
require 'DBconnector.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $message = "Tutti i campi sono obbligatori!";
    } elseif (strlen($password) < 6) {
        $message = "La password deve contenere almeno 6 caratteri.";
    } else {
        try {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO Utenti (username, email, password_hash) VALUES (:username, :email, :password_hash)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->execute();

            $message = "Registrazione completata con successo! Ora puoi effettuare il login.";
            header("Location: login.php?success=1");
            exit();

        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) { // Codice errore per violazione UNIQUE (username/email già esistente)
                $message = "Errore: Username o Email già utilizzati.";
            } else {
                $message = "Errore DB durante la registrazione: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione Utente</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
<div class="form-container">
    <h1>Registrati a VUNTED</h1>

    <?php if ($message): ?>
        <div class="<?php echo (strpos($message, 'success') !== false || strpos($message, 'completata') !== false) ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form action="registrazione.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="register-button">Registra</button>
    </form>
    <p style="text-align: center; margin-top: 15px;"><a href="login.php">Hai già un account? Accedi qui.</a></p>
</div>
</body>
</html>
