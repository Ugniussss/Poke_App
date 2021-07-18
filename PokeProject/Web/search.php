<?php

    require "../Config/autoload.php";

    $search = $_POST['search'];
    $query = "select user_name, user_surname, user_email, user_poke_number from users where user_name like '%$search%' or user_surname like '%$search%' or user_email like '%$search%' or user_poke_number like '%$search%'";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($contacts['0'])){
        $output = '<table class="user-table"><thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Elektroninis paštas</th>
                <th>Poke skaičius</th>
            </tr>
            </thead>';
        foreach ($contacts as $contact){
            $output .='<tr id="'.$contact['user_id'].'">
                <td>'.$contact['user_name'].'</td>
                <td>'.$contact['user_surname'].'</td>
                <td>'.$contact['user_email'].'</td>
                <td>'.$contact['user_poke_number'].'</td>
                <td>
                     <button class="poke" data-counter="poke" value="'.$contact['user_id'].'">Poke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ></button>
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