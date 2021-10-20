<?php
	
	include "connection.php"; 
	$category = $_GET["category"];

    $allCategories = connection::getCategoryList(); 
	if(!in_array($category, $allCategories)){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
	<meta charset="utf-8">
	
	<title><?= $category ?></title>
	
	<link rel="stylesheet" href="stylesNav.css">
	<link rel="stylesheet" href="stylesProducts.css">
	
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fanwood+Text&family=Fleur+De+Leah&family=Italianno&family=Merienda&family=Rampart+One&family=Urbanist:ital@0;1&display=swap" rel="stylesheet">
			
	
</head>
<body>
	<?php include "header.php"; ?>	
	<div id="wrapper">
		<?php include "mobMenu.php"; ?>
		<?= connection::getProductsByCategory($category); ?>
	</div>
	
	<script src="mobileMenu.js"></script>
</body>
<?php include "footer.php"; ?>
</html>