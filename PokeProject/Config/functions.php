<?php
function esc($word): string
{
    return addslashes($word);
}
function check_login()
{
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
       return true;
    }
    return false;
}
function validateUser($userName, $password)
{
    GLOBAL $connection;
    $signInName = $userName;
    $userPassword = $password;
    if (empty($signInName) && empty($userPassword )) {
        return ['success' => false, 'error' => "Blogi prisijungimo duomenys: "];
    }
    $arr['signInName'] = $signInName;
    $arr['userPassword'] = $userPassword;
    $query = 'select * from users where signInName = :signInName && userPassword = :userPassword limit 1';
    $stmt = $connection->prepare($query);
    $check = $stmt->execute($arr);
    if ($check) {
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (is_array($data) && count($data) > 0) {
            $data = $data[0];
            $_SESSION['userId'] = $data->userId;
            $_SESSION["loggedIn"] = true;
            return ['success' => true];
        }
    }
    return ['success' => false, 'error' => "Blogi prisijungimo duomenys: "];

}
function updateUser($name, $surname, $email, $password)
{
    GLOBAL $connection;
    $userName = $name;
    $userSurname = $surname;
    $userEmail = $email;
    $userPassword = esc($password);
    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $userEmail)) {
            return ['success' => false, 'error' => "Įveskite teisingą elektroninį paštą: "];
    }
    if (!preg_match("#[0-9]+#", $userPassword) && !preg_match("#[A-Z]+#", $userPassword)) {
            return ['success' => false, 'error' => "Slaptažodis privalo turėti bent viena skaičių ir didžiąją raidę! "];
    }
    $stmt = $connection->prepare('UPDATE users SET userName =:userName, userSurname =:userSurname, userEmail =:userEmail, userPassword =:userPassword WHERE userId =:userId');
    $stmt->execute(array(":userName"=>$userName, ":userSurname"=>$userSurname,":userEmail"=>$userEmail,":userPassword"=>$userPassword, ":userId"=>$_SESSION['userId']));
    if($stmt->execute()) {
        return ['success' => true];
    }
}
