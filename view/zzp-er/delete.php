<?php
require_once "../../model/config.php";
$id = $_GET['klant_id'];

//Define the query
$query = "DELETE FROM klant WHERE klant_id= " . $id;

//sends the query to delete the entry
$result = mysqli_query($link, $query);
//display message to user 
if($result){
    $_SESSION['success_message'] = 'User data deleted successfully';
    header('Location: home.php');
}else{
	$_SESSION['error_message'] = 'User data couldn\'t be deleted';
	header('Location: insert.php');
}
