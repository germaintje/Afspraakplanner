<?php
require_once 'model/DataHandler.php';

class LoginLogic
{

  public function __construct()
  {
    $this->DataHandler = new DataHandler("localhost", "mysql", "afspraakplanner", "root", "");
  }
  public function __destruct()
  { }

  public function login()
  {
            
            // Initialize the session
        session_start();
        
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] = 1){
            header("location: ?op=zzp");
        }
            else {
                header("location: ?op=klant");
            }
            exit;
        
        
        // Include config file
        require_once "model/config.php";
        
        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = "";
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $username_err = "Vul je gebruikersnaam in.";
            } else{
                $username = trim($_POST["username"]);
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Vul je wachtwoord in.";
            } else{
                $password = trim($_POST["password"]);
            }
            
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["user_id"] = $id;
                                    $_SESSION["username"] = $username;  
                                    $_SESSION["role"] = $role;                          
                                    if($role = 1){
                                    // Redirect user to welcome page
                                    header("location: ?op=klant");
                                    }
                                    if($role = 2){
                                        header("location: ?op=zzp");
                                    }
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "Het opgegeven wachtwoord is niet correct.";
                                }
                            }
                        } else{
                            // Display an error message if username doesn't exist
                            $username_err = "Geen account gevonden met deze gebruikersnaam.";
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
  }
  public function loginBeheerder()
  {
            
            // Initialize the session
        session_start();
        
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: home.php");
            exit;
        }
        
        // Include config file
        require_once "model/config.php";
        
        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = "";
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $username_err = "Vul je gebruikersnaam in.";
            } else{
                $username = trim($_POST["username"]);
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Vul je wachtwoord in.";
            } else{
                $password = trim($_POST["password"]);
            }
            
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["user_id"] = $id;
                                    $_SESSION["username"] = $username;                            
                                    
                                    // Redirect user to welcome page
                                    header("location: home.php");
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "Het opgegeven wachtwoord is niet correct.";
                                }
                            }
                        } else{
                            // Display an error message if username doesn't exist
                            $username_err = "Geen account gevonden met deze gebruikersnaam.";
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
  }
  public function loguit()
  {
    // Initialize the session
    session_start();
     
    // Unset all of the session variables
    $_SESSION = array();
     
    // Destroy the session.
    session_destroy();
     
    // Redirect to login page
    header("location: view/klant/login.php");
    exit;
  }

}
