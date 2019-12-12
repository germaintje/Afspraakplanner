<?php

//fetch_user.php
//dit is voor de klant om de gekoppelde zzper te zien

include('database_connection.php');

session_start();

$query = "
SELECT * FROM users 
WHERE user_id != '".$_SESSION['klant_id']."' 
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
		<td class="topline">'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['klant_id'], $connect).'</td>
		<td><button type="button" class="stuur stuurleft start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Stuur bericht</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>