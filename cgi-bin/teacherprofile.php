<?php
session_start();
//everybody can view this page, it's contact that is different
?>
<html>
<head>
	<?php 
		include 'head.php'; 
	?>
</head>
<body>
<?php
	include 'header.php';
?>
<center>
<div id="message">
<?
	/*In the case we have any sort of user feedback on logging in, registering, creating listing, etc*/
	if(isset($_SESSION['message'])) 
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
?>
</div>
</center>
<?php
	require_once 'config.php';
	//Get the teacher id
	if($_GET['teacher_userID'] && $_GET['lessonID'])
	{
		$teacher = mysql_fetch_array(mysql_query("SELECT * FROM Users WHERE userID='" . $_GET['teacher_userID'] . "'"));
		$lessons = mysql_query("SELECT * FROM Lessons WHERE userID='" . $teacher['userID'] . "' AND lessonID='" . $_GET['lessonID'] . "'");
	}
	$user = mysql_fetch_array(mysql_query("SELECT * FROM Users WHERE userID='" . mysql_real_escape_string($_SESSION['userID']) . "'"));
	?>
	<div id="profile_wrapper">
		<div class="notice_top">
			<?php
			if(isset($_SESSION['notice']))
			{
				echo $_SESSION['notice'];
				unset($_SESSION['notice']);
			} else echo "&nbsp;";
			?>
		</div>
	<?php
	//only display "message me" button if they are logged in//
		echo "<center><div id='second_layer_teacher_profile'>";
			echo "<div id='personal_info_container'>";
				echo "<center><div id='teacher_name'> ".strtoupper($teacher['name'])."<br /><a href='mailto:".$teacher['email']."'>".$teacher['email']."</a></div></center>";
				if(isset($_SESSION['logged_in'])) {
				    echo "<div id='message_box'>";
					echo "<a href='#message_popup' data-rel='popup' data-position-to='window' aria-haspopup='true' aria-owns='#message_popup' data-role='button'>";
					echo "Message Me</a></div>";
					}
			echo "</div>";
		echo "</div></center>";
	?>
		<div id="third_layer_profile">
			<div class="lesson_info_container">
				<div class="lesson_info">
					<?php
					if($teacher)
					{
					if($row = mysql_fetch_array($lessons))
					{
						echo "<center>";
						echo "<div class='teacher_section'>";
						echo "<div class='teacher_lesson_header'>Lesson Details</div><br/>";
						echo $row['lesson_description'] . "<br/><br/>";
						echo "<div class='teacher_lesson_header'>Experience</div><br/>";
						echo $row['experience'] . "<br/><br/>";
						echo "<div class='teacher_lesson_header'>Cost</div><br/>";
						echo $row['cost'];
						echo "</div>";
						echo "</center>";
					}
					}
					?>
				</div>
			</div>
			<div class="also_teaches_container">	
				<div class="lesson_info">
					<?php
					if($_GET['teacher_userID'] && $_GET['lessonID'])
					{
						$lessons = mysql_query("SELECT * FROM Lessons WHERE userID='" . $_GET['teacher_userID'] . "' AND lessonID<>'" . $_GET['lessonID'] . "'");
						if($lessons) echo "<center><p class='teacher_lesson_header'>ALSO TEACHES</p></center>";
						echo "<br/>";
						while($row = mysql_fetch_array($lessons))
						{
							$skill = mysql_fetch_array(mysql_query("SELECT * FROM skills WHERE skillId='" . $row['skillID'] . "'"));
							echo "<center><a href='teacherprofile.php?teacher_userID=".$_GET['teacher_userID'] . "&lessonID=" . $row['lessonID'] . "'>" . $skill['skillName'] . "</a></center><br/>";
						}
					}
					?>
				</div>
			</div>
		</div>
		</center>
	</div>
	<div data-role="popup" id="message_popup" class="ui-corner-all" data-position-to="window" data-dismissable="false">
	<form id="message_form" action="processmail.php" method="post">
		<div style="padding:10px 20px;"><?php echo "Sending to : ".$teacher['name'] ?></label></td></tr>
			<input type="hidden" name="sender" id="sender" value="<?php echo $_SESSION['userID']?>" />
			<br/>
			<input type="hidden" name="receiver" id="receiver" value="<?php echo $teacher['userID']?>"/>
			<br/>
			<input type="hidden" name="past_page" id="past_page" value="<?php echo curPageURL() ?>" />
			<input type="text" name="subject" id= "subject" placeholder="Subject..." />
			<textarea cols="60" rows="10" name="message" id="message_textarea" placeholder="Teach me!"></textarea>

	    	<input type="submit" name="send_message" id="send_message" value="Send"></input>
			<a href="#" data-rel="back" data-role="button" data-theme="a">Cancel</a>
		</div>
	</form>
</div>

<div data-role="popup" id="login_popup" data-overlay-theme="b" data-theme="a" class="ui-corner-all" data-position-to="window" data-dismissable="false">
	    <form id="login_form" name="login_form" action="login.php" method="post">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" style=" float:left;">Close</a>
		<div style="padding:10px 20px;">
			<h3>Please sign in</h3>
		    <label for="email" class="ui-hidden-accessible">Username:</label>
		    <input type="text" name="email" id="email" id="un" placeholder="user@email.com" data-theme="a" />

	        <label for="password" class="ui-hidden-accessible">Password:</label>
	        <input type="password" name="password" id="password"  placeholder="password" data-theme="a" />

	    	<input type="submit" id="login" name="login" value="Login"></input>
		</div>
	</form>
</div>


<script type="text/javascript">
$(function(){	

	$("#send_message").click(function() {
		var action = $("#message_form").attr("action");
		var form_data = {
			sender: $("#sender").val(),
			past_page: $("#past_page").val(),
			subject: $("#subject"),
			message: $("#message")};
		
		$.ajax({
				type: "POST",
				url: action,
				data: form_data,
				success: function(response) {
					if( response == "success")
					{
						location.reload();
					}
					else
					{
						location.reload();
					}
				}
				});
			$(this).popup('close');
			return false;
	});
	
	$("#login").click(function() {
		var action = $("#login_form").attr("action");
		var form_data = {
			email: $("#email").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		$.ajax({
				type: "POST",
				url: action,
				data: form_data,
				success: function(response) {
					if( response == "success")
					{
						location.reload();
					}
					else
					{
						location.reload();
					}
				}
			});
		$(this).popup('close');
		return false;
	});
	$("#logout").click(function() {
		var action = $("#logout_button").attr("action");
		$.ajax({
				type: "POST",
				url: action,
				data: 0,
				success: function(response){
					$("$message").html("<p class='success'> You have logged out successfully! </p>");
				}
				});
		return false;
	});
});
</script>

</body>
<footer>

</footer>
</html>