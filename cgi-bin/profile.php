<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
	die("To access this page, you need to <a href='index.php'>LOGIN</a>");
}
?>
<html>
<head>
    <title>Skill Searcher</title>
    <link rel="Stylesheet" rev="Stylesheet" href="css/main.css" /> 

    <meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />

	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>
</head>
<body>
<div data-role="header" class="ui-header ui-bar-a header_extra_style">
	<center>
		Skill Searcher
	</center>
</div>
<div id="navigation_bar">
	<!--This div will be responsible for holding the username/logout, or the login_in if they are not logged in-->
	<div data-role="navbar">
		<ul>
			<li><a href="index.php" id="home" data-icon="home-icon">Home</a></li>
			<li><a href="mail.php" id="email" data-icon="mail-icon">Mail</a></li>
			<li><a href="profile.php" data-icon="custom" class="ui-btn-active">Profile</a></li>
		</ul>
	</div>
</div>
	<div id="first_layer_profile">
		<h1 id="profile_header">User Profile</h1>
	</div>
	<div id="mini_nav">
		<ul style="list-style-type:none;float:left;">
			<li>Hi, <?php echo $_SESSION['name'] ?></li>
		</ul>
		<ul style="list-style-type:none;float:right;padding-right:15px">
			<li style="display:inline;"><a href="editprofile.php">Edit</a></li>
		</ul>
	</div>
	<div id="profile_wrapper">
		<div style="padding-left:10px;padding-bottom:10px;">&nbsp;</div>
		<div id="second_layer_profile">
			<div id="user_pic_container"><img src="user.png" id="user_pic" /></div>
			<div id="personal_info_container">
				<table id="personal_info">
					<tr><td>NAME</td></tr>
					<tr><td>EMAIL</td></tr>
					<tr><td>LOCATION</td></tr>
				</table>
			</div>
		</div>
		<br /><br />
		<div id="third_layer_profile">
			<div class="lesson_info_container">
				<table class="lesson_info">
					<tr><td><u><strong>TEACHING</strong></u></td></tr>
					<tr><td>LESSON DESCRIPTION (for teacher)</td></tr>
					<tr><td>EXPERIENCE (for teacher)</td></tr>
					<tr><td>COST PER HOUR (for teacher)</td></tr>
				</table>
			</div>
			<a href="createlisting.php" data-role="button">Create Listing</a>
			<br />
			<br />
			<br />
			<div class="lesson_info_container">	
				<table class="lesson_info">
					<tr><td><u><strong>LEARNING</strong></u></td></tr>
					<tr><td>LESSON DESSCRIPTION (for teacher)</td></tr>
					<tr><td>EXPERIENCE (for teacher)</td></tr>
					<tr><td>COST PER HOUR (for teacher)</td></tr>
				</table>
			</div>
			<a href="createlisting.php" data-role="button">Create Listing</a>
		</div>
		<div id="fourth_layer_profile">
			<div id="availability_info_container">
				<table id="availability_info">
					<tr><td>AVAILABILITY CALENDAR</td></tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>