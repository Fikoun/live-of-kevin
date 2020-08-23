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

?>