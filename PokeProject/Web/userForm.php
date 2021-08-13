<?php
$stmt = $connection->prepare('SELECT * FROM users WHERE userId = ?');
$stmt->execute([$_SESSION['userId']]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<form action="index.php?action=updateUser" method="post">
    <div class="main">
        <div><?php
            if(isset($error) && $error != "")
            {
                echo $error;
            }
            ?></div>
        <h1 id="header-3">PROFILIO REDAGAVIMAS</h1>
        <div>
            <label>Prisijungimo vardas</label>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input type="text"  class="mdc-text-field__input" aria-label="Label" value="<?=$contact['signInName']?>" readonly>
            </label>
        </div>
        <div>
            <label>Vardas</label>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input type="text" class="mdc-text-field__input" name="userName" aria-label="Label" value="<?=$contact['userName']?>" required> <br>
            </label>
        </div>
        <div>
            <label>Pavardė</label>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input type="text" class="mdc-text-field__input" aria-label="Label" name="userSurname" value="<?=$contact['userSurname']?>" required> <br>
            </label>
        </div>
        <div>
            <label>El. paštas</label>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" aria-label="Label" type="email" name="userEmail" value="<?=$contact['userEmail']?>" required> <br>
            </label>
        </div>
        <div>
            <label>Slaptažodis</label>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" style="height: 35px; width: 250px;">
                <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" aria-label="Label" type="password" name="userPassword" value="<?=$contact['userPassword']?>" required> <br>
            </label>
        </div>
        <button class="mdc-button mdc-button--raised" style="background-color: dodgerblue;margin-left: 300px; margin-top: 35px;">
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__label" style="text-align: right; width: 120px;">Atnaujinti &nbsp;&nbsp;&nbsp;></span>
        </button>
</form>