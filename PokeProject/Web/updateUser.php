<?php
require "../Config/autoload.php";

//check_login($connection);
/*
$error = "";

if(isset($_SESSION['user_id']))
{
    if (!empty($_POST)) {
        $user_id = $_SESSION['user_id'];
        $sign_in_name = $_POST['sign_in_name'];
        $user_name = $_POST['user_name'];
        $user_surname = $_POST['user_surname'];
        $user_email = $_POST['user_email'];
        $user_password = esc($_POST['user_password']);
        if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user_email))
        {
            $error = "Įveskite teisingą elektroninį paštą: ";
        }
        if (!preg_match("#[0-9]+#", $user_password) && !preg_match("#[A-Z]+#", $user_password))
        {
            $error = "Slaptažodis privalo turėti bent viena skaičių ir didžiąją raidę!";
        }
        if($error == "")
        {
            $stmt = $connection->prepare('UPDATE users SET user_name =:user_name, user_surname =:user_surname, user_email =:user_email, user_password =:user_password WHERE user_id =:user_id ');
            $stmt->execute(array(":user_name"=>$user_name, ":user_surname"=>$user_surname,":user_email"=>$user_email,":user_password"=>$user_password, ":user_id"=>$user_id));
            if( $stmt->execute()){
                header("location: index.php");
            }

  }
    }
    $stmt = $connection->prepare('SELECT * FROM users WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Toks vartotojas su tokiu id neegzistuoja');
    }
}
else {
    exit('Klaida');
}



?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Style/PokeStyle.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <title>Redagavimas</title>
</head>
<header class="mdc-top-app-bar mdc-top-app-bar--short">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" style="font-size: 15px; white-space: nowrap;">BAKSNOTOJAS 2000</button>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href=""><img src="Images/hand-point-right-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="updateUser.php?id=<?=$_SESSION['user_id']?>"><img src="Images/user-circle-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="logout.php"><img src="Images/sign-out-alt-solid.png"></a></button>
        </section>
    </div>
</header>
<body>
<form action="updateUser.php?id=<?=$contact['user_id']?>" method="post">
    <div><?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?></div>
<div class="main">
    <h1 id="header-3">PROFILIO REDAGAVIMAS</h1>
    <div>
        <label>Prisijungimo vardas</label>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
            <input type="text"  class="mdc-text-field__input" aria-label="Label" value="<?=$contact['sign_in_name']?>" readonly>
        </label>
    </div>
    <div>
        <label>Vardas</label>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
            <input type="text" class="mdc-text-field__input" name="user_name" aria-label="Label" value="<?=$contact['user_name']?>" required> <br>
        </label>
    </div>
    <div>
        <label>Pavardė</label>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
            <input type="text" class="mdc-text-field__input" aria-label="Label" name="user_surname" value="<?=$contact['user_surname']?>" required> <br>
        </label>
    </div>
    <div>
        <label>El. paštas</label>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
            <input class="mdc-text-field__input" aria-label="Label" type="email" name="user_email" value="<?=$contact['user_email']?>" required> <br>
        </label>
    </div>
    <div>
        <label>Slaptažodis</label>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
            <input class="mdc-text-field__input" aria-label="Label" type="password" name="user_password" value="<?=$contact['user_password']?>" required> <br>
        </label>
    </div>
    <button class="mdc-button mdc-button--raised" style="background-color: dodgerblue;margin-left: 300px; margin-top: 35px;">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label" style="text-align: right; width: 120px;">Atnaujinti &nbsp;&nbsp;&nbsp;></span>
    </button>
</form>
</div>
</body>
</html>
*/