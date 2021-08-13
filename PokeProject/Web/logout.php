<?php

require_once "../Config/autoload.php";

session_destroy();

header("location: index.php");
die;