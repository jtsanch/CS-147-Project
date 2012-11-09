<div data-role="header" class="ui-header ui-bar-a header_extra_style" >
	<a data-role="button" data-direction="reverse" data-rel="back" data-icon="arrow-l" data-iconpos="left">
            Back
    </a>
	<center>
		Skill Searcher
	</center>
<?php
if(isset($_SESSION['logged_in']))
{	
	echo "<a href='logout.php' class='logout_button' action='logout.php'>";
    echo "Logout";
	echo "</a>";
}
?>

</div>

<!--This div will be responsible for holding the username/logout, or the login_in if they are not logged in-->
<div data-role="navbar">
	<ul>
		<li><a href="index.php" id="home" data-icon="home">Home</a></li>
		<?php
		if(isset($_SESSION['logged_in']))
		{
			echo "<li><a href='mail.php' id='email' data-icon='mail-icon'>Mail</a></li>";
			echo "<li><a href='profile.php' data-icon='custom' id='profile'>";
			echo "Profile</a></li>";
		}
		else
		{
			echo "<li><a href='#login_popup' data-icon='custom' data-rel='popup'";
			echo "data-transition='slidedown' id='login_button'>Login</a></li>";
			echo "<li><a href='createprofile.php' data-icon='custom'";
			echo "data-transition='slidedown' id='register_button'>Register</a></li>";
		}
	?>
	</ul>
</div>
