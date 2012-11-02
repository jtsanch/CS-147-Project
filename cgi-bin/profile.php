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
	<div id="first_layer_profile">
		<h1 id="profile_header">User Profile</h1>
	</div>
	<div id="mini_nav">
		<ul style="list-style-type:none;float:left;">
			<li>Hi, NAME</li>
		</ul>
		<ul style="list-style-type:none;float:right;padding-right:15px">
			<li style="display:inline;"><a href="index.html">Home</a></li>
			&nbsp; &nbsp;
			<li style="display:inline;"><a href="editprofile.html">Edit</a></li>
			&nbsp; &nbsp;
			<li style="display:inline;"><a href="mail.html">Mail</a></li>
			&nbsp; &nbsp;
			<li style="display:inline;"><a href="#">Logout</a></li>
		</ul>
	</div>
	<div id="profile_wrapper">
		<div style="padding-left:10px;padding-bottom:10px;">&nbsp;</div>
		<div id="second_layer_profile">
			<div id="user_pic_container"><img src="user.png" id="user_pic" /></div>
			<div id="personal_info_container">
				<table id="personal_info">
					<tr><td>NAME</td></tr>
					<tr><td>CONTACT INFO</td></tr>
					<tr><td>OTHER PERSONAL INFO</td></tr>
				</table>
			</div>
		</div>
		<div id="third_layer_profile">
			<div id="lesson_info_container">
				<table id="lesson_info">
					<tr><td>MANAGE LESSONS</td></tr>
					<tr><td>COST PER HOUR (for teacher)</td></tr>
					<tr><td>EXPERIENCE (for teacher)</td></tr>
					<tr><td>LOCATION OF LESSONS(for teacher)</td></tr>
					<tr><td>OTHER INFO</td></tr>
				</table>
			</div>
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