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
<div id="content">
	<form action="search.php" method="post">
		<div data-role="fieldcontain">
			<label for="search">Search for specific activity</label>
			<input type="search" name="skill_search" id="skill_search" value="" placeholder="tennis" />
			<br/>
			<center>
			<button type="submit" data-theme="b">Search</button>
			</center>
		</div>
	</form>
	<?php
	echo "<ul dataorole='listview'>";
	
	require_once "config.php";
	
	$categories = mysql_query("SELECT * FROM categories");
	
	while( $categoryRow = mysql_fetch_assoc($categories ) )
	{
		echo "<ul data-role='listview'>";
		echo "<li><a> ".$categoryRow['categoryName']." </a></li>";
		echo "<ul>";
		$skills = mysql_query("SELECT * FROM categories WHERE categoryId='$categoryId'");
		while( $row = mysql_fetch_assoc($skills) ){
			
			echo "<li><a href='search.php?target=".$row['skillName']."></li>";
		}
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";
	?>
</div>
</body>
</html>