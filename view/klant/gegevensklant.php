<?php

require "header.php";
require_once "../../model/config.php";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Afspraakplanner</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="../../styles.css">
</head>
<body>

<!-- Content -->


<?php

    $sql = "SELECT * FROM klant
            WHERE klant_id = '1'";
    //moet session klant id worden^^

            $result = $link->query($sql);

    if ($result->num_rows > 0) {
                
            
            // output data of each row
                while($row = $result->fetch_assoc()) {

                    if($row["gender"] == "M"){
                        $gender = "Dhr. ";
                    } else {
                        $gender = "Mvr.";
                    }

                    echo "<div class='klantgegevens'><b>Naam: </b>";
                    echo $gender . $row["username"] . "<br>";
                    echo "<b>Geboortedatum:</b> " . $row["dob"] . "<br />";
                    echo "<b>Adresgegevens:</b><br /> ";
                    echo $row["adress"] . ", " . $row["place"] . "<br />";
                    echo "<b>Telefoonnummer:</b> " . $row["phone"] . "<br />";
                    echo "<b>Contactpersoon:</b> " . $row["contact_person"] . "<br />";
                    echo "<br />";
                    echo "<b>Uitleg:</b> <br />" . $row["explanation"]; 
                    echo "</div><br />";
                }
            } else {
                echo "Geen gegevens beschikbaar.";
              }

?>
</body>
</html>
