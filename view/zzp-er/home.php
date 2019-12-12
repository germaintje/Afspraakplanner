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
    <div class="col-6 col-s-12">
        <div class="alleafspraken">
        <h2>Alle afspraken</h2>
                <div class="afspraken">
                            <?php
                        require_once "../../model/config.php";
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT naam, datum, tijdblok_uur, comment FROM afspraken INNER JOIN klant on afspraken.klant_id = klant.klant_id INNER JOIN tijdblok on afspraken.blok_id = tijdblok.tijdblok_id INNER JOIN users ON afspraken.zzper_id = users.user_id
                        WHERE users.user_id = '". $_SESSION['user_id'] ."'";
                        $result = $link->query($sql);
                        

                        if ($result->num_rows > 0) {
                            // output data of each row
                            
                            while($row = $result->fetch_assoc()) {
                                
                                echo "<div class='klanten'>". 
                                "<table class='agendatabel' style='width: 100%'>" .
                                "<tr class='agendatabel'>" . 
                                "<th class='agendatabel'>Afspraak met</th>" .
                                "<th class='agendatabel'>Datum</th>" .
                                "<th class='agendatabel'>Tijd</th>" .
                                "<th class='agendatabel'>Commentaar</th>" .
                                "</tr>" .
                                "<tr class='agendatabel'>" .
                                "<td class='agendatabel'>" . $row['naam'] . "</td>" .  
                                "<td class='agendatabel'>" . $row['datum'] . "</td>" .
                                "<td class='agendatabel'>" . $row['tijdblok_uur'] . "</td>" .
                                "<td class='agendatabel'>" . $row['comment'] . "</td>" . 
                                "</tr>" .

                                "</table>" .
                                "</div>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                </div>
            </div>
        </div>
            <div class="col-3 col-s-12">
            <h2>Mijn klanten</h2>
                <?php
                require_once "../../model/config.php";
                $sql = "SELECT * FROM klant
                INNER JOIN klant_relatie ON klant.klant_id = klant_relatie.klant_id
                INNER JOIN users ON klant_relatie.user_id = users.user_id
                WHERE users.user_id = '". $_SESSION['user_id'] ."'";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $klant = $row['klant_id'];
                        echo "<div class='klanten'>
                        <b>Naam: </b>" . $row["naam"]. 
                        "<b> Geslacht: </b>" . $row["gender"] . 
                        "<a href='clientinfo.php?klant_id=$klant'><span>  Meer info</span></a>" . 
                        "</div>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>

            <div class="col-3 col-s-12">
            <h2>Beschikbaarheid toevoegen</h2>
                <?php
                require_once "../../model/config.php";
                $sql = "SELECT * FROM klant
                INNER JOIN klant_relatie ON klant.klant_id = klant_relatie.klant_id
                INNER JOIN users ON klant_relatie.user_id = users.user_id
                WHERE users.user_id = '". $_SESSION['user_id'] ."'";
                $result = $link->query($sql);
?>
                <form method="post" action="" id="geslacht">
                    <div class="info form-group">
                    <label>Datum</label><br>
                        <input type="date" name="beschikbaar" class="form-control" placeholder="Beschikbaarheid" required>
                    </div>
                    <div class="info form-group">
                    <label>Tijd</label><br>
                        <input type="time" name="tijd" class="form-control" placeholder="Tijd" required>
                    </div>
                    <div class="info">
                        <br><input style='width: 100%;' type="submit" id="beschikbaarheid" name="beschikbaarheid" class="btn btn-primary voegtoe" value="Voeg toe">
                    </div>
                </form>
                
            </div>
</div>
</body>
</html>
<?php
require_once "../../model/config.php";

if(isset($_POST["beschikbaarheid"]))  
{  

     //insert klant gegevens
     $beschikbaar = $_POST['beschikbaar'];
     $tijd = $_POST['tijd'];
     $beschikbaarheid = "INSERT INTO beschikbaarheid(beschikbaar, tijd) VALUES ('$beschikbaar', '$tijd')";  

     if(mysqli_query($link, $beschikbaarheid))
      {  
           echo 'Data is in de database gezet<br>';  
      }  else{
        echo 'er is iets fout gegaan met de overige informatie<br>';
      }

 }  

if(isset($_POST["submit"]))  
 {  

      //insert klant gegevens
      $zzper_id = $_POST['zzper_id'];
      $klant_id = $_POST['klant_id'];
      $datum = $_POST['datum'];
      $blok_id = $_POST['blok_id'];
      $comment = $_POST['comment'];
      $afspraak = "INSERT INTO afspraken(zzper_id, klant_id, datum, blok_id, comment) VALUES ('$zzper_id', '$klant_id', '$datum', '$blok_id', '$comment');";  
      if(mysqli_query($link, $afspraak))
      {  
           echo 'Data is in de database gezet<br>';  
      }  else{
        echo 'er is iets fout gegaan met de overige informatie<br>';
      }
 }