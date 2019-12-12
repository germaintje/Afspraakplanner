<?php
require_once "../../model/config.php";


$id = $_GET["afspraak_id"];

//Define the query
$query = "DELETE FROM afspraken WHERE afspraak_id= " . $id;

//sends the query to delete the entry
$result = mysqli_query($link, $query);

?>