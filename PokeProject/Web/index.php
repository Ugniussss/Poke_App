<?php

require_once "../Config/autoload.php";
check_login($connection);


$stmt = $connection->prepare("select * from users");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="Style/PokeStyle.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <title>Pagrindinis langas</title>
</head>
<header class="mdc-top-app-bar mdc-top-app-bar--short">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" style="font-size: 15px; white-space: nowrap;">BAKSNOTOJAS 2000</button>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href=""><img src="Images/hand-point-right-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="updateUser.php?id=<?=$_SESSION['user_id']?>"><img src="Images/user-circle-solid.png"></a></button>
            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Bookmark this page"><a href="logout.php"><img src="Images/sign-out-alt-solid.png"></a></button>
        </section>
    </div>
</header>
<body>
    <div class="main" style="width: 800px; margin-left: 400px;">
    <h1>VARTOTOJAI</h1>
    <div>
        <input type="text" name="search" style="width: 700px; height: 30px" id="search" placeholder="Ieškoti pagal vardą" onkeyup="search_data()">
    </div>
        <br>
        <div id="table-data">
        <table class="user-table">
            <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Elektroninis paštas</th>
                <th>Poke skaičius</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr id="<?=$contact['user_id']?>">
                    <td><?=$contact['user_name']?></td>
                    <td><?=$contact['user_surname']?></td>
                    <td><?=$contact['user_email']?></td>
                    <td><?=$contact['user_poke_number']?></td>
                    <td>
                        <button class="poke" data-counter="poke" value="<?=$contact['user_id']?>">Poke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

    <script>

        $(document).ready(function(){
            load_data();
            function load_data(page)
            {
                $.ajax({
                    type: 'post',
                    url: 'pagination.php',
                    data: {page:page},
                    success:function(data)
                    {
                        $('#table-data').html(data);
                    }
            })
            }
            $(document).on('click', '.pagination_link', function (){
                var page = $(this).attr('id');
                load_data(page);
            });

})
        function search_data(){
            var search = jQuery('#search').val();
                jQuery.ajax({
                    type: 'post',
                    url:  'search.php',
                    data: 'search='+search,
                    success:function (data){
                        jQuery('#table-data').html(data);
                    }
                });

        }
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
</body>
</html>
