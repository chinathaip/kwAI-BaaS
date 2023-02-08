<?php
ini_set('display_errors', 1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php
    $page_title = $page_title ?? 'Admin Panel';
    echo "<title>" . $page_title . "</title>"; ?>
    <link rel="stylesheet" href=<?php echo url_for('/stylesheets/main.css?v=3'); ?>>
</head>

<body>
<header>
    <h1>Chat KwAI Admin Panel</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Back to Main Menu</a></li>
    </ul>
</nav>
