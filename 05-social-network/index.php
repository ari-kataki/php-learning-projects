<?php
require_once 'DbConnector.php';
session_start();

if (!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user-id'];
$connection = new DbConnector('localhost', 'root', 'root', 'itsumbria_coding');

$accessStatement = $connection->prepare('SELECT access FROM Users WHERE id = :user_id');
$accessStatement->bindParam(':user_id', $userId);
$accessStatement->execute();
$access = $accessStatement->fetch(PDO::FETCH_ASSOC);

$userStatement = $connection->prepare('SELECT username FROM Users WHERE id = :user_id');
$userStatement->bindParam(':user_id', $userId);
$userStatement->execute();
$currentUser = $userStatement->fetch(PDO::FETCH_ASSOC);

$postsPerPage = 5;
$page = isset($_GET['page']) && ($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $postsPerPage;

$count = $connection->prepare('SELECT COUNT(*) FROM posts WHERE delete_date IS NULL');
$count->execute();
$totalPosts = $count->fetchColumn();
$totalPages = ceil($totalPosts / $postsPerPage);

$statement = $connection->prepare('SELECT posts.id, posts.content, posts.creation_date, Users.username
    FROM posts
    JOIN Users ON posts.user_id = Users.id
    WHERE posts.delete_date IS NULL
    ORDER BY posts.creation_date DESC
    LIMIT :limit OFFSET :offset');
$statement->bindValue(':limit', $postsPerPage, PDO::PARAM_INT);
$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['tokens'] = [];

$_SESSION['tokens'][$page]['post'] = md5(uniqid(rand(), true));

for ($i = 0; $i < count($results); $i++) {
    $postId = $results[$i]['id'];
    $_SESSION['tokens'][$page]['modify_' . $postId] = md5(uniqid(rand(), true));
    $_SESSION['tokens'][$page]['delete_' . $postId] = md5(uniqid(rand(), true));
}
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <span>User: <strong><?= htmlspecialchars($currentUser['username']) ?></strong></span>
        <form method="post" action="logout.php">
            <button class="button.logout">Logout</button>
        </form>
        <h1 class="Header">MeowingCats</h1>
        <h3 class="credit">Powered by ALI</h3>
        <div>
            <form method="post" action="post.php">
                <input type="hidden" name="token" value="<?= $_SESSION['tokens'][$page]['post'] ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <textarea class="textarea" name="message" rows="6" placeholder="What are you thinking about?"></textarea>
                <button class="button">Post</button>
            </form>
        </div>
        <div>
            <?php for ($i = 0; $i < count($results); $i++) { 
                $postId = $results[$i]['id'];
            ?>
                <div class="post">
                    <div class="post-username"><?= htmlspecialchars($results[$i]['username']) ?></div>
                    <div><?= htmlspecialchars($results[$i]['content']) ?></div>
                    <div class="post-datetime"><?= htmlspecialchars($results[$i]['creation_date']) ?></div>
                </div>

                <?php if ($access['access'] === 'moderator' || $access['access'] === 'superadmin') { ?>
                    <div>
                        <form method="post" action="modifyPost.php">
                            <input type="hidden" name="token" value="<?= $_SESSION['tokens'][$page]['modify_' . $postId] ?>"/>
                            <input type="hidden" name="page" value="<?= $page ?>"/>
                            <input type="hidden" name="post_id" value="<?= $postId ?>"/>
                            <textarea class="modifiyarea" name="message" rows="3" placeholder="Modify post"></textarea>
                            <button class="button">Modify</button>
                        </form>
                    </div>
                <?php } ?>

                <?php if ($access['access'] === 'superadmin') { ?>
                    <div>
                        <form method="post" action="deletePost.php">
                            <input type="hidden" name="token" value="<?= $_SESSION['tokens'][$page]['delete_' . $postId] ?>"/>
                            <input type="hidden" name="page" value="<?= $page ?>"/>
                            <input type="hidden" name="post_id" value="<?= $postId ?>"/>
                            <button class="button">Delete</button>
                        </form>
                    </div>
                <?php } ?>

            <?php } ?>
        </div>

        <div class="pagination">
            <?php if ($page > 1) { ?>
                <a href="?page=<?= $page - 1 ?>">Back</a>
            <?php } ?>
            <span>Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages) { ?>
                <a href="?page=<?= $page + 1 ?>">Next</a>
            <?php } ?>
        </div>
        <pre><?php print_r($_SESSION['tokens']); ?></pre>
    </body>
</html>