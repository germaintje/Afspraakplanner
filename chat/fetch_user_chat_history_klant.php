<?php

//fetch_user_chat_history.php
//voor als je inlogt als klant om de user te zien
include('database_connection.php');

session_start();

echo fetch_user_chat_history($_SESSION['klant_id'], $_POST['to_user_id'], $connect);

?>