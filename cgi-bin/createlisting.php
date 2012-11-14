w<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
	die("To access this page, you need to <a href='index.php'>LOGIN</a>");
}
?>
<html>
<head>
	<?php include 'head.php'?>
</head>
<body>
<?php
	include 'header.php';
?>
<?php
if($_POST)
{
	require_once 'config.php';
	
	$email = mysql_real_escape_string($_SESSION['email']);
	$user = mysql_fetch_array(mysql_query("SELECT userID FROM Users WHERE email='{$email}'"));
	$userID = $user['userID'];
	
	$skillName = mysql_real_escape_string($_POST['skillName']);
	$skill = mysql_fetch_array(mysql_query("SELECT skillID FROM skills WHERE skillName='" . $skillName . "'"));
	$skillID = NULL;
	$category = mysql_real_escape_string($_POST['category']);
	$categoryId = mysql_fetch_array(mysql_query("Select categoryId from categories where category='$category'"));
	
	if(!$skill)
	{
		mysql_query("INSERT INTO skills (skillName,categoryID) VALUES ('$skillName','$categoryId)");
		$skill = mysql_fetch_array(mysql_query("SELECT skillID FROM skills WHERE skillName='" . $skillName . "'"));
	}
	$skillID = $skill['skillID'];
	$lesson_description = mysql_real_escape_string($_POST['lesson_description']);
	$experience = mysql_real_escape_string($_POST['experience']);
	$cost = mysql_real_escape_string($_POST['cost']);
	if(mysql_query("INSERT INTO Lessons (userID,lesson_description,experience,cost,skillID,categoryId) VALUES ('$userID','$lesson_description','$experience','$cost','$skillID','$categoryId')"))

		$_SESSION['notice'] = "Listing created!";
		$_SESSION['wait_for_redirect'] = "WAIT!";
		echo "<script>$(function(){window.location.href='http://www.stanford.edu/~jtsanch/cgi-bin/skill-searcher/profile.php'});</script>";
	} else {
		$_SESSION['notice'] = "You messed up somewhere";
	}
}
?>
<div class="notice_top">
<?php
	if(isset($_SESSION['notice']))
	{
		echo $_SESSION['notice'];
		if(!$_SESSION['wait_for_redirect']) unset($_SESSION['notice']);
	} else echo "&nbsp;";
?>
</div>
<br>
<form action="createlisting.php" method="post">
	<div style="padding:10px 20px;">
		<h3>Create Listing</h3>
        <label for="sk" class="ui-hidden-accessible">Skill</label>
        <input type="text" name="skillName" id="sk" value="" placeholder="Skill" />
		<br />
		<label for="ld" class="ui-hidden-accessible">Lesson Description</label>
        <textarea cols="40" rows="8" name="lesson_description" id="ld" value="" placeholder="Lesson Description"></textarea>
        <br />
		<label for="select-choice-0" name="category" class="select">Category:</label>
			<select name="select-choice-0" id="select-choice-0">
			<option value="sports">Sports</option>
			<option value="music">Music</option>
			<option value="writing">Art</option>
			<option value="academics">Academics</option>
			<option value="crafts">Crafts</option>
			<option value="miscellaneous">Miscellaneous</option>
		</select>
		<label for="exp" class="ui-hidden-accessible">Experience</label>
        <textarea cols="40" rows="8" name="experience" id="exp" value="" placeholder="Experience"></textarea>
		<br />
		<label for="cst" class="ui-hidden-accessible">Cost Per Hour</label>
        <input type="text" name="cost" id="cst" value="" placeholder="Cost Per Hour"  />
		<br />
		<div class="profile_option">
			<button type="submit" data-theme="b">create</button>
		</div>
	</div>
</form>
</body>
</html>