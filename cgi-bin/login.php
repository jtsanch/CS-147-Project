<!DOCTYPE html> 
<html> 
	<head> 
	<title>Page Title</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>
</head> 
<body> 
<?php
	session_start();
	require_once 'config.php';
	$is_ajax = $_REQUEST['is_ajax'];
	if($is_ajax)
	{	
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
			
		$user_rows = mysql_query("SELECT * FROM Users WHERE email='$email'");
		if( mysql_num_rows( $user_rows ) > 0 )
		{
			
			$user = mysql_fetch_array($user_rows);
			
			$salt = $user['salt'];
	
			$hashedPW = crypt($password,$salt);
		
			if($user['password'] == $hashedPW )
			{
				$_SESSION['name'] = $user['name'];
				$_SESSION['logged_in'] = true;
				$_SESSION['userID'] = $user['userID'];
				$_SESSION['message'] = "<p class='success'> Login Success </p>";
				echo "success";
			} 
			else
				{
					$_SESSION['message'] = "<p class='error'> Wrong username/password </p>";
					echo "failure";
				}
		}
		else
			{
				$_SESSION['message'] = "<p class='error'> Wrong username/password </p>";
				echo "failure";
			}
	}
	else
		echo "failure";
?>
<div data-role="page">

	<div data-role="header">
		<h1>Page Title</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<p>Page content goes here.</p>		
	</div><!-- /content -->

	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
