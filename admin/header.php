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
    <link rel="stylesheet" href=<?php echo url_for('/stylesheets/main.css?v=2'); ?>>
</head>

<body>
<header>
    <h1><a href="index.php"> &#x1F47E;	Chat KwAI Admin Panel &#x1F47E;	</a></h1>
</header>
<nav id="back">
    <ul>
        <li><a href="index.php">&lArr; Back to Main Menu</a></li>
    </ul>
</nav>
