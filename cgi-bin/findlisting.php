<?php
	session_start();
?>
<html>
<head>
	<?php include 'head.php';?>
	<script type="text/javascript">   
	$(':jqmData(url^=findlisting.php#)').live('pagebeforecreate', function(event) {
		$(this).filter(':jqmData(url*=ui-page)').find(':jqmData(role=header)')
		.prepend('<a href="#" data-rel="back" data-icon="back">Back</a>')
		});	
	</script>  
</head>
<body>
<?php
	include 'header.php';
?>
<br><br>
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
<div id="content">
<form action="search.php" method="post">
		<div data-role="fieldcontain">
			<input type="search" name="skill_search" id="skill_search" value="" placeholder="Search..." />
			<br/>

		</div>
	</form>
	<?php
	echo "<ul data-role='listview'>";
	require_once "config.php";
	
	$categories = mysql_query("SELECT * FROM categories");
	//final var
	while( $categoryRow = mysql_fetch_assoc($categories ) )
	{
		//get the category
		echo "<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-has-count ui-btn-up-c' ><h2> ".$categoryRow['categoryName']." </h2>";
		$categoryId = $categoryRow['categoryID'];
		$skills = mysql_query("SELECT * FROM skills WHERE categoryID='$categoryId'");
		echo "<span class='ui-li-count ui-btn-up-c ui-btn-corner-all'>".mysql_num_rows($skills)."</span>";
		echo "<ul>";
		while( $row = mysql_fetch_assoc($skills) )
		{
			//construct the inner list of skills that are attached to that
			echo "<li ><a href='search.php?target=".$row['skillName']."'>".$row['skillName']."</a></li>";
		}
		echo "</ul></li>";
	}
	echo "</ul>";
	?>
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
</html>