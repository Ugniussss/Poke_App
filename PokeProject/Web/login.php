<?php

require_once "../Config/autoload.php";

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $sign_in_name = $_POST['sign_in_name'];
    $user_password = $_POST['user_password'];

    if(empty($sign_in_name) && empty($user_password))
    {
        $error = "Blogi prisijungimo duomenys: ";
    }

    if($error == "")
    {
        $arr['sign_in_name'] = $sign_in_name;
        $arr['user_password'] = $user_password;
        $query = 'select * from users where sign_in_name = :sign_in_name && user_password = :user_password limit 1';
        $stmt = $connection->prepare($query);
        $check = $stmt->execute($arr);
            if($check)
            {
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(is_array($data) && count($data) > 0)
                {
                    $data = $data[0];
                    $_SESSION['user_id'] = $data->user_id;
                    header("Location: index.php");
                    die;
                }
            }
    }
    $error = "Blogi prisijungimo duomenys: ";
}


?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <title>Prisijungimas</title>
    <meta charset="UTF-8">
</head>
<body>
<form method="post">
    <div>
        <?php
        if(isset($error) && $error != "")
        {
            echo $error;
        }
        ?>
    </div>
    <div>
        <input type="text" name="sign_in_name" placeholder="Vartotojo Vardas" required> <br>
        <input type="password" name="user_password" placeholder="Slaptažodis" required> <br>
        <input type="submit" value="Prisijungti">
        <a href="signup.php">Registruotis</a>
    </div>
</form>
</body>
</html>