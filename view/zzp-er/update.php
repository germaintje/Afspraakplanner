<?php
require_once "../../model/config.php";

$formData = $_REQUEST;

$id = $_GET['klant_id'];
$naam = $formData["naam"];
$adress = $formData["adress"];
$place = $formData["place"];
$phone = $formData["phone"];
$place = $formData["place"];
$dob = $formData["dob"];
$gender = $formData["gender"];
$contact_person = $formData["contact_person"];
$explanation = $formData["explanation"];


//Define the query
$query = "UPDATE klant SET naam = '$naam',adress = '$adress',place = '$place',phone = '$phone',dob = '$dob',gender = '$gender',contact_person = '$contact_person',explanation = '$explanation' WHERE klant_id=$id";

//sends the query to delete the entry
$result = mysqli_query($link, $query);

if($result){
    echo "Succesvol gewijzigd";
    header('Location: home.php');
} else {
    echo "Wijziging mislukt";
}

?>