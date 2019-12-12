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
<div class="row">

<div class="col-12 col-s-12">
    <div class="toevoegen">
    <h2>Klant toevoegen</h2>
        <p>Vul hier alle informatie in.</p>
        <form method="post" action="" id="geslacht">
            <div class="info form-group">
                <label>Naam</label><br>
                <input type="text" name="naam" class="form-control" placeholder="Naam" required>
            </div>
            <div class="info">
                <label>Wachtwoord</label><br>
                <input type="password" name="password" class="form-control" placeholder="Wachtwoord" value="" required>
            </div>
            <div class="info">
                <label>Adress</label><br>
                <input type="text" name="adress" class="form-control" placeholder="Adress" required>
            </div>
            <div class="info">
                <label>Plaats</label><br>
                <input type="text" name="place" class="form-control" placeholder="Plaats" required>
            </div>
            <div class="info">
                <label>Telefoonnummer</label><br>
                <input type="phone" name="phone" class="form-control" placeholder="Telefoonnummer" required>
            </div>
            <div class="info">
                <label>Geboortedatum</label><br>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="info">
                <label>Geslacht</label><br>
                <input type="radio" name="gender" class="" value="Man"><span>Man</span><br>
                <input type="radio" name="gender" class="" value="Vrouw"><span>Vrouw</span><br>
                <input type="radio" name="gender" class="" value="Overig"><span>Overig</span><br>
            </div>
            <div class="info">
                <label>Contactpersoon</label><br>
                <input type="text" name="contact_person" class="form-control" placeholder="Contact persoon" required>
            </div>
            <div class="info">
                <label>Toelichting</label><br>
                <textarea style="resize: vertical; max-height: 200px;" type="text" name="explanation" class="form-control" placeholder="Toelichting:" required></textarea>
            </div>

            <div class="info">
                <br><input style='width: 100%;' type="submit" id="submit" name="submit" class="btn btn-primary voegtoe" value="Voeg toe">
            </div>
            <div class="info">
                <br><a style='text-align: center;display: block;' href='home.php'><< Terug naar hoofdpagina</a>
            </div>
        </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST["submit"]))  
{  

    $klant = $_SESSION['klant_id'];


     //insert klant gegevens
     $naam = $_POST['naam'];
     $password = $_POST['password'];
     $param_password = password_hash($password, PASSWORD_DEFAULT);
     $role = 2;
     $adress = $_POST['adress'];
     $place = $_POST['place'];
     $phone = $_POST['phone'];
     $dob = $_POST['dob'];
     $gender = $_POST['gender'];
     $contact_person = $_POST['contact_person'];
     $explanation = $_POST['explanation'];
     $klant_toevoegen = "INSERT INTO klant(naam, password, role, adress, place, phone, dob, gender, contact_person, explanation) VALUES ('$naam', '$param_password', '$role', '$adress', '$place','$phone', '$dob', '$gender', '$contact_person', '$explanation')";  

     //$relatiee = "INSERT INTO klant_relatie (user_id, klant_id) VALUES ($_SESSION[user_id], '$klant')";
     //$relatie = $mysqli->insert_id;

     if(mysqli_query($link, $klant_toevoegen))
      {  
           echo 'Data is in de database gezet<br>';  
      }  else{
        echo 'er is iets fout gegaan met de overige informatie<br>';
      }

 }  


