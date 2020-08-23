<?php 
require_once 'config.php';

if (isset($_GET['new_answer'])) {
    $part_id = $_GET['new_answer'];

    if (isset($_POST['text']) && isset($_POST['next'])) {
        $text = $_POST['text'];
        $next = $_POST['next'];
        if ($next == 0) {
            spustit_sql($databaze, "INSERT INTO parts (title, text) VALUES ('', '')");
            $new_id = $databaze->insert_id;

            spustit_sql($databaze, "INSERT INTO answers (text, part, next) VALUES ('$text', '$part_id', '$new_id')");
            header('Location: admin.php?edit=' . $new_id);  
        } else {
            spustit_sql($databaze, "INSERT INTO answers (text, part, next) VALUES ('$text', '$part_id', '$next')");
        }
    }
}

if (isset($_GET['update'])) {
    $part_id = $_GET['update'];

    if (isset($_POST['text']) && isset($_POST['title'])) {
        $text = $_POST['text'];
        $title = $_POST['title'];

        spustit_sql($databaze, "UPDATE parts SET text='$text', title='$title' WHERE id=" . $part_id);
    }
}


if (isset($_GET['edit']) && isset($_GET['answer_del'])) {
    $part_id = $_GET['edit'];
    $answer_id = $_GET['answer_del'];

    spustit_sql($databaze, "DELETE FROM answers WHERE id=" . $answer_id); 
}

// hlavička
include_once 'header.php'; ?>

<div class="content">
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
                // Odpověď z databáze
                $answer = spustit_sql($databaze, "SELECT * FROM answers WHERE id=" . $_GET['answer'])[0];
                // Další pozice odpovědi
                $new_position = $answer['next'];
                
                // Uloží novou pozici hráči do databáze -> SAVE
                spustit_sql($databaze, "UPDATE users SET position='$new_position' WHERE id=" . $logged_user['id']);
                $logged_user['position'] = $new_position;
            }

       

            if (isset($_GET['edit'])) {
                // Získání části textu a odpovědi, podle aktuální pozice
                $part = spustit_sql($databaze, "SELECT * FROM parts WHERE id=" . $_GET['edit'])[0];
                $parts = spustit_sql($databaze, "SELECT * FROM parts WHERE id!=" . $_GET['edit']);
                $answers = spustit_sql($databaze, "SELECT * FROM answers WHERE part=" . $_GET['edit']);    
             
            ?>
            <form action="?update=<?= $part['id'] ?>" method="post">

                <!-- Vypsání html - titulek a obsah části  -->
                <i>[ <?= $part['id'] ?> ]</i>
                <h1>
                    <input type="text" name="title" value="<?= $part['title'] ?>" placeholder="Title">
                    <input class="right button" type="submit" value="Save">
                </h1>
                <hr>

                <p> <textarea name="text" style="width:95%; display:block; margin:auto;" rows="10"><?= $part['text'] ?></textarea> </p>
                <hr>

                <!-- Vypsání všech odpovědí cyklem -->
                <div class="answers">
                    <?php foreach($answers as $answer) { ?>
                        <span style="border: 1px solid black; display:inline-block; margin: 5px; padding: 0 10px;"> 
                            <?= $answer['text'] ?>  <a  href="?edit=<?= $part['id'] ?>&answer_del=<?= $answer['id'] ?>">x</a>
                        </span>
                    <?php } ?>
                </div>

            </form>

            <?php } else {
                // Získání části textu a odpovědi, podle aktuální pozice
                $part = spustit_sql($databaze, "SELECT * FROM parts WHERE id=" . $logged_user['position'])[0];
                $parts = spustit_sql($databaze, "SELECT * FROM parts WHERE id!=" . $logged_user['position']);
                $answers = spustit_sql($databaze, "SELECT * FROM answers WHERE part=" . $logged_user['position']);    
            
            ?>

                <!-- Vypsání html - titulek a obsah části  -->
                <i>[ <?= $part['id'] ?> ]</i>
                <h1> 
                    <?= $part['title'] ?>
                    <a class="right button" href="?edit=<?= $part['id'] ?>">Edit</a>
                </h1>
                <hr>

                <p> <?= $part['text'] ?> </p>
                <hr>

                <!-- Vypsání všech odpovědí cyklem -->
                <div class="answers">
                    <?php foreach($answers as $answer) { ?>
                        <a href="?answer=<?= $answer['id'] ?>"> 
                            <?= $answer['text'] ?> ~ <?= $answer['next'] ?>
                        </a>
                    <?php } ?>
                    <?php 
                    if (isset($_GET['new_answer'])) { ?>
                        <form action="?new_answer=<?= $part['id'] ?>" method="post">
                            <input type="text" name="text" placeholder="Answer">
                            <select class="input"  name="next" width="100px">
                                <option value="0">+ New Text</option>
                                <?php foreach ($parts as $part) :?>
                                    <option value="<?= $part['id'] ?>"> <i><?= $part['id'] ?></i> <?= $part['title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="+" class="button" style="background: black; color:white; font-weight: bold;">
                        </form>
                    <?php } else { ?>
                        <a style="background: black; color:white; font-weight: bold;" href="?new_answer=<?= $part['id'] ?>">+</a>
                    <?php } ?>
                </div>

            <?php } ?>

</div>

<?php // patička
    include_once 'footer.php';
?>
