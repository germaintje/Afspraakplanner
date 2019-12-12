<?php 
session_start();
require_once "../../model/config.php";

$user_id = $_SESSION['user_id'];
$klant_id = $_GET['klant_id'];

$sql = "INSERT INTO `klant_relatie` (`user_id`, `klant_id`) VALUES ('$user_id', '$klant_id');";
//$result = $link->mysqli_query($sql);

if ($link->mysql_query($sql) === TRUE) {
    $message = "Klant is toegoevoegd aan uw lijst.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: home.php");
} else {
    $message = "Klant toevoegen is mislukt.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: alleklanten.php");
}