<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "../../model/config.php";
 
// Define variables and initialize with empty values
$naam = $password = "";
$naam_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["naam"]))){
        $naam_err = "Vul je gebruikersnaam in.";
    } else{
        $naam = trim($_POST["naam"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Vul je wachtwoord in.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($naam_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT klant_id, naam, password, role FROM klant WHERE naam = ? and role=2";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_naam);
            
            // Set parameters
            $param_naam = $naam;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $naam, $hashed_password, $role);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["klant_id"] = $id;
                            $_SESSION["naam"] = $naam;      
                            $_SESSION["role"] = $role;                          
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Het opgegeven wachtwoord is niet correct.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $naam_err = "Geen account gevonden met deze gebruikersnaam.";
                }
            } else{
                echo "Oeps sorry, er is iets fout gegaan probeer het opnieuw alstublieft.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../../styles.css" type="text/css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
    </style>
</head>
<body>
    <div class="wrapper">
        <img class="afspraakplanner" src="../images/loginlogo.jpg" alt="Afspraakplanner">
        <h2>Inloggen klant</h2>
        <p>Vul uw gegevens in om in te loggen.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Gebruikersnaam</label>
                <input type="text" name="naam" class="form-control" placeholder="JohnDoe" value="" required>
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Wachtwoord</label>
                <input type="password" name="password" class="form-control" placeholder="********" value="" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Inloggen als ZZP'er ?<a href="../zzp-er/login.php"> Klik Hier</a></p>
        </form>
    </div>    
    </body>
</html>
