<?php
require 'DBconnector.php';

$username_loggato = isset($_SESSION['username']) ? $_SESSION['username'] : null;

$stmt = $pdo->query("SELECT id_prodotto, titolo, prezzo, descrizione, is_sold FROM prodotti ORDER BY id_prodotto DESC");
$prodotti = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VUNTED - Vetrina Usato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="app-header">
    <div class="logo">VUNTED - Vetrina</div>

    <div class="auth-area">
        <?php if ($username_loggato): ?>
            <span class="user-info">Ciao, **<?php echo htmlspecialchars($username_loggato); ?>**</span>
            <a href="logout.php" class="action-button logout-button">Esci</a>
        <?php else: ?>
            <a href="login.php" class="action-button login-button">Accedi</a>
            <a href="registrazione.php" class="action-button register-button">Registrati</a>
        <?php endif; ?>
    </div>
</header>

<div class="content-container">

    <h1 class="page-title">Scopri gli articoli usati disponibili</h1>
    <p class="subtitle">Seleziona e acquista i prodotti che preferisci in modo semplice e sicuro. (<?php echo count($prodotti); ?> articoli trovati)</p>

    <div class="product-grid">
        <?php foreach ($prodotti as $p): ?>
            <div class="card product-card">
                <h3><?php echo htmlspecialchars($p['titolo']); ?></h3>
                <p class="price">€<?php echo number_format($p['prezzo'],2,',','.'); ?></p>

                <p class="description-snippet"><?php echo htmlspecialchars(substr($p['descrizione'], 0, 70)); ?>...</p>

                <?php if ($p['is_sold']): ?>
                    <div class="action-area">
                        <p class="note sold-note">GIÀ VENDUTO</p>
                        <button class="sold-btn" disabled>Non disponibile</button>
                    </div>
                <?php else: ?>
                    <div class="action-area">
                        <a href="dettaglio.php?id=<?php echo $p['id_prodotto']; ?>" class="detail-link">Vedi Dettagli</a>
                        <?php if ($username_loggato): ?>
                            <form action="acquista.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_prodotto" value="<?php echo $p['id_prodotto']; ?>">
                                <button type="submit" class="buy-now-btn">Acquista Ora</button>
                            </form>
                        <?php else: ?>
                            <a href="login.php" class="buy-login-link">Accedi per Acquistare</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>