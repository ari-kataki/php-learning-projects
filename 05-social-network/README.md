# 05 - social network

A small social wall. Early version of the social media app I did after.

PHP side (this works with MAMP):
- `register.php`, `login.php`, `logout.php`: users with hashed passwords and a session.
- `index.php`: list of posts (5 per page), form to post.
- `post.php`: save a post. `modifyPost.php`: edit (moderator or superadmin). `deletePost.php`: soft delete (superadmin only).
- Every form has a CSRF token saved in the session.
- `hacker.html`: a CSRF test page, it submits a post to `post.php` from another page to see that the token stops it.
- `DbConnector.php`: small class around PDO.

JS side (unfinished): React components for the web (`SocialNetwork.jsx`, `Post.jsx`, `PostForm.jsx`) and for React Native (`App.js`, `PostForm.js`, `PostList.js`, `uI/`). They call an `/api/posts` API that I never wrote and there is no `package.json`, so they don't run on their own. `DeletePost.jsx`, `ModifyPost.jsx` and `Pagination.jsx` are empty files, I started them and never filled them.

Database: `itsumbria_coding`, default MAMP MySQL user. Tables `Users` (id, username, Password, access: user / moderator / superadmin) and `posts` (id, content, user_id, creation_date, delete_date). No SQL dump is included.

Known issues: `index.php` prints the session tokens at the bottom of the page (debug), tokens are made with `md5(uniqid(rand()))`, `$_POST['page']` and `post_id` are used without being checked in `post.php` / `modifyPost.php` / `deletePost.php`. DB password is written in the files.
