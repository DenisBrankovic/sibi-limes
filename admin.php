<?php
	session_start();
	
	include "connection.php";
		
	$infoLeft = ""; 
	$infoRight = ""; 
	$info = ""; 
	$additionalInfoRight = ""; 
	
	//Category selection and product selection on the right 
	
	if(isset($_POST["categoryBtn"])){
		$_POST["productBtn"] = null;
		
		if(isset($_POST["ctgSelect"])){
			$category = $_POST["ctgSelect"];
			$_SESSION["category"] = $category;
		}else{
			$infoRight = "Kategorija nije odabrana."; 
		}
				
		$nameRight = null; 
		$descriptionRight = null;
		$priceRight = null;
		$pictureRight = null;
		$instructionsRight = null; 
	}
			
	$categories = connection::getCategoryList(); 
	$categoriesReindexed = array();
		
	
	foreach($categories as $ctg){
		array_push($categoriesReindexed, $ctg);
		
	}
	
	if(isset($category)){
		$products = connection::getProductListByCategory($category);
	}
		
	
	if(isset($_POST["productBtn"]) && isset($_POST["productSelect"])){
		$productName = $_POST["productSelect"];
		$product = connection::getProductByName($productName);	 
		
		$_SESSION["productName"] = $productName; 
		
		$info = ""; 
		$nameRight = $product["productName"];
		$descriptionRight = $product["description"];
		$priceRight = $product["price"];
		$pictureRight = $product["picture"];
		$instructionsRight = $product["instructions"]; 	
		$additionalInfoRight = $product["additionalInfo"]; 
	}else{
		$nameRight = null; 
		$descriptionRight = null;
		$priceRight = null;
		$pictureRight = null;
		$instructionsRight = null;
	}
	
	//File upload
		
	if(isset($_POST["upload"])){
		$file = $_FILES["file"];
		
		$fileName = $file["name"];
		$fileTmpName = $file["tmp_name"];
		$fileSize = $file["size"];
		$fileError = $file["error"];
		$fileType = $file["type"];
		
		$fileExt = explode('.', $fileName); 
		$fileActualExt = strtolower(end($fileExt));
		
		$allowed = array('jpg', 'png');
		
		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0){
				if($fileSize < 5000000){
					$fileNameNew = $fileExt[0].".".$fileActualExt;
					$fileDestination = 'pictures/'.$fileNameNew; 
					move_uploaded_file($fileTmpName, $fileDestination); 
					 
					$info = "File je uspješno sačuvan."; 
				}else{
					$info = "Veličina fajla prevazilazi dozvoljeni limit."; 
				}
			}else{
				$info = "Došlo je do greške pri postavljanju fajla."; 
			}
		}else{
			$info = "Ovaj tip fajlova nije podržan."; 
		}
	}
	
	//New product 
		
	if(isset($_POST["submit"])){
		$category = $_POST["categoryLeft"];
		$productName = $_POST["nameLeft"];
		$description = $_POST["descriptionLeft"];
		$price = $_POST["priceLeft"];
		$picture = $_POST["pictureLeft"];
		$instructions = $_POST["instructionsLeft"];
		$additionalInfo = $_POST["additionalInfoLeft"]; 
		
		$p1 = new products(); 
		$p1->category = $category;
		$p1->productName = $productName;
		$p1->description = $description;
		$p1->price = $price;
		$p1->picture = "pictures/".$picture;
		$p1->instructions = $instructions;
		$p1->additionalInfo = $additionalInfo;
		
		if(connection::newProduct($p1)){
			$infoLeft = "Novi proizvod je uspješno unesen.";
		}
	}else{
		$infoLeft = "";
	}
	
	//Product modification 
		
		if(isset($_POST["modifyBtn"])){
			if(isset($_SESSION["productName"]) && isset($_SESSION["category"])){
				$productName = $_SESSION["productName"]; 
				$category = $_SESSION["category"];
			}else{
				exit("Kategorija i proizvod moraju biti selektovani prije unošenja izmjena."); 
			}
			if(!$_POST["nameRight"] == ""){
				$newName = $_POST["nameRight"];
			}else{
				exit("Polje 'Naziv proizvoda' je obavezno. Promjene nisu sačuvane."); 
			}
			$descriptionRight = $_POST["descriptionRight"];
			$priceRight = $_POST["priceRight"];
			$pictureRight = $_POST["pictureRight"];
			$instructionsRight = $_POST["instructionsRight"];
			$additionalInfoRight = $_POST["additionalInfoRight"]; 
						
			$result = connection::modifyProduct($productName, $category, $newName, $descriptionRight, $priceRight, $pictureRight, $instructionsRight, $additionalInfoRight);
				if($result){
					$descriptionRight = "";
					$priceRight = "";
					$pictureRight = ""; 
					$instructionsRight = "";
					$additionalInfoRight = "";
					$infoRight = "Podaci su uspješno promijenjeni.";
			}
		}
		
	//Delete product
		
		if(isset($_POST["deleteBtn"]) && isset($_POST["nameRight"])){
			$productToDelete = $_POST["nameRight"];
				if($productToDelete){
					$result = connection::deleteProduct($productToDelete);
					if($result){
						$descriptionRight = "";
						$priceRight = "";
						$pictureRight = ""; 
						$instructionsRight = "";
						$additionalInfoRight = "";
						$infoRight = "Proizvod je obrisan";
				}else{
					$infoRight = "Nije selektovan proizvod."; 
				}
			}
		}
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<style type="text/css">
		body{
			width: 100vw;
			display: flex;
			justify-content: center;
		}
		textarea{
			width: 50%;
			height: 100px;
		}
		#newEntry, #modification{
			width: 35%; 
			margin-right: 10px;
			padding: 10px; 
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			border: solid red 1px;
		}
		#upload{
			width: 100%; 
			display: flex;
			justify-content: center; 
		}
		.left, .right{
			width: 300px; 
		}
		
	</style>
</head>
<body>
	<div id="newEntry">
	<h3>Novi unos</h3>
		<form action="" onsubmit="return validationLeft()" method="post">
			<label for="category" required>Kategorija</label><br>
			<input type="text" id="categoryLeft" class="left" name="categoryLeft"/><br><br>

			<label for="name">Naziv proizvoda</label><br>
			<input type="text" id="nameLeft" class="left" name="nameLeft"/><br><br>
		
			<label for="desctiption">Opis</label><br>
			<textarea id="descriptionLeft" class="left" name="descriptionLeft"></textarea><br><br>

			<label for="price">Cijena</label><br>
			<input type="text" id="priceLeft" class="left" name="priceLeft"/><br><br>

			<label for="picture">Slika (puni naziv fajla)</label><br>
			<input type="text" id="pictureLeft" class="left" name="pictureLeft"/><br><br>			

			<label for="instructions">Primjena</label><br>
			<textarea id="instructions" class="left" name="instructionsLeft"></textarea><br><br>
			
			<label for="additionalInfoLeft">Napomena</label><br>
			<textarea id="additionalInfoLeft" class="left" name="additionalInfoLeft"></textarea><br><br>

			<input type="submit" id="newProduct" name="submit" value="Sačuvaj" style="width: 300px"><br>
		</form>
		<button id="clearLeft" style="width: 100px; margin-top: 15px">Clear</button>
		<p id="infoLeft"><?= $infoLeft ?></p>
		<div id="upload">
		<form action="" method="POST" enctype="multipart/form-data">
			<label style="margin-right: 10px">Upload slike</label>
			<input type="file" name="file">
			<button type="submit" name="upload">Upload</button><br>
		</form>
		</div>
		<p id="info"><?= $info ?></p>
	</div>
	<div id="modification">
		<h3>Izmjene i brisanje</h3>
		<form action="" method="post" onsubmit="return validationRight()">
		<label>Kategorije</label><br>
			<select id="ctgSelect" name="ctgSelect" style="margin-right: 10px;">
				<?php foreach($categoriesReindexed as $ctgR){
					echo "<option>{$ctgR}</option>"; 
				} ?>
			</select><input type="submit" name="categoryBtn" value="Potvrdi"/><br><br>		
						
			<label>Proizvodi</label><br>
			<select id="productSelect" name="productSelect" style="margin-right: 10px; width: 180px">
				<?php foreach($products as $p){
					echo "<option>{$p->productName}</option>"; 
				} ?>
			</select>		
			
			<input type="submit" name="productBtn" value="Potvrdi"/><br><br>
			
			<label for="name">Naziv proizvoda</label><br>
			<input type="text" id="nameRight" class="right" name="nameRight" value="<?= $nameRight ?>"/><br><br>
			
			<label for="desctiption">Opis</label><br>
			<textarea id="descriptionRight" class="right" name="descriptionRight"><?= $descriptionRight ?></textarea><br><br>

			<label for="price">Cijena</label><br>
			<input type="text" id="priceRight" class="right" name="priceRight" value="<?= $priceRight ?>"><br><br>

			<label for="picture">Slika</label><br>
			<input type="text" id="pictureRight" class="right" name="pictureRight" value="<?= $pictureRight ?>"><br><br>

			<label for="instructions">Primjena</label><br>
			<textarea id="instructions" class="right" name="instructionsRight"><?= $instructionsRight ?></textarea><br><br>
			
			<label for="additionalInfoRight">Napomena</label><br>
			<textarea id="additionalInfoRight" class="right" name="additionalInfoRight"><?= $additionalInfoRight ?></textarea><br><br>
			
			<input type="submit" name="modifyBtn" value="Sačuvaj" style="margin-right: 75px; width: 100px"/>
			<input type="submit" name="deleteBtn" value="Izbriši" style="width: 100px"/>
		</form>
		<button id="clearRight" style="width: 100px; margin: 15px; ">Clear</button>
		<p id="infoRight"><?= $infoRight ?></p>
	</div>
	<script>
		var getCtgSelect = document.getElementById("ctgSelect");
		getCtgSelect.selectedIndex = "-1"; 
		var getProductSelect = document.getElementById("productSelect"); 
		
		var getClearLeft = document.getElementById("clearLeft");
		var getAllLeft = document.getElementsByClassName("left");
		
		var getClearRight = document.getElementById("clearRight");
		var getAllRight = document.getElementsByClassName("right");
		
		var getInfoRight = document.getElementById("infoRight");
		var getInfoLeft = document.getElementById("infoLeft");
		var getInfo = document.getElementById("info"); 
		
		getClearLeft.addEventListener("click", clearLeft); 
		
		function clearLeft(){
			for(var field of getAllLeft){
				field.value = null; 
			}
			getInfoLeft.innerHTML = ""; 
			getInfo.innerHTML = ""; 
		}
				
		getClearRight.addEventListener("click", clearRight); 
		
		function clearRight(){
			for(var field of getAllRight){
				field.value = null; 
			}
			getInfoRight.innerHTML = ""; 
		}
		
		
		
		//Validation
				 
		var getCategoryLeft = document.getElementById("categoryLeft");
		var getNameLeft = document.getElementById("nameLeft");
		var getDescriptionLeft = document.getElementById("descriptionLeft");
		var getPriceLeft = document.getElementById("priceLeft");
		var getPictureLeft = document.getElementById("pictureLeft");
		
		
		function validationLeft(){
			let price = getPriceLeft.value;
			getPriceLeft.value = price.replace(",", "."); 
			if(getCategoryLeft.value == ""){
				getCategoryLeft.style.border = "solid red 1px";
				alert("Polje 'Kategorija' je obavezno."); 
				return false; 
			}
			if(getNameLeft.value == ""){
				getNameLeft.style.border = "solid red 1px";
				alert("Polje 'Naziv proizvoda' je obavezno.");
				return false; 
			}
			if(getDescriptionLeft.value == ""){
				getDescriptionLeft.style.border = "solid red 1px";
				alert("Polje 'Opis' je obavezno.");
				return false; 
			}
			if(getPriceLeft.value == ""){
				getPriceLeft.style.border = "solid red 1px";
				alert("Polje 'Cijena' je obavezno.");
				return false; 
			}
			if(isNaN(getPriceLeft.value)){
				getPriceLeft.style.border = "solid red 1px";
				alert("Cijena mora imati numeričku vrijednost."); 
				return false;
			}
			if(getPictureLeft.value == ""){
				getPictureLeft.style.border = "solid red 1px";
				alert("Polje 'Slika' je obavezno.");
				return false; 
			}
			return true; 
		}
		
		
		var getPriceRight = document.getElementById("priceRight");
		
		
		function validationRight(){
			let priceRight = getPriceRight.value;
			getPriceRight.value = priceRight.replace(",", "."); 
			return true; 
		}
		
	</script>
</body>
</html>