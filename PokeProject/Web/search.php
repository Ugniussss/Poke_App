<?php
    require "../Config/autoload.php";
    $search = $_POST['search'];
    $query = "select userName, userSurname, userEmail from users where userName like '%$search%' or userSurname like '%$search%' or userEmail like '%$search%'";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (isset($contacts['0'])) {
        $output = '<table class="user-table"><thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Elektroninis paštas</th>
                <th>Poke skaičius</th>
            </tr>
            </thead>';
        foreach ($contacts as $contact){
            $output .=
                '<tr>
                <td>'.$contact['userName'].'</td>
                <td>'.$contact['userSurname'].'</td>
                <td>'.$contact['userEmail'].'</td>
                <td>
                     <button class="poke" data-counter="poke">Poke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ></button>
                </td>
            </tr>';
        }
        $output .='</table>';
        echo $output;
    }
    else{
        echo "Toks vartotojas nerastas";
    }
?>