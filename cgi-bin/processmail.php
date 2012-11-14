<?php

session_start();

if($_POST)
{
	require_once 'config.php';
	//grab the IDs
	$senderID = mysql_real_escape_string($_REQUEST['sender']);
	$receiverId = mysql_real_escape_string($_REQUEST['receiver']);
	//grab the subject and message
	$subject = mysql_real_escape_string($_REQUEST['subject']);
	$message = mysql_real_escape_string($_REQUEST['message']);
	$past_page = mysql_real_escape_string($_REQUEST['past_page']);
	//insert it into mail, and send that stuff. Make sure to update the other user as well.
	$query = "INSERT INTO Mail (EmailFrom, EmailTo, Message, Subject) VALUES ('$senderID', '$receiverId', '$message', '$subject')";
	if(mysql_query($query))
	{
		$_SESSION['notice'] = "<p class='success'> Message sent! </p>";
	}
	else
	{
		$_SESSION['notice'] = "<p class='error'> I'm sorry, your message was not able to be sent. Try to resend.</p>"; 
	}
	
	header( "Location: " . $past_page );
}
?>