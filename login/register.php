<?php

// Kontrola vyplněných polí formuláře
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_check']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    if ($password === $password_check) { // Když hesla sedí, vloží uživatele do databaze
        spustit_sql($databaze, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "<i class='info'>Registered. You can login...</i>";
    } else {
        echo "<i class='warning'>Hesla neodpovídají!</i>";
    }
    
}

?>

<h1>Registrace</h1>
<form action="?page=register" method="POST">
    Username: <input type="text" name="username"> <br>
    Password: <input type="password" name="password"> <br>
    Password (again): <input type="password" name="password_check"> <br>

    <input class="button" type="submit" value="Register">
</form>