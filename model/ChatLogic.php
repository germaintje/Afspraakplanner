<?php
//require_once 'model/DataHandler.php';

//database_connection.php

date_default_timezone_set('Europe/Amsterdam');
class ChatLogic
{
	public function __construct()
	{
		$connect = new PDO("mysql:host=localhost;dbname=afspraakplanner;charset=utf8mb4", "root", "");
	}
	public function __destruct()
	{ }
function chat()
{
	$connect = new PDO("mysql:host=localhost;dbname=afspraakplanner;charset=utf8mb4", "root", "");

	function count_unseen_message($from_user_id, $to_user_id, $connect)
	{
		$query = "
		SELECT * FROM chat_message 
		WHERE from_user_id = '$from_user_id' 
		AND to_user_id = '$to_user_id' 
		AND status = '1'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$count = $statement->rowCount();
		$output = '';
		if($count > 0)
		{
			$output = '<span class="teller">'.$count.'</span>';
		}
		return $output;
	}

function fetch_user_last_activity($user_id, $connect)
{
	echo "test";
	$query = "
	SELECT * FROM login_details 
	WHERE user_id = '$user_id' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['last_activity'];
	}
}


function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		if($row["from_user_id"] == $from_user_id)
		{
			$user_name = '<b class="text-success">Jij</b>';
		}
		else
		{
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
		}
		$output .= '
		<li style="border-bottom:1px dotted #ccc">
			<p>'.$user_name.' - '.$row["chat_message"].'
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;
}

function get_user_name($user_id, $connect)
{
	echo "test";
	$query = "SELECT username FROM users WHERE user_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['username'];
	}
}

////fetch_user.php
	
	//include('database_connection.php');
	//include('model/ChatLogic.php');
	//session_start();
	
	$query = "
	SELECT * FROM users 
	WHERE user_id != '".$_SESSION['user_id']."' 
	";
	
	$statement = $connect->prepare($query);
	
	$statement->execute();
	
	$result = $statement->fetchAll();
	
	$output = '
	<div class="containerchat">
		<div class="row">
			<div class="table-responsive col-12 col-s-12">
				<div class="col-4 col-s-12" id="user_details">
					<table class="">
						<tr>
						<th width="70%">Gebruikersnaam</td>
						<th width="30%">Stuur bericht</td>
						</tr>
				
	';
	
	foreach($result as $row)
	{
		$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d-Y H:i:s', $current_timestamp);
		$output .= '
		<tr>
			<td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).'</td>
			<td><button type="button" class="start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Stuur bericht</button></td>
		</tr>
		';
	}
	
	$output .= '</table>
	</div>
	<div class="col-8 col-s-12" id="user_model_details"></div>
	</div>
	</div>
	</div>
	
	';
	
	echo $output;


	$data = array(
		':to_user_id'		=>	$_POST['to_user_id'],
		':from_user_id'		=>	$_SESSION['user_id'],
		':chat_message'		=>	$_POST['chat_message'],
		':status'			=>	'1'
	);
	
	$query = "
	INSERT INTO chat_message 
	(to_user_id, from_user_id, chat_message, status) 
	VALUES (:to_user_id, :from_user_id, :chat_message, :status)
	";
	
	$statement = $connect->prepare($query);
	
	if($statement->execute($data))
	{
		echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
	}
	echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
}
}

?>

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
			url:"fetch_user.php",
			method:"POST",
			success:function(data){
				$('#user_details').html(data);
			}
		})
	}

	function make_chat_dialog_box(to_user_id, to_user_name)
	{
		var modal_content = '<div id="user_dialog_'+to_user_id+'" class=" " title="Je hebt een gesprek met '+to_user_name+'">';
		modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
		modal_content += fetch_user_chat_history(to_user_id);
		modal_content += '</div>';
		modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="" style="display:block; height:200px; width: 100%; border-radius: 5px; resize: none;"></textarea>';
		modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="send_chat">Send</button>';
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
			url:"insert_chat.php",
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
			url:"../view/chat/fetch_user_chat_history.php",
			method:"POST",
			data:{to_user_id:to_user_id},
			success:function(data){
				$('#chat_history_'+to_user_id).html(data);
			}
		})
		
	}



	
});  
</script>