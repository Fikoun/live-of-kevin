<?php

require_once 'config.php';

//  SKLÁDÁNÍ STRÁNKY

if (!isset($_GET['page']))
    $_GET['page'] = "";

// Router  
switch($_GET['page'])
{
    case 'login': // Přihlášení
        $route = 'login/login.php';
    break;

    case 'register': // Registrace
        $route = 'login/register.php';  
    break;

    case 'logout': // Logout - zničí SESSION a odkáže na login
        session_unset();
        session_destroy();
        header("Location: ?page=login");
    break;

    case 'game': // Hra
        $route = 'game/game.php';  
    break;

    default: // Výchozí stránka
        $route = 'default.php';
    break;
}

// hlavička
include_once 'header.php'; ?>

<div class="content">

    <?php  // Obsah stránky
        include_once $route;
    ?>
    
</div>

<?php // patička
    include_once 'footer.php';
?>