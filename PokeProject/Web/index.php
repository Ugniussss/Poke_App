<?php

require_once "../Config/autoload.php";
check_login($connection);

//-------------------- Limituojamas įrašių skaičius per puslapį --------------------------
$perPage = "7";
$countRecords = $connection->prepare("select COUNT(user_id) from users");
$countRecords->execute();
$row = $countRecords->fetch();
$numRecords = $row[0];

$numPages = ceil($numRecords/$perPage);
$page = $_GET['start'];
$start = $page * $perPage;


//-------------------- Užklausa i duomenų bazę, jog būtų atvaizduojami duomenys ----------
$stmt = $connection->prepare("select * from users LIMIT $start,$perPage");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
//----------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <title>Pagrindinis langas</title>
</head>
<body>
<script>
    $(document).ready(function ($) {
        $(document).on('click', '.poke', function() {
            var user_poke_number = $(this).data('poke');
            var user_id = $(this).val();
            jQuery('#poke').html('Loading...') ;
            var ajax = jQuery.ajax({
                method : 'GET',
                url : 'pokingUser.php?id='+user_id,
                data : { 'user_poke_number' : '1', 'poke': user_poke_number,
                    'user_id' : user_id
                }
            }) ;
            ajax.success(function(data){
                jQuery('#poke').html(data);
                console.log(user_id);
            });
            ajax.fail(function(data){
                alert('Klaida paspaudime');
            });
        });
    });
</script>
    <div>
        <a href="logout.php">Atsijungti</a>
        <a href="updateUser.php?id=<?=$_SESSION['user_id']?>">Icon</a>
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <td>Vardas</td>
                <td>Pavardė</td>
                <td>Elektroninis paštas</td>
                <td>Poke skaičius</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr id="<?=$contact['user_id']?>">
                    <td><?=$contact['user_name']?></td>
                    <td><?=$contact['user_surname']?></td>
                    <td><?=$contact['user_email']?></td>
                    <td><?=$contact['user_poke_number']?></td>
                    <td>
                        <button class="poke" data-counter="poke" value="<?=$contact['user_id']?>">Poke</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        for($i=0;$i<$numPages;$i++)
        {
            $y = $i + 1;
            echo '<a href="index.php?start='.$i.'">'.$y.'</a>';
        }
        ?>
    </div>
</div>
</body>
</html>
