<?php

//include('database_connection.php');
session_start();

?>

<html>  
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Chat</title>  
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" media="screen" href="../../styles.css">-->
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>-->
    </head>  
    <body style="margin: 0;">  
	<?php include 'view/navigatie/header.php';?>

        <div class="containerchat">
			<br />
			<h3 align="center">Chat met klanten / zzp'ers</h3><br />
			<br />
			<div class="row">
				<div class="col-8 col-s-6">
					<h4>Online gebruikers</h4>
				</div>
				<div class="col-4 col-s-6">
					<p align="right">Goedendag - <?php echo $_SESSION['username']; ?></p>
				</div>
			
</div>
</div>
    </body>  
</html>