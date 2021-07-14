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
    <title>Registracija</title>
</head>
<body>
<form method="post">
    <div><?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?></div>
        <div>REGISTRACIJA</div>
            <div>
                <label>Prisijungimo vardas</label>
                <input type="text" name="sign_in_name" required> <br>
            </div>
            <div>
                <label>Vardas</label>
                <input type="text" name="user_name" required> <br>
            </div>
            <div>
                <label>Pavardė</label>
                <input type="text" name="user_surname" required> <br>
            </div>
            <div>
                <label>El. paštas</label>
                <input type="email" name="user_email" required> <br>
            </div>
            <div>
                <label>Slaptažodis</label>
                <input type="password" name="user_password" required> <br>
            </div>
            <div>
                <label>Slaptažodžio pakartojimas</label>
                <input type="password" name="passwordRepeat" required><br><br>
            </div>
        <input type="submit" value="Saugoti">
        <a href="login.php">Jau esate uzsiregistrave?</a>
</form>
</body>
</html>