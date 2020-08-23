<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <link rel="stylesheet" href="styl.css">
        <title>Live Of Kevin</title>
    </head>

    <body>
        <div class="container">
            <!-- Menu se mění na základě přihlášení uživatele -->
            <nav>
                <?php if(isset($_SESSION['logged_user'])) { ?>
                    <!-- přihlášený -->
                    <a href="index.php?page=logout">Logout</a> 
                <?php } else { ?>
                    <!-- nepřihlášený -->
                    <a href="index.php?page=login">Login</a>
                    <a href="index.php?page=register">Register</a>
                <?php } ?>
                <a class="right" href="index.php?page=game">Game</a>
            </nav>

            <!-- Zde začíná obsah stránky -->