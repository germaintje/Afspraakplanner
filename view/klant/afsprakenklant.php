<?php
require_once "header.php";
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
<a href="../../index.php?op=getAppointmentForm"><button class="btn">Afspraak maken</button></a>
<!-- <a href="afsprakenklant.php"><button class="btn">Afspraken</button></a> -->

<?php

    $sql = "SELECT * FROM afspraken
            WHERE klant_id = '1'";

            $result = $link->query($sql);

    

        

        function blok($result, $row){
            
            $blok = $row["blok_id"];

            switch($blok){
                case 1:
                    $blok = "9:00 tot 10:00";
                    return $blok;
                    break;
                case 2:
                    $blok = "10:00 tot 11:00";
                    return $blok;
                    break;
                case 3:
                    $blok = "11:00 tot 12:00";
                    return $blok;
                    break;
                case 4:
                    $blok = "12:00 tot 13:00";
                    return $blok;
                    break;
                case 5:
                    $blok = "13:00 tot 14:00";
                    return $blok;
                    break;
                case 6:
                    $blok = "14:00 tot 15:00";
                    return $blok;
                    break; 
                case 7:
                    $blok = "15:00 tot 16:00";
                    return $blok;
                    break;
                case 8:
                    $blok = "16:00 tot 17:00";
                    return $blok;
                    break;
                case 9:
                    $blok = "17:00 tot 18:00";
                    return $blok;
                    break;
                case 10:
                    $blok = "18:00 tot 19:00";
                    return $blok;
                    break;
                case 11:
                    $blok = "19:00 tot 20:00";
                    return $blok;
                    break;
                case 12:
                    $blok = "20:00 tot 21:00";
                    return $blok;
                    break;
            }
        }

            if ($result->num_rows > 0) {
                
            
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $afspraak= $row['afspraak_id'];
                    echo "<div class='afspraken'><b>Datum: </b>" . $row["datum"] . " - ";
                    echo "<b>Tijd:</b> " . blok($result,$row) . "<br />";
                    echo "<b>Beschrijving:</b> " . $row["comment"] . "<br />";
                    echo "<i>Afspraak id: " . $row["afspraak_id"] . "</i> <br />";
                    echo "<a href='updateform.php?afspraak_id=$afspraak'>Wijzigen</a> - <a href='delete.php?afspraak_id=$afspraak'>Afspraak verwijderen</a>";
                    echo "</div><br />";
                }
            } else {
                echo "Geen afspraken";
              }

?>
</body>
</html>