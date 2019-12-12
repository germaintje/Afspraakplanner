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
<?php include 'header.php';?>
<div class="row">
            <div class="col-12 col-s-12">
            <h2>Alle klanten</h2>

            
                <?php
                require_once "../../model/config.php";
                /*
                $sql = "SELECT * FROM klant";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $klant = $row['klant_id'];
                        echo "<div class='klanten'>" . 
                        "<table class='agendatabel' style='width: 100%'>" .
                        "<tr class='klanten'>" . 
                                "<th class='agendatabel'>Naam</th>" .
                                "<th class='agendatabel'>Adress</th>" .
                                "<th class='agendatabel'>Plaats</th>" .
                                "<th class='agendatabel'>Telefoonnummer</th>" .
                                "<th class='agendatabel'>Geboortedatum</th>" .
                                "<th class='agendatabel'>Geslacht</th>" .
                                "<th class='agendatabel'>Toevoegen als persoonlijke klant</th>" .
                        "</tr>" .
                        "<tr class='agendatabel'>" .
                                "<td class='agendatabel'>" . $row['naam'] . "</td>" . 
                                "<td class='agendatabel'>" . $row['adress'] . "</td>" . 
                                "<td class='agendatabel'>" . $row['place'] . "</td>" . 
                                "<td class='agendatabel'>" . $row['phone'] . "</td>" . 
                                "<td class='agendatabel'>" . $row['dob'] . "</td>" . 
                                "<td class='agendatabel'>" . $row['gender'] . "</td>" . 
                                "<td class='agendatabel'><input style='width: 100%;' type='submit' id='submit' name='submit' class='btn btn-primary voegtoe' value='Voeg toe als persoonlijke klant'>" . 
                        "</tr>" .
                        "</table>" .
                        "</div>";
                    }
                } else {
                    echo "0 results";
                }*/
                $sql = "SELECT * FROM klant";
                $result = $link->query($sql);

                $html = "";

                $html         .= "<div class='table-responsive'><table class='table'>";
                $html         .= "<thead><tr><th scope=\"col\">Naam</th>
                                  <th  scope=\"col\">Adres</th>
                                  <th scope=\"col\">Plaats</th>
                                  <th  scope=\"col\">Telefoonnummer</th>
                                  <th  scope=\"col\">Geboortedatum</th>
                                  <th scope=\"col\">Geslacht</th>
                                  <th scope=\"col\">Action</th></tr>";
                $html         .= "<tbody>";
            
                while ( $row = $result->fetch_assoc() ) {
                  $id = $row['klant_id'];
                  $naam  = $row['naam'];
                  $adress = $row['adress'];
                  $place        = $row['place'];
                  $phone     = $row['phone'];
                  $dob     = $row['dob'];
                  $gender   = $row['gender'];
            
            
                  $html .= "<tr><th scope='row'>$naam</th>
            <td>$adress</td>
            <td>$place</td>
            <td >$phone</td>
            <td >$dob</td>
            <td >$gender</td>
            <td ><a href='mijnklant.php?klant_id=$id' id='submit' name='submit' class='btn btn-primary'>Voeg toe als persoonlijke klant</a>";
                }
            
                $html .= "</tbody></table></div>";

                echo $html;

                ?>
            </div>

</div>
</body>
</html>
<?php
require_once "../../model/config.php";

if(isset($_POST["submit"]))  
 {  

      //insert klant gegevens
      $id = $_GET['klant_id'];
      $zzper_id = $_POST['user_id'];
      $klant_id = $_POST['klant_id'];
      $realtie = "INSERT INTO klant_relatie(user_id, klant_id) VALUES ('$user_id', '$klant_id');";  
      if(mysqli_query($link, $afspraak))
      {  
           echo 'Data is in de database gezet<br>';  
      }  else{
        echo 'er is iets fout gegaan met de overige informatie<br>';
      }
 }