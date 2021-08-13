<?php
require_once "../Config/autoload.php";
$isLoggedIn = check_login();
$action = $_GET["action"];
if ($isLoggedIn == false) {
    if (empty($action)){
        include "login.php";
    }
    elseif ($action == "checkLogin") {
        $isValidUser = validateUser($_POST['signInName'], $_POST['userPassword']);
        if ($isValidUser['success'] == false) {
            $error = $isValidUser['error'];
            include "login.php";
        } else {
            header("location: index.php");
        }
    }
} else {
    if (empty($action)) {
        include "userLists.php";
    } elseif ($action == "updateUser") {
        if(!empty($_POST)){
            $userUpdate = updateUser($_POST['userName'], $_POST['userSurname'], $_POST['userEmail'], $_POST['userPassword']);
            if($userUpdate['success'] == false) {
                $error = $userUpdate['error'];
            }
        }
        include "userForm.php";
    }
}

