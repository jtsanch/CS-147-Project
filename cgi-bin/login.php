<?php
	session_start();
	require_once 'config.php';
	$is_ajax = $_REQUEST['is_ajax'];
	if($is_ajax)
	{	
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
			
		$user = mysql_query("SELECT * FROM Users WHERE email='$email'");
		
		$result = mysql_fetch_array($user);
		
		$salt = $result['salt'];
	
		$hashedPW = crypt($password,$salt);
		
		if($result['password'] == $hashedPW )
		{
			$_SESSION['name'] = $row['name'];
			$_SESSION['logged_in'] = "YES";
			$_SESSION['email'] = $email;
			$_SESSION['login_results'] = "<p class='success'> Login Success </p>";
			echo "success";
		} 
		else
			{
				$_SESSION['login_results'] = "<p class='error'> Wrong username/password </p>";
			}
	}
	else
		echo "failure";
?>