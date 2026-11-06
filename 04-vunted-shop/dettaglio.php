<?php
require 'DBconnector.php';

$username_loggato = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) die("ID Prodotto non valido");
$id = (int)$_GET['id'];

$stmt = $pdo->prepare("
    SELECT p.*, u.username AS venditore, c.nome AS categoria
    FROM prodotti p
    JOIN utenti u ON u.id_utente = p.id_venditore
    JOIN categorie c ON c.id_categoria = p.id_categoria
    WHERE p.id_prodotto = ? AND p.is_sold = 0
");
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) die("Prodotto non trovato o già venduto");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($p['titolo']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <p><a href="homepage.php">← Torna alla lista prodotti</a></p>

    <h2><?php echo htmlspecialchars($p['titolo']); ?></h2>
    <p><strong>Categoria:</strong> <?php echo htmlspecialchars($p['categoria']); ?></p>
    <p><strong>Prezzo:</strong> €<?php echo number_format($p['prezzo'],2,',','.'); ?></p>
    <p><strong>Venditore:</strong> <?php echo htmlspecialchars($p['venditore']); ?></p>
    <p><strong>Stato:</strong> <?php echo htmlspecialchars($p['stato']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($p['descrizione'])); ?></p>

    <?php if ($username_loggato): ?>
        <form action="acquista.php" method="POST">
            <input type="hidden" name="id_prodotto" value="<?php echo $p['id_prodotto']; ?>">
            <button type="submit" class="buy-btn">
                Paga e Acquista Subito (€<?php echo number_format($p['prezzo'],2,',','.'); ?>) 🛒
            </button>
        </form>
    <?php else: ?>
        <p><a href="login.php" class="buy-login-link">Accedi per Acquistare</a></p>
    <?php endif; ?>

</div>
</body>
</html>