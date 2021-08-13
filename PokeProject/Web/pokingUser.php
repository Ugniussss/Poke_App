<?php

    require_once "../Config/autoload.php";

if (isset($_GET['userPokeNumber'])) {

        $stmt = $connection->prepare("UPDATE users SET userPokeNumber = userPokeNumber + 1 WHERE userId = '$_GET[userId]'");
        $stmt->execute();
} else {
    exit('Klaida');
}
