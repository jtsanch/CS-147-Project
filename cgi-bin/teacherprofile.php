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
	$lesson_id = $_GET['lessonID'];
	if($_GET['teacher_userID'] && $_GET['lessonID'])
	{
		$teacher = mysql_fetch_array(mysql_query("SELECT * FROM Users WHERE userID='" . $_GET['teacher_userID'] . "'"));
		$lessons = mysql_query("SELECT * FROM Lessons WHERE lessonID='" . $_GET['lessonID'] . "'");
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

		<div id='second_layer_teacher_profile'>
			<div id='personal_info_container'>
				<div id='teacher_name'> <?echo strtoupper($teacher['name']);?><br /><a href='mailto:<?echo $teacher['email'];?>'><? echo $teacher['email']; ?></a></div>
				<?php
				if(isset($_SESSION['logged_in'])) {
				    echo "<div id='message_box'>";
					echo "<a href='#message_popup' data-rel='popup' data-position-to='window' aria-haspopup='true' aria-owns='#message_popup' data-role='button'>";
					echo "Message Me</a></div>";
					}
				?>
				<br/>
					<!-- Handle the review system-->
					<div id="rating-system">
						<?php
							//never have been rating before
							$rating = $teacher['rating'];
							if( $rating == -1 ) {
								echo "This user has no ratings <br/>";
							}
							else{
								echo "<div id='stars'>";
								for( $i = 0; $i < $rating; ++$i){
									echo "<img src='icons/star.png' />";
								}
								echo "</div><br/>";
							}
						?>
					<a href="#rate_popup" data-rel="popup" data-position-to="window"  data-role="button"> Rate this Teacher! </a>
					<br/>
				</div>
			</div>
		</div>
	
		<div id="third_layer_profile">
			<div class="lesson_info_container">
				<div class="lesson_info">
					<?php
					if($teacher)
					{
					if($row = mysql_fetch_array($lessons))
					{
						echo "<div class='teacher_section'>";
						echo "<div class='teacher_lesson_header'>Lesson Details</div><br/>";
						echo $row['lesson_description'] . "<br/><br/>";
						echo "<div class='teacher_lesson_header'>Experience</div><br/>";
						echo $row['experience'] . "<br/><br/>";
						echo "<div class='teacher_lesson_header'>Cost</div><br/>";
						echo $row['cost'];
						echo "</div>";
					}
					}
					?>
			<div class="teacher_ratings">
			<?php
				$ratings = mysql_query("SELECT * FROM Ratings WHERE teacher='".$teacher['userID']."'");
				if(mysql_num_rows( $ratings ) > 0 ){
					if($rating = mysql_fetch_array($ratings))
					{
						echo "<div id = 'rating_box'>";
						for( $i = 0; $i < $rating['ratingStars']; ++$i){
							echo "<img src='icons/star.png'/>";
						}
						echo "<br/>".$rating['ratingContent'];
						echo "</div>";
					}
				} else {
					echo "<div id='no_rating'> Sorry, this user has no ratings </div>";
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
						if(mysql_num_rows($lessons) > 0 ) echo "<p class='teacher_lesson_header'>I also teach</p>";
						while($row = mysql_fetch_array($lessons))
						{
							$skill = mysql_fetch_array(mysql_query("SELECT * FROM skills WHERE skillId='" . $row['skillID'] . "'"));
							echo "<a href='teacherprofile.php?teacher_userID=".$_GET['teacher_userID'] . "&lessonID=" . $row['lessonID'] . "'>" . $skill['skillName'] . "</a><br/>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
<div data-role="popup" id="message_popup" class="ui-corner-all" data-position-to="window" data-dismissable="false">
	<form id="message_form" action="processmail.php" method="post">
		<div style="padding:10px 20px; color:black !important;"><?php echo "Sending to : ".$teacher['name'] ?></label></td></tr>
			<input type="hidden" name="sender" id="sender" value="<?php echo $_SESSION['userID']?>" />
			<br/>
			<input type="hidden" name="receiver" id="receiver" value="<?php echo $teacher['userID']; ?>"/>
			<input type="hidden" name="lesson_id" id="lesson_id" value="<?php echo $lesson_id; ?>"/>
			<input type="hidden" name="past_page" id="past_page" value="<?php echo curPageURL() ?>" />
			<input type="text"  style='color:black !important;' name="subject" id= "subject" placeholder="Subject..." />
			<textarea cols="60" style='color:black !important;' rows="10" name="message" id="message_textarea" placeholder="Teach me!"></textarea>

	    	<input type="submit" name="send_message" id="send_message" value="Send"></input>
			<a href="#" data-rel="back" data-role="button" data-theme="a">Cancel</a>
		</div>
	</form>
</div>
<div data-role="popup" id="rate_popup" class="ui-corner-all" data-position-to="window" data-dismissable="false">
	<form id="rating_form" action="rate.php" method="post">
		<div style="padding:10px 20px; color:black !important;">
		<?php echo "Rating ".$teacher['name'] ?>
			<input type="hidden" name="rated_teacher" id="sender" value="<?php echo $teacher['userID']; ?>" />
			<input type="hidden" name="actual_rating" id="actual_rating" value="0"/>
			<div data-role="controlgroup" data-type="horizontal">
			<div class="rating">
				<span id='one'>&#9734;</span><span id='two'>&#9734;</span><span id='three'>&#9734;</span><span id='four'>&#9734;</span><span id='five'>&#9734;</span>
			</div>
			<textarea cols="60" rows="5" name="rating_text" id="rating_text" placeholder="Thanks for your lesson!"></textarea>

	    	<input type="submit" name="rate_user" id="rate_user" value="Rate!"></input>
			<a href="#" data-rel="back" data-role="button" data-theme="a">Cancel</a>
		</div>
	</form>
</div>
<script>
	$("#one").click(function() {
	  $("#actual_rating").val(1);	
	  $("#one").html("&#9733;");
	  $("#two").html("&#9734;");
	  $("#three").html("&#9734;");
	  $("#four").html("&#9734;");
	  $("#five").html("&#9734;");
	});
	$("#two").click(function() {
	  $("#actual_rating").val(2);	
	  $("#one").html("&#9733;");
	  $("#two").html("&#9733;");
	  $("#three").html("&#9734;");
	  $("#four").html("&#9734;");
	  $("#five").html("&#9734;");
	});
	$("#three").click(function() {
	  $("#actual_rating").val(3);	
	  $("#one").html("&#9733;");
	  $("#two").html("&#9733;");
	  $("#three").html("&#9733;");
	  $("#four").html("&#9734;");
	  $("#five").html("&#9734;");
	});
	$("#four").click(function() {
	  $("#actual_rating").val(4);	
	  $("#one").html("&#9733;");
	  $("#two").html("&#9733;");
	  $("#three").html("&#9733;");
	  $("#four").html("&#9733;");
	  $("#five").html("&#9734;");
	});
	$("#five").click(function() {
	  $("#actual_rating").val(5);	
	  $("#one").html("&#9733;");
	  $("#two").html("&#9733;");
	  $("#three").html("&#9733;");
	  $("#four").html("&#9733;");
	  $("#five").html("&#9733;");
	});
</script>
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
			lesson_id: $("#lesson_id"),
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
	$("#rate_user").click(function() {
		var action = $("#rate_form").attr("action");
		var form_data = {
			teacher: $("#rated_teacher").val(),
			rating_stars: $("#actual_rating").val(),
			rating_text: $("#rating_text").val(),
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
						window.location.href = 'teacherprofile.php';
					}
					else
					{
						window.location.href = 'teacherprofile.php';
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