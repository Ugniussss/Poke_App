<?php

define('DB_NAME', 'poke_project');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');


$string = "mysql:host=localhost;dbname=poke_project";
$connection = new PDO($string,DB_USER,DB_PASS);
if(!$connection = new PDO($string,DB_USER,DB_PASS))
{
    die("Nepavyko prisijungti");
}

?>