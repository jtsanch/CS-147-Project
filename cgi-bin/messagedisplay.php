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
		if($_POST['EmailTo'] && $_POST['Subject'] && $_POST['Message'])
		{
			$emailTo = mysql_real_escape_string($_POST['EmailTo']);
			$subject = mysql_real_escape_string($_POST['Subject']);
			$message = mysql_real_escape_string($_POST['Message']);
			echo "To: ";
			echo $emailTo;
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