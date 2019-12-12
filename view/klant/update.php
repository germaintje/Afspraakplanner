<?php
require_once "../../model/config.php";

$formData = $_REQUEST;

$id = $_GET["afspraak_id"];
$datum = $formData["datum"];
$comment = $formData["comment"];
$blok_id = $formData["blok_id"];


//Define the query
$query = "UPDATE afspraken SET datum = '$datum',comment = '$comment',blok_id = '$blok_id' WHERE afspraak_id= " . $id;

//sends the query to delete the entry
$result = mysqli_query($link, $query);

if($result){
    echo "Succesvol gewijzigd";
} else {
    echo "Wijziging mislukt";
}

?>