# PHP learning projects

Everything I wrote while learning PHP at the ITS course, from the first form exercises to a small social wall with logins and roles. Folders are numbered in the order I would read them (easiest first). Dates are the last-modified dates of the files, so treat them as approximate.

| Folder | What it is | Approx. date | What I was learning |
|---|---|---|---|
| [01-phplearning](01-phplearning) | Phone dialer made with a form and PHP, plus a form test page and a file of PHP syntax notes | Feb 2026 | `$_POST`, forms, basic PHP and JS, first CSS |
| [02-mini-exercises](02-mini-exercises) | Three small pages: a Televideo page viewer, an insurance quote form, a calculator | Feb 2026 | Functions in separate files, validating input, small JS helpers |
| [04-vunted-shop](04-vunted-shop) | Small second-hand shop: register, login, product list and detail, buy | Oct 2025 | Sessions, `password_hash`, prepared statements, a transaction |
| [05-social-network](05-social-network) | Social wall in PHP (login, posts, roles, pagination, CSRF tokens) plus unfinished React / React Native components | Mar - May 2026 | Roles, CSRF tokens, soft delete, a first look at React |

The order is by difficulty, not by date: 04 has an earlier file date than 01-03 (the file date may just be when I copied it), but it needs a database, sessions and logins, so I put it after the pages that only use forms.

## Running them

All of them are plain PHP, written for MAMP (Apache + MySQL on the default MAMP ports). Copy a folder into `htdocs` and open it in the browser. 03, 04 and 05 need a MySQL database, the table names are in each folder's README (there are no SQL dumps). The database connections use the local MAMP defaults (the default MAMP MySQL user), change them if yours are different.

## Notes

These are learning exercises, not finished software. Some of them have deliberate or accidental insecure code (SQL built with string concatenation in 03, debug output in 05). Each folder README lists them under "Known issues". I left them as they were.

## Known issues

- Database connection details (the MAMP default user, with the default or an empty password) are written directly in the PHP files of 03, 04 and 05.
- 03 builds some SQL with string concatenation and 05 prints its session tokens at the bottom of `index.php` (debug). Details are in the folder READMEs.
- Some pages print user input without `htmlspecialchars`.

There is no folder 03 on purpose: it was a mockup of an official document, so I left it out of the repo.
