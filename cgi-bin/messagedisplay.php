<?php
	session_start();
?>
<html>
<head>
	<?php include 'head.php'?>
</head>
<body>
<?php
	include 'header.php';
?>
<br><br>
<div id="content">
	<?php
		require_once 'config.php';
		if($_POST)
		{
			$subject = mysql_real_escape_string($_POST['Subject']);
			$message = mysql_real_escape_string($_POST['Message']);
			if($_POST['EmailTo'])
			{
				$emailToId = mysql_real_escape_string($_POST['EmailTo']);
				$emailTo = mysql_fetch_array(mysql_query("SELECT * FROM Users where userID='$emailToId'"));
				echo "To: ";
				echo $emailTo['name'];
			}
			else
			{
				$emailFrom = mysql_real_escape_string($_POST['EmailFrom']);
				echo "From: ";
				echo $emailFrom;
			}
			echo "<br/>";
			echo "<br/>";
			echo "Subject: ";
			echo $subject;
			echo "<br/>";
			echo "<br/>";
			echo "Message:";
			echo "<br/>";
			echo $message;
			
		}

	?>

</div>
</body>
</html>