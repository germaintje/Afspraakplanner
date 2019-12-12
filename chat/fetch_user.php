<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM klant 
WHERE klant_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table">
		<h3 style="margin-top: 10px; ">Alle gebruikers</h3>
	<tr>
		<th><p style="float: left;">Gebruikersnaam</p></td>
		<th><p style="float: left; margin-left: -6pc;">Stuur bericht</p></td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d-Y H:i:s', $current_timestamp);
	$output .= '
	<tr>
		<td class="topline">'.$row['naam'].' '.count_unseen_message($row['klant_id'], $_SESSION['user_id'], $connect).'</td>
		<td><button type="button" class="stuur stuurleft start_chat" data-touserid="'.$row['klant_id'].'" data-tousername="'.$row['naam'].'">Stuur bericht</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>