<?php
// Započetí SESSION - pro pamatování si přihlášeného uživatele
session_start();

//  DATABÁZE

$host     = "localhost";
$username = "root";
$password = "root";
$database = "live_of_kevin";

// Připojení do databáze
$databaze = new mysqli($host, $username, $password, $database);

// Zkontrolujeme chybu připojování
if ($db->connect_errno) {
    echo("chyba v databázi: " . $db->connect_error); 
    die();
}

// Zjednodušené spuštění SQL dotazu
function spustit_sql($db, $sql) {
    $result = $db->query($sql); 
    if ($result === false) { // V případě chyby vypíše ji a skončí
        echo($db->error . " - chyba v dotazu: " . $sql); 
        die();
    }else if ($result === true){ 
        return;
    }else {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}




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