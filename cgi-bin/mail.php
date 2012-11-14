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


<div data-role="controlgroup" data-type="horizontal">
			<a href="#" data-role="button" id="inbox_button">Inbox</a>
			<a href="#" data-role="button" id="outbox_button">Outbox</a>
		</div>

<br><br>

<div id="inbox">
	
	<?php
	$email = $_SESSION['email'];
	//$email = "shaurya@stanford.blah";

	require_once 'config.php';
	
	$user = mysql_query("SELECT * FROM Mail WHERE EmailTo ='$email'");
	$result = mysql_fetch_array($user);
	
	$id = mysql_real_escape_string($_SESSION['email']);
	$sql = "SELECT * FROM Mail WHERE EmailTo='$email'";
	$res = mysql_query($sql) or die(mysql_error());
	

	if (mysql_num_rows($res) == 0) {
		echo "You haven't got any messages to display";
	}
	?>

	<div id="content">

	<ul data-role="listview">
				<?php
				//$_SESSION['EmailTo'] = $row['EmailTo'];
				//$_SESSION['Subject'] = $row['Subject'];
				//$_SESSION['Message'] = $row['Message'];
				while ($row = mysql_fetch_assoc($res)) {
    				echo "<form action='messagedisplay.php' method='post'>";
    				echo "<input type='hidden' name='EmailTo' value='" . $row['EmailTo'] . "'>";
    				echo "<input type='hidden' name='Subject' value='" . $row['Subject'] . "'>";
    				echo "<input type='hidden' name='Message' value='" . $row['Message'] . "'>";
    				echo "<button type ='submit' >";
    				echo "To: ";
    				echo $row['EmailTo'];
    				echo "<br/> Subject: ";
    				echo $row['Subject'];
    				echo "</button>";
    				echo "</form>";
				}
				?>
		</ul>
	</div>
</div>

<div id="outbox" class="hide">
	
	<?php
	//$email = $_SESSION['email'];
	$email = "shaurya@stanford.blah";

	require_once 'config.php';
	
	$user = mysql_query("SELECT * FROM Mail WHERE EmailFrom ='$email'");
	$result = mysql_fetch_array($user);
	
	$id = mysql_real_escape_string($_SESSION['email']);
	$sql = "SELECT * FROM Mail WHERE EmailFrom='$email'";
	$res = mysql_query($sql) or die(mysql_error());
	

	if (mysql_num_rows($res) == 0) {
		echo "You haven't got any messages to display";
	}
	?>

	<div id="content">

	<ul data-role="listview">
				<?php
				//$_SESSION['EmailTo'] = $row['EmailTo'];
				//$_SESSION['Subject'] = $row['Subject'];
				//$_SESSION['Message'] = $row['Message'];
				while ($row = mysql_fetch_assoc($res)) {
    				echo "<form action='messagedisplay.php' method='post'>";
    				echo "<input type='hidden' name='EmailTo' value='" . $row['EmailTo'] . "'>";
    				echo "<input type='hidden' name='Subject' value='" . $row['Subject'] . "'>";
    				echo "<input type='hidden' name='Message' value='" . $row['Message'] . "'>";
    				echo "<button type ='submit' >";
    				echo "To: ";
    				echo $row['EmailTo'];
    				echo "<br/> Subject: ";
    				echo $row['Subject'];
    				echo "</button>";
    				echo "</form>";
				}
				?>
		</ul>
	</div>
</div>


</body>
<footer>
	<script>
	 $(function() {
	 	$("#outbox_button").click(function() {
	 		if($("#outbox").hasClass("hide"))
	 		{
	 			$("#outbox").removeClass("hide");
	 			$("#inbox").addClass("hide");
	 		}
	 	});
	 	$("#inbox_button").click(function() {
	 		if($("#inbox").hasClass("hide")) 
	 		{
	 			$("#inbox").removeClass("hide");
	 			$("#outbox").addClass("hide");
	 		}
	 	});

	 });
	</script>
</footer>

</html>