<?php

require_once "../Config/autoload.php";

?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Style/PokeStyle.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <title>Prisijungimas</title>
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
<div class="main" style="height: 350px;">
<form method="post" action="index.php?action=checkLogin">
    <div>
        <?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?>
    </div>
    <div id="header-2">PRISIJUNGIMAS</div>
    <div>
        <div>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 350px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input"  type="text" name="signInName" aria-label="Label" placeholder="Vartotojo Vardas" required> <br>
            </label>
        </div>
        <div>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 350px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input"  type="password" name="userPassword" aria-label="Label" placeholder="Slaptažodis" required> <br>
            </label>
        </div>
    </div>
    <button class="mdc-button mdc-button--raised" style="background-color: forestgreen; margin-left: 50px; margin-top: 30px">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label" style="text-align: center; width: 120px;">Prisijungti</span>
    </button>
</form>
    <button class="mdc-button mdc-button--raised" style="background-color: dodgerblue; margin-left: 250px; margin-top: -36px; text-transform: none; color: white">

        <a href="signup.php">Registruotis &nbsp;&nbsp;></a>
    </button>
</div>
</body>
</html>