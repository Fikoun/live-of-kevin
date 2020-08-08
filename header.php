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
                    <a href="?page=logout">Logout</a> 
                <?php } else { ?>
                    <!-- nepřihlášený -->
                    <a href="?page=login">Login</a>
                    <a href="?page=register">Register</a>
                <?php } ?>
                <a class="right" href="?page=game">Game</a>
            </nav>

            <!-- Zde začíná obsah stránky -->