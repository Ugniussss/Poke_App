<?php

require_once "../Config/autoload.php";

if(isset($_SESSION['user_id'])) {

    unset($_SESSION['user_id']);
}

header("location: index.php");
die;