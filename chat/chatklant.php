<?php

include('database_connection.php');

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
		<link rel="stylesheet" type="text/css" media="screen" href="../styles.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>  
    <body style="margin: 0;">  
		<div class="header">
			<div class="topnav" id="myTopnav">
				<a class="pontes" href="../view/klant/home.php"><img class="pontesimg" src="../view/images/afspraakplanner.jpg" alt="afspraakplanner"></a>
				<a class="nieuw" href="chatklant.php">Chatten</a>
				<div class="welkom">
        			<span>Welkom - <?php echo $_SESSION['naam']; ?> </span><a href="../index.php"><i class="fas fa-sign-out-alt"></i>Log uit</a>
     			</div>  
				<a href="javascript:void(0);" class="icon fa fa-bars bars" onclick="myFunction()"></a>
			</div>
		</div>
        <div class="container">
			<div class="row">
				<div class="col-12 col-s-12">
				<h3 align="center" style="padding:0;">Chat met klanten / zzp'ers</h3>
			</div>

			<div class="col-12 col-s-12">
				<div class="col-6 col-s-12" id="user_details"></div>
				<div class="col-6 col-s-12" id="user_model_details"></div>
			</div>
		   </div>
		</div>
    </body>  
</html>

<script>  
$(document).ready(function(){

	fetch_user();

	setInterval(function(){
		update_last_activity();
		fetch_user();
		update_chat_history_data();
		fetch_group_chat_history();
	}, 5000);

	function fetch_user()
	{
		$.ajax({
			url:"fetch_userklant.php",
			method:"POST",
			success:function(data){
				$('#user_details').html(data);
			}
		})
	}

	function make_chat_dialog_box(to_user_id, to_user_name)
	{
		var modal_content = '<div id="user_dialog_'+to_user_id+'" class="chatbox" title="Je hebt een gesprek met '+to_user_name+'"><h3 style="padding: 3px; margin-top: 3px;" >Je hebt een gesprek met ' +to_user_name+'</h3>';
		modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
		modal_content += fetch_user_chat_history(to_user_id);
		modal_content += '</div>';
		modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="" style="display:block !important; height:200px; width: 100%; border-radius: 5px 5px 0px 0px; resize: none;"></textarea>';
		modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="button stuur send_chat">Send</button>';
		$('#user_model_details').html(modal_content);
	}

	$(document).on('click', '.start_chat', function(){
		var to_user_id = $(this).data('touserid');
		var to_user_name = $(this).data('tousername');
		make_chat_dialog_box(to_user_id, to_user_name);
		$("#user_dialog_"+to_user_id).dialog({
			autoOpen:false,
			width:400
		});
		$('#user_dialog_'+to_user_id).dialog('open');
		/*$('#chat_message_'+to_user_id).emojioneArea({
			pickerPosition:"top",
			toneStyle: "bullet"
		});*/
	});

	$(document).on('click', '.send_chat', function(){
		var to_user_id = $(this).attr('id');
		var chat_message = $('#chat_message_'+to_user_id).val();
		$.ajax({
			url:"insert_chat_klant.php",
			method:"POST",
			data:{to_user_id:to_user_id, chat_message:chat_message},
			success:function(data)
			{
				//$('#chat_message_'+to_user_id).val('');
				var element = $('#chat_message_'+to_user_id).emojioneArea();
				element[0].emojioneArea.setText('');
				$('#chat_history_'+to_user_id).html(data);
			}
		})
	});

	function fetch_user_chat_history(to_user_id)
	{
		$.ajax({
			url:"fetch_user_chat_history_klant.php",
			method:"POST",
			data:{to_user_id:to_user_id},
			success:function(data){
				$('#chat_history_'+to_user_id).html(data);
			}
		})
	}



	
});  
</script>