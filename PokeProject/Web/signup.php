<?php
require "../Config/autoload.php";

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $sign_in_name = $_POST['sign_in_name'];
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];
    $user_email = $_POST['user_email'];
    $user_password = esc($_POST['user_password']);
    $passwordRepeat = esc($_POST['passwordRepeat']);

    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user_email))
    {
        $Error = "Įveskite teisingą elektroninį paštą: ";
    }
    $arr = false;
    $arr['sign_in_name'] = $sign_in_name;
    $query = "select * from users where sign_in_name = :sign_in_name limit 1";
    $stmt = $connection->prepare($query);
    $check = $stmt->execute($arr);
    if($check)
    {
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(is_array($data) && count($data) > 0)
        {
            $error = "Toks vartotojo vardas jau užimtas";
        }
    }
    if($error == "") {

        $arr['sign_in_name'] = $sign_in_name;
        $arr['user_name'] = $user_name;
        $arr['user_surname'] = $user_surname;
        $arr['user_email'] = $user_email;

        if($user_password !== $passwordRepeat){
            $error = "Jūsų slaptažodžiai nesutampa";
        }
        if (!preg_match("#[0-9]+#", $user_password) && !preg_match("#[A-Z]+#", $user_password)) {
            $error = "Slaptažodis privalo turėti bent viena skaičių ir didžiąją raidę!";
        }

        else{
            $arr['user_password'] = $user_password;
            $query = "insert into users (sign_in_name,user_name,user_surname,user_email,user_password) values (:sign_in_name,:user_name,:user_surname,:user_email,:user_password)";
            $stmt = $connection->prepare($query);
            $stmt->execute($arr);
        }

    }
    if($error == "")
    {
        header("Location: login.php");
        die;
    }

}





?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="Style/PokeStyle.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>
<header class="mdc-top-app-bar mdc-top-app-bar--short">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" style="font-size: 15px; white-space: nowrap;">BAKSNOTOJAS 2000</button>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href=""><img src="Images/hand-point-right-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="updateUser.php"><img src="Images/user-circle-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="logout.php"><img src="Images/sign-out-alt-solid.png"></a></button>
        </section>
    </div>
</header>
<body>
<div class="main">
<form method="post">
    <div><?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?></div>
        <div id="header-1">REGISTRACIJA</div>
            <div>
                <label>Prisijungimo vardas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input"  type="text" name="sign_in_name" aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Vardas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="text" name="user_name"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Pavardė</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="text" name="user_surname"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>El. paštas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="email" name="user_email"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Slaptažodis</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="password" name="user_password"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Slaptažodžio pakartojimas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="password" name="passwordRepeat"  aria-label="Label" required> <br>
                </label>
            </div>
        <button class="mdc-button mdc-button--raised" style="background-color: dodgerblue;margin-left: 300px; margin-top: 35px;">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label" style="text-align: right; width: 120px;">Saugoti &nbsp;&nbsp;&nbsp;></span>
        </button>
</form>
</div>
</body>
</html>