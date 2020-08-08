<?php 
// Pokud není přihlášený ukončí s hláškou: Login first..!
if (isset($_SESSION['logged_user'])) {
    $result = spustit_sql($databaze, "SELECT * FROM users WHERE id=". $_SESSION['logged_user']);
    if (count($result) === 0) { // Pokud id neexistuje vypíše hlášku a skončí
        echo "<h3 class='warning' >Login first..!</h3>";
        die();
    } else { // Jinak vytáhne uživatele a uloží si ho
        $logged_user = $result[0];
    }
} else { // Pokud není uložená SESSION vypíše hlášku a skončí
    echo "<h3 class='warning' >Login first..!</h3>";
    die();
}

// V případě stisknuté odpovědi posune hráče v příběhu dál
if (isset($_GET['answer'])) {
    // Nová pozice podle stisklé odpovědi
    $new_position = spustit_sql($databaze, "SELECT * FROM answers WHERE id=" . $_GET['answer'])[0]['next'];
    // Uloží novou pozici hráči do databáze -> SAVE
    spustit_sql($databaze, "UPDATE users SET position='$new_position' WHERE id=" . $logged_user['id'])[0];
    
    $logged_user['position'] = $new_position;
}

// Získání další části a odpovědi, podle aktuální pozice
$part = spustit_sql($databaze, "SELECT * FROM parts WHERE id=" . $logged_user['position'])[0];
$answers = spustit_sql($databaze, "SELECT * FROM answers WHERE part=" . $logged_user['position']);

?>

<!-- Vypsání html - titulek a obsah části  -->
<h1> <?= $part['title'] ?> </h1>
<hr>

<p> <?= $part['text'] ?> </p>
<hr>

<!-- Vypsání všech odpovědí foreachem -->
<div class="answers">
    <?php foreach($answers as $answer) { ?>
        <a href="?page=game&answer=<?= $answer['id'] ?>"> 
            <?= $answer['text'] ?>
        </a>
    <?php } ?>
</div>