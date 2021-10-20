<?php
	include "connection.php"; 
	$product = $_GET["productId"]; 
	$productName = connection::getProductName($product); 

    $allIds = connection::getAllIds(); 
	
	if($_GET["productId"]){
		$product = $_GET["productId"]; 
		
		if(!in_array($product, $allIds)){
			header("location: index.php"); 
		}else{
			$productName = connection::getProductName($product);
		}
	}else{
		header("location: index.php"); 
	}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
	<meta charset="utf-8">
	
	<title><?= $productName ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	
	<link rel="stylesheet" href="stylesNav.css">
	<link rel="stylesheet" href="stylesDetails.css">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fanwood+Text&family=Fleur+De+Leah&family=Italianno&family=Merienda&family=Rampart+One&family=Urbanist:ital@0;1&display=swap" rel="stylesheet">	

</head>
<body>
	<?php include "header.php"; ?>
	<div id="main">
		<?php include "mobMenu.php"; ?>
		<?php connection::getProductDetails($product); ?>
	</div>
	<?php include "footer.php"; ?> 
	<script src="mobileMenu.js"></script>
</body>
</html>