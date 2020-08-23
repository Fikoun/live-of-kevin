<?php

// Kontrola vyplněných polí formuláře
if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hledá uživatele se stejným jmenem a heslem 
    $result = spustit_sql($databaze, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (count($result)) {
        // Když najde uživatele uloží ho do SESSION a vypíše hlášku
        $_SESSION['logged_user'] = $result[0]['id'];
        echo "<i class='info'>You are now logged motherfucker</i>";
    } else {
        // Když nenajde uživatele vypíše chybovou hlášku
        echo "<i class='warning'>*Bad code motherfucker</i>";
    }
}

?>

<h1>Login</h1>
<form action="?page=login" method="POST">
    Username: <input type="text" name="username"> <br>
    Password: <input type="password" name="password"> <br>

    <input class="button" type="submit" value="Login">
</form>