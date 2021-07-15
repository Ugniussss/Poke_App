<?php
require "../Config/autoload.php";

check_login($connection);
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
    <title>Redagavimas</title>
</head>
<body>
<form action="updateUser.php?id=<?=$contact['user_id']?>" method="post">
    <div><?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?></div>
    <div>Profilio redagavimas</div>
    <div>
        <label>Prisijungimo vardas</label>
        <input type="text" value="<?=$contact['sign_in_name']?>" readonly>
    </div>
    <div>
        <label>Vardas</label>
        <input type="text" name="user_name" value="<?=$contact['user_name']?>" required> <br>
    </div>
    <div>
        <label>Pavardė</label>
        <input type="text" name="user_surname" value="<?=$contact['user_surname']?>" required> <br>
    </div>
    <div>
        <label>El. paštas</label>
        <input type="email" name="user_email" value="<?=$contact['user_email']?>" required> <br>
    </div>
    <div>
        <label>Slaptažodis</label>
        <input type="password" name="user_password" value="<?=$contact['user_password']?>" required> <br>
    </div>
    <input type="submit" value="Atnaujinti">
</form>
</body>
</html>
