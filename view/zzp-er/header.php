<?php

session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}?>

<!-- Header  -->
<div class="header">
    <div class="topnav" id="myTopnav">
    <a class="pontes" href="home.php"><img class="pontesimg" src="../images/afspraakplanner.jpg" alt="afspraakplanner"></a>
      <a class="nieuw" href="../../chat/chatzzp.php">Chatten</a>
      <a class="nieuw" href="alleklanten.php">Alle klanten</a>
      <div class="welkom">
        <span>Welkom - <?php echo $_SESSION['username']; ?> </span><a href="../../index.php"><i class="fas fa-sign-out-alt"></i>Log uit</a>
      </div>      
      <a href="javascript:void(0);" class="icon fa fa-bars bars" onclick="myFunction()"></a>
    </div>
</div>

<script type="text/javascript" src="js/header.js"></script>
