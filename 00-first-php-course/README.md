# 00 - first php course

The very first PHP code I wrote at the course (Sep 2025), the start of a message board ("bacheca"). It was never finished.

- `login.php`: a small login form and the first try at checking a user with a prepared statement and `password_hash`.
- `messages.php`: connects to the database and reads the last 10 messages, the page body is still empty.
- `messages.html` and `bacheca.php`: empty HTML pages, only the default template of the editor.

Stack: PHP, PDO, MySQL. Meant for MAMP.

Both PHP files use a `DbConnector` class with `new DbConnector("localhost", "root", "root", "bacheca")`. That file was not saved with these exercises (a later version of the same class is in `05-social-network`). The user `root` with password `root` (or empty) is just the MAMP default.

Known issues: it does not run as it is. `login.php` uses `$statement` without ever creating it, reads `$_POST['nickname']` while the form field is called `username`, hashes the password again instead of using `password_verify`, runs the query even when the form was not sent, and prints the password back on the page. It also has a `password_hash` test line left at the end. I kept it because it shows where I started.
