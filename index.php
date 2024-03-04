<?php include('include/config.php');	?>
<?php include('include/insert.php');	?>
<html>
	<head>
	<title>Fruitsemble</title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<!-- HEADER -->
	<?php include('templates/header.php');	?>
	
	<!-- MENU -->
	<?php include('templates/menu.php');	?>
	
	<!-- CONTENT -->
	<?php
	$query = mysqli_query($sql, "SELECT * FROM tbl_articles");
	while($row = mysqli_fetch_assoc($query))
	{
		$title = $row['title'];
		$content = $row['content'];
	}?>
	<h1><?php echo $title;	?></h1>
	<p><?php echo $content;	?></p>
	
	<!-- FOOTER -->
	<?php include('templates/footer.php');	?>
	</body>
</html>