<?php
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
$id = $_GET["klant_id"];

//Define the query
$query = "SELECT * FROM klant WHERE klant_id= " . $id;

//sends the query to select the entry
$result = mysqli_query($link, $query);

if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='col-12 col-s-12'>" .
                 "<div class='toevoegen'>" .
                 "<h2>Klant wijzigen</h2>" .
                 "<form action='update.php?klant_id=$id' method='post'>" .
                 "<h4><span>" . $row['naam'] . "</span></h4>" .
                 "<label>Naam</label>" . 
                 "<input type='text' name='naam' class='form-control' value='" . $row["naam"] . "' >" . 

                 //"<label>Wachtwoord</label><br>" .
                 //"<input type='password' name='password' class='form-control' placeholder='Nieuw Wachtwoord' value='' >" . 

                 "<label>Adress</label><br>" . 
                 "<input type='text' name='adress' class='form-control' placeholder='Adress' value='" . $row["adress"] . "' >" . 

                 "<label>Plaats</label><br>" . 
                 "<input type='text' name='place' class='form-control' placeholder='Plaats' value='" . $row["place"] ."' >" . 

                 "<label>Telefoonnummer</label><br>" .
                 "<input type='phone' name='phone' class='form-control' placeholder='Telefoonnummer' value='" . $row["phone"] ."' >" . 

                "<label>Geboortedatum</label><br>" .
                "<input type='date' name='dob' class='form-control' value='" . $row["dob"] . "' >" .

                 "<label>Geslacht</label><br>" .
                 "<input type='radio' name='gender' class='' value='Man'><span>Man</span><br>
                 <input type='radio' name='gender' class='' value='Vrouw'><span>Vrouw</span><br>
                 <input type='radio' name='gender' class='' value='Overig' checked='checked'><span>Overig</span><br>" .

                "<label>Contactpersoon</label><br>" .
                "<input type='text' name='contact_person' class='form-control' placeholder='Contact persoon' value='" . $row["contact_person"] . "' >" .

                "<label>Toelichting</label><br>" .
                 "<textarea style='resize: vertical; max-height: 200px;' type='text' name='explanation' class='form-control' placeholder='Toelichting:' value='" . $row["explanation"] . "' ></textarea>" .
                "<br><input style='width: 100%;' type='submit' value='Wijzigen' class='btn btn-primary'><br>" .
                "<br><a style='text-align: center;display: block;' href='home.php'><< Terug naar hoofdpagina</a>" .
                "</form>" .
                "</div>" .
                "</div>";
        }
} else {
        echo "Deze afspraak bestaat niet."  ;  
}

?>

</body>
</html>