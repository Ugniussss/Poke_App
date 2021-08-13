<?php
require "../Config/autoload.php";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $signInName = $_POST['signInName'];
    $userName = $_POST['userName'];
    $userSurname = $_POST['userSurname'];
    $userEmail = $_POST['userEmail'];
    $userPassword = esc($_POST['userPassword']);
    $passwordRepeat = esc($_POST['passwordRepeat']);
    if (!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $userEmail)) {
        $error = "Įveskite teisingą elektroninį paštą: ";
    }
    $arr = false;
    $arr['signInName'] = $signInName;
    $query = "select * from users where signInName = :signInName limit 1";
    $stmt = $connection->prepare($query);
    $check = $stmt->execute($arr);
    if ($check) {
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (is_array($data) && count($data) > 0) {
            $error = "Toks vartotojo vardas jau užimtas";
        }
    }
    if ($error == "") {
        $arr['signInName'] = $signInName;
        $arr['userName'] = $userName;
        $arr['userSurname'] = $userSurname;
        $arr['userEmail'] = $userEmail;
        if ($userPassword !== $passwordRepeat) {
            $error = "Jūsų slaptažodžiai nesutampa";
        }
        if (!preg_match("#[0-9]+#", $userPassword) && !preg_match("#[A-Z]+#", $userPassword)) {
            $error = "Slaptažodis privalo turėti bent viena skaičių ir didžiąją raidę!";
        } else {
            $arr['userPassword'] = $userPassword;
            $query = "insert into users (signInName,userName,userSurname,userEmail,userPassword) values (:signInName,:userName,:userSurname,:userEmail,:userPassword)";
            $stmt = $connection->prepare($query);
            $stmt->execute($arr);
        }
    }
    if ($error == "") {
        header("Location: login.php");
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<?php include "header.php" ?>
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
                    <input class="mdc-text-field__input"  type="text" name="signInName" aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Vardas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="text" name="userName"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Pavardė</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="text" name="userSurname"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>El. paštas</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="email" name="userEmail"  aria-label="Label" required> <br>
                </label>
            </div>
            <div>
                <label>Slaptažodis</label>
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                    <input class="mdc-text-field__input" type="password" name="userPassword"  aria-label="Label" required> <br>
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