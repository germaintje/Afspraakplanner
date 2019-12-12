<?php
// Include config file
require_once "../../model/config.php";
 



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Klant aanmaken</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="../../styles.css">
</head>
<body>
<?php include 'header.php';?>

<?php
if(isset($_POST["submit"]))  
{  
    $id = $_GET['klant_id'];
    $klant = $_SESSION['klant_id'];


     $relatie = "INSERT INTO klant_relatie (user_id, klant_id) VALUES ($_SESSION[user_id], '$klant')";

     if(mysqli_query($link, $relatie))
      {  
           echo 'Data is in de database gezet<br>';  
      }  else{
        echo 'er is iets fout gegaan met de overige informatie<br>';
      }

 }  


