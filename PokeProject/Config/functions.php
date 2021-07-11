<?php

function esc($word): string
{
    return addslashes($word);
}
function check_login($connection)
{
    if(isset($_SESSION['user_id']))
    {
        $arr['user_id'] = $_SESSION['user_id'];
        $query = "select * from users where user_id = :user_id limit 1";
        $stmt = $connection->prepare($query);
        $check = $stmt->execute($arr);

        if($check)
        {
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data) > 0)
            {
                return $data[0];
            }
        }
    }
    header("Location: login.php");
    die;
}

