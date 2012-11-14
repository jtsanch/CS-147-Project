<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
	//die("To access this page, you need to <a href='index.php'>LOGIN</a>");
	$_SESSION['login_results'] = "<p class='error'> You need to Login to view this page </p>";
	header( 'Location: index.php' ) ;
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
$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147meseker', 'ceivohng');
mysql_select_db('c_cs147_meseker');
$user = mysql_fetch_array(mysql_query("SELECT * FROM Users WHERE userID='" . $_SESSION['userID'] . "'"));

$lessons = mysql_query("SELECT * FROM Lessons WHERE userID='" . $user['userID'] . "'");

$all_inmail = mysql_query("SELECT * FROM Mail WHERE EmailTo='" . $user['email'] . "'");
$num_messages = mysql_num_rows($all_inmail);
?>
	<div id="mini_nav">
		<ul style="list-style-type:none;float:left;">
			<li><strong>Hi, <?php echo $_SESSION['name'] ?></strong></li>
		</ul>
		<ul style="list-style-type:none;float:right;padding-right:5px">
			<li style="display:inline;"><a href="mail.php">Mail (<?php echo $num_messages ?>)</a></li>
		</ul>
	</div>
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
		<div id="second_layer_profile">
			<!--<div id="user_pic_container"><img src="user.png" id="user_pic" /></div>-->
			<!--<div id="personal_info_container">

			</div> -->
			<br/>
			<div class="lesson_info">
					<div class="profile_name_header">I'M TEACHING</div><br/>
					<?php
					while($row = mysql_fetch_array($lessons))
					{
						echo "<div class='profile_lesson_header'>Lesson</div>";
						echo $row['lesson_description'] . "<br/><br/>";
						echo "<div class='profile_lesson_header'>Experience</div>";
						echo $row['experience'] . "<br/><br/>";
						echo "<div class='profile_lesson_header'>Cost</div>";
						echo $row['cost'] . "<br/>";
						echo "<form action='editprofile.php' method='post'>";
						echo "<input type='hidden' name='lessonID' value='" . $row['lessonID'] ."'>";
						echo "<input type='hidden' name='dont_update' value='dont_update'>";
						echo "<div data-role='controlgroup' data-type='horizontal'>";
						echo "<button type='submit'>Edit Lesson</button>";
						echo "</div>";
						echo "</form>";
						echo "<br/><hr noshade size=1><br/><br/>";
					}
					?>
				</div>
			<div class="profile_option">
				<a href="createlisting.php" data-role="button">Create Listing</a>
			</div>
			<br/>
		</div>

		<div id="third_layer_profile">
			<!--<div class="lesson_info_container">
				
			</div>-->
			<div class="profile_footer">

				<br/>
				<div class="lesson_info">
					<!--<div class="profile_name_header">I'M LEARNING</div><br/>-->
				</div>
				<div class="profile_option">
					<a href="findlisting.php" data-role="button">Find a Teacher</a>
				</div>
				</table>

		</div>
	</div>
</body>
</html>