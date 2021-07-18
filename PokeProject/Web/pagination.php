<?php

    require "../Config/autoload.php";

$perPage = 3;
$page = '';
$output = '';

    if(isset($_POST['page']))
    {
        $page = $_POST['page'];
    }
    else{
        $page = 1;
    }

$start = ($page - 1) * $perPage;

$stmt = $connection->prepare("select * from users order by user_id ASC LIMIT $start,$perPage");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output .= '<table class="user-table"><thead>
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

$countRecords = $connection->prepare("select COUNT(user_id) from users");
$countRecords->execute();
$row = $countRecords->fetch();
$numRecords = $row[0];
$numPages = ceil($numRecords/$perPage);

for($i=1;$i<=$numPages;$i++)
{
    $output .=
        "
    <span class = 'pagination_link' style=' background-color: lightgray;
  border: none;
  cursor: pointer;
  color: black;
  padding: 9px;
  margin-top: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  border-radius: 60%;' id='".$i."'>".$i."</span>";
}
echo $output;
?>
