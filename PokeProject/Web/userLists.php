<?php
$stmt = $connection->prepare("select * from users");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
GLOBAL $userPokeNumber;
?>
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
                <tr>
                    <td><?=$contact['userName']?></td>
                    <td><?=$contact['userSurname']?></td>
                    <td><?=$contact['userEmail']?></td>
                    <td id="pokeNumber">0</td>
                    <td>
                        <button class="poke" data-id="<?=$contact['userId']?>">Poke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
