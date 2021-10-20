<?php
	spl_autoload_register(function($class){
		include $class.".php"; 
	});

	class connection{
		
		static function getCategories(){
			$conn = database::connect();
			$result = $conn->query("select category from products");
			$categories = $result->fetchAll(PDO::FETCH_COLUMN);
			$categoriesUnique = array_unique($categories);
			
			foreach($categoriesUnique as $ctg){
				 echo "<a class='ctgContainer' href='sibilaProducts.php?category=$ctg'>
							<p>{$ctg}</p>
					   </a>";
			}
		}
		
		static function getCategoryList(){
			$conn = database::connect();
			$result = $conn->query("select category from products");
			$categories = $result->fetchAll(PDO::FETCH_COLUMN);
			$categoriesUnique = array_unique($categories);
			
			return $categoriesUnique;
		}
		
		static function getProductsByCategory($category){
			$conn = database::connect();
			$result = $conn->query("select * from products where category = '$category'");
			$product = $result->fetchAll(PDO::FETCH_CLASS, "products"); 
			
			foreach($product as $p){
				echo "<div class='products'>
							<a href='sibilaDetails.php?productId={$p->productId}'><img src='{$p->picture}' alt='{$p->productName}'></a>
							<div class='productName'>
								<h3>{$p->productName}</h3>
							</div>
							<div class='productDetails'>
								<h2>{$p->price} KM</h2>
							</div>
						</div>";
			}
		}
		
		static function getProductListByCategory($category){
			$conn = database::connect();
			$result = $conn->query("select * from products where category = '$category'");
			$product = $result->fetchAll(PDO::FETCH_CLASS, "products");
			
			return $product;
		}
		
		static function getProductDetails($productId){
			$conn = database::connect();
			$result = $conn->query("select * from products where productId = '$productId'");
			$prod = $result->fetch(PDO::FETCH_ASSOC);
			
			if($prod["instructions"]){
				echo "<div id='pictureContainer'>
					<img src='{$prod['picture']}' alt='{$prod['productName']}'>
				</div>
				<div id='details'>
					<div id='contents'>
						<h3>{$prod['productName']}</h3>
						<p>{$prod['description']}</p>
					</div>
					<div id='instructions'>
						<h3>Primjena</h3>
						<p>{$prod['instructions']}</p>
					</div>
					<div id='additionalInfo'>
						<p>{$prod['additionalInfo']}</p>
					</div>
				</div>";
			}else{
				echo "<div id='pictureContainer'>
					<img src='{$prod['picture']}' alt='{$prod['productName']}'>
				</div>
				<div id='details'>
					<div id='contents'>
						<h3>{$prod['productName']}</h3>
						<p>{$prod['description']}</p>
					</div>
					<div id='additionalInfo'>
						<p>{$prod['additionalInfo']}</p>
					</div>
				</div>";
			} 
		}
		
		static function getAllIds(){
			$conn = database::connect();
			$result = $conn->query("select productId from products");
			$allIds = $result->fetchAll(PDO::FETCH_COLUMN); 
			
			return $allIds; 
		}
		
		static function getProductName($productId){
			$conn = database::connect();
			$result = $conn->query("select * from products where productId = '$productId'");
			$prod = $result->fetch(PDO::FETCH_ASSOC);
			$productName = $prod["productName"];
			return $productName; 
		}
		
		static function getProductByName($productName){
			$conn = database::connect();
			$result = $conn->query("select * from products where productName = '$productName'");
			$prod = $result->fetch(PDO::FETCH_ASSOC);
			
			return $prod;
		}
				
		static function newProduct($product){
			$conn = database::connect();
			$result = $conn->exec("insert into products values(null, '{$product->category}', '{$product->productName}', '{$product->description}', {$product->price}, '{$product->picture}', '{$product->instructions}', '{$product->additionalInfo}')"); 
			
			return $result; 
		}
		
		static function modifyProduct($productName, $category, $name, $description, $price, $picture, $instructions, $additionalInfo){
			$conn = database::connect(); 
			$product = self::getProductByName($productName);
						
			 
			$result = $conn->exec("update products set category = '{$category}', productName = '{$name}', description = '{$description}', 
			price = {$price}, picture = '{$picture}', instructions = '{$instructions}', additionalInfo = '{$additionalInfo}' where productName = '$productName'");
			
			return $result; 
		}
		
		static function deleteProduct($productName){
			$conn = database::connect();
			$result = $conn->exec("delete from products where productName = '$productName'");
			
			return $result; 
		}
	}
	
