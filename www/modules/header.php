<?php 
    include "functions/user_session.php";

    $userIsLoggedIn = array_key_exists("id", $_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndieWEB</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<header class="header">
    <nav>
        <h1 class="logo">IndieWEB<span>social network for developers</span></h1>
        <?php if ($userIsLoggedIn){echo '<a href="/logout.php" class="button button-ghost">Log out</a>'; } ?>
    </nav>
</header>