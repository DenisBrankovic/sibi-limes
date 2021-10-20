<?php 
	include "connection.php";
?>
<!DOCTYPE html>
<html lang="bs">
<head>
	<meta charset="utf-8">
	
	<title>Sibi-Limes</title>
	
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	
	<link rel="stylesheet" href="stylesNav.css">
	<link rel="stylesheet" href="stylesIndex.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fanwood+Text&family=Fleur+De+Leah&family=Italianno&family=Merienda&family=Rampart+One&family=Urbanist:ital@0;1&display=swap" rel="stylesheet">
			
</head>
<body>
	<div id="top">
		<?php include "header.php"; ?>
		<div class="title" id="title1">Proizvodi</div>
		<div class="title" id="title2">na bazi</div>
		<div class="title" id="title3">ljekovitog</div>
		<div class="title" id="title4">bilja</div>
		<img src="pictures/front.jpg" alt="limes"/>
	</div>
	<?php include "mobMenu.php"; ?>
	<div id="middle">		
		<div class="middleText">
			<div class="middleTextPic"><img class="mp" src="pictures/plant.png" alt="plant"/></div>
				<div class="middleTextText">
					<p class="mt">Šezdeset vrsta proizvoda za kozmetiku, ličnu i kućnu higijenu</p>
				</div>
		</div>
		<div class="middleText">
			<div class="middleTextPic"><img class="mp" src="pictures/plant2.png" alt="plant"/></div>
			<div class="middleTextText">
				<p class="mt">Na bazi ekstrakta ljekovitog bilja, biorazgradivi, bez alkalija i fosfata</p>
			</div>
		</div>
		<div class="middleText">
			<div class="middleTextPic"><img class="mp" src="pictures/plant3.png" alt="plant"/></div>
			<div class="middleTextText">
				<p class="mt">Ekstrakti nevena, bosiljka, kantariona, kamilice, lipe, žalfije, koprive, hajdučke trave, bršljana</p>
			</div>
		</div>
	</div>
	<div id="middleMob">
		<div class="middleTextMob">
			<div class="middleTextPicMob"><img class="mpMob" src="pictures/plant.png" alt="plant"/></div>
				<div class="middleTextTextMob">
					<p class="mtMob">Šezdeset vrsta proizvoda za kozmetiku, ličnu i kućnu higijenu</p>
				</div>
		</div>
		<div class="middleTextMob">
			<div class="middleTextPicMob"><img class="mpMob" src="pictures/plant2.png" alt="plant"/></div>
			<div class="middleTextTextMob">
				<p class="mtMob">Na bazi ekstrakta ljekovitog bilja, biorazgradivi, bez alkalija i fosfata</p>
			</div>
		</div>
		<div class="middleTextMob">
			<div class="middleTextPicMob"><img class="mpMob" src="pictures/plant3.png" alt="plant"/></div>
			<div class="middleTextTextMob">
				<p class="mtMob">Ekstrakti nevena, bosiljka, kantariona, kamilice, lipe, žalfije, koprive, hajdučke trave, bršljana</p>
			</div>
		</div>
	</div>
	<div id="categoriesWrapper">
		<?= connection::getCategories(); ?>
		<?php include "footer.php"; ?>
	</div>
	<script src="frontPage.js">
		
	</script>
</body>
</html>