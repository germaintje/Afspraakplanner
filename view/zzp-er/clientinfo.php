<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>client gegevens</title>
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
        <div class="informatie">
            <h2>Alle informatie</h2>
                <?php
                require_once "../../model/config.php";
                $id = $_GET['klant_id'];

                $query = "DELETE FROM klant WHERE id =" . $id;
                $sql = "SELECT * FROM klant WHERE klant_id = ". $id ;
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $klant = $row['klant_id'];
                        $_SESSION["klant_id"] = $row["klant_id"];
                        echo "<div class='klant'>" . 
                        "<h4><span>" . $row['naam'] . "</span></h4>" .
                        "<b>Adress: </b>" . $row["adress"] . 
                        "<br><b>Plaats: </b>" . $row["place"] . 
                        "<br><b>Telefoonnummer: </b>" . $row["phone"] . 
                        "<br><b>Geboorte datum: </b>" . $row["dob"] . 
                        "<br><b>Geslacht: </b>" . $row["gender"] . 
                        "<br><b>Contact persoon: </b>" . $row["contact_person"] . 
                        "<br><b>Toelichting: </b>" . $row["explanation"] . 
                        "<br><div class='icons'><a class='edit' href='updateform.php?klant_id=$klant'><i class='far fa-edit'></i></a>" . 
                        "<a class='trash' href='delete.php?klant_id=$klant'><i class='fas fa-trash-alt'></i></a></div>" .
                        "<a style='text-align: center;display: block;' href='home.php'><< Terug naar hoofdpagina</a>" .
                        "</div>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
</div>
</div>
</div>
</body>
</html>
<?php
