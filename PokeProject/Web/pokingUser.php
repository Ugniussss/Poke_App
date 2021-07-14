<?php

    require_once "../Config/autoload.php";

if (isset($_GET['user_poke_number'])) {

        $stmt = $connection->prepare("UPDATE users SET user_poke_number = user_poke_number + 1 WHERE user_id = '$_GET[user_id]'");
        $stmt->execute();

}
else {
    exit('Klaida');
}
