# 04 - Vunted shop

A small second-hand shop in Italian.

- `registrazione.php`, `login.php`, `logout.php`: user registration and login (password with `password_hash`, session).
- `homepage.php`: product list, the buy button is shown only to logged users.
- `dettaglio.php`: product detail.
- `acquista.php`: buys a product (insert in `vendite` and set `is_sold`, in a transaction).
- `DBconnector.php`: PDO connection and `check_login_required()`.

Stack: PHP, PDO, MySQL, CSS. Run from MAMP.

Database: `vuntedd`, user `root`, empty password (MAMP). Tables used: `Utenti` (id_utente, username, email, password_hash), `prodotti` (id_prodotto, titolo, descrizione, prezzo, stato, is_sold, id_venditore, id_categoria), `categorie` (id_categoria, nome), `vendite`. No SQL dump is included.

Known issues: the table names are written with different capital letters (`Utenti` / `utenti`), it works on MAMP for macOS but not on a Linux MySQL. DB error messages are shown on the page.
