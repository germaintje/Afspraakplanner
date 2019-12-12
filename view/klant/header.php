<?php

session_start();

if(!isset($_SESSION['klant_id']))
{
	header("location:login.php");
}?>

<!-- Header  -->
<div class="header">
    <div class="topnav" id="myTopnav">
    <a class="pontes" href="home.php"><img class="pontesimg" src="../images/afspraakplanner.jpg" alt="afspraakplanner"></a>
      <a class="nieuw" href="../../chat/chatklant.php">Chatten</a>
      <a class="afspraken-klant" href="afsprakenklant.php">Afspraken</a>
      <a class="gegevens" href="gegevensklant.php">Gegevens</a>
      <div class="welkom">
        <span>Welkom - <?php echo $_SESSION['naam']; ?> </span><a href="../../index.php"><i class="fas fa-sign-out-alt"></i>Log uit</a>
      </div>      
      <a href="javascript:void(0);" class="icon fa fa-bars bars" onclick="myFunction()"></a>
    </div>
</div>

<script type="text/javascript" src="js/header.js"></script>
