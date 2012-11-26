<?php
/*Just add the new message and update the timestamp*/
	session_start();
	if(!isset($_SESSION['logged_in']))
	{
		$_SESSION['message'] = "<p class='error'> You need to Login to view this page </p>";
		header( 'Location: index.php' ) ;
	}
	require_once 'config.php';
	$is_ajax = $_REQUEST['is_ajax'];
	if($is_ajax)
	{	
		$reply_message = $_REQUEST['reply_message'];
		$thread_id = $_REQUEST['thread_id'];
		$receiverUserID = $_REQUEST['user_to'];
		$subject = $_REQUEST['subject_reply'];
		mysql_query("UPDATE threads SET timestamp_trigger = timestamp_trigger+1");
		mysql_query("INSERT INTO Mail (EmailFrom, EmailTo, Message, Subject, threadID) VALUES ('".$_SESSION['userID']."', '$receiverUserID', '$reply_message', '$subject', '$thread_id')");
		echo "success";
	}
	else
		echo "failure";
?>