<?php
require 'DBconnector.php';
check_login_required();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id_prodotto'])) {
    header('Location: homepage.php');
    exit();
}

$id_prodotto = (int)$_POST['id_prodotto'];
$id_acquirente = $_SESSION['id_utente'];

$stmt = $pdo->prepare("
    SELECT p.*, u.username AS venditore
    FROM prodotti p
    JOIN utenti u ON u.id_utente = p.id_venditore
    WHERE p.id_prodotto = ?
");
$stmt->execute([$id_prodotto]);
$prodotto = $stmt->fetch();

if (!$prodotto) {
    die("<p> Prodotto non trovato. <a href='homepage.php'>Torna alla home</a></p>");
}

if ($prodotto['is_sold']) {
    die("<p> Questo prodotto è già stato venduto. <a href='homepage.php'>Torna alla home</a></p>");
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        INSERT INTO vendite (id_prodotto, id_acquirente, data_vendita)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$id_prodotto, $id_acquirente]);

    $pdo->prepare("UPDATE prodotti SET is_sold = 1 WHERE id_prodotto = ?")->execute([$id_prodotto]);

    $pdo->commit();
    $success = true;
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    $success = false;
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="it">
<head><meta charset="UTF-8"><title>Conferma acquisto</title></head>
<body style="font-family:sans-serif;text-align:center;margin-top:50px;">
<?php if ($success): ?>
    <h2> Acquisto completato!</h2>
    <p>Hai acquistato: <strong><?php echo htmlspecialchars($prodotto['titolo']); ?></strong></p>
    <p>Prezzo: €<?php echo number_format($prodotto['prezzo'],2,',','.'); ?></p>
    <p>Venditore: <?php echo htmlspecialchars($prodotto['venditore']); ?></p>
    <p><a href="homepage.php">← Torna alla Homepage</a></p>
<?php else: ?>
    <h2> Errore durante l’acquisto</h2>
    <p><?php echo htmlspecialchars($error); ?></p>
    <p><a href="homepage.php">← Torna alla Homepage</a></p>
<?php endif; ?>
</body>
</html>
