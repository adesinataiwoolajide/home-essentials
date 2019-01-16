<?php
	class ragzNationProductsCategory{

		public $db;
		function __construct($db){
			$this->db=$db;
		}

		public function addingNewProductsCategory($category_name){
			try{
				$insertCategory = $this->db->prepare("INSERT INTO products_category(category_name)VALUES(:category_name)");
				$arrCategory = array(':category_name'=>$category_name);
				if($insertCategory->execute($arrCategory)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function checkDuplicateProductsName($category_name){
			try{
				$check = $this->db->prepare("SELECT * FROM products_category WHERE category_name=:category_name");
				$arr = array(':category_name'=>$category_name);
				$check->execute($arr);
				if($check->rowCount()>0){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function getCategoryDetailsId($category_id){
			try{
				$getting = $this->db->prepare("SELECT * FROM products_category WHERE category_id=:category_id");
				$arr = array(':category_id'=>$category_id);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function getCategoryDetailsName($category_name){
			try{
				$getting = $this->db->prepare("SELECT * FROM products_category WHERE category_name=:category_name");
				$arr = array(':category_name'=>$category_name);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}
	

		public function updateCategory($category_name, $category_id){
			try{
				$update = $this->db->prepare("UPDATE products_category SET category_name=:category_name WHERE category_id=:category_id");
				$arr = array(':category_name'=>$category_name, ':category_id'=>$category_id);
				if($update->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function deleteProductCategoryName($category_name, $category_id){
			try{
				$delete = $this->db->prepare("DELETE FROM products_category WHERE category_name=:category_name AND category_id=:category_id");
				$arr = array(':category_name'=>$category_name, ':category_id'=>$category_id);
				if($delete->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}



		public function addingNewProductsType($type_name, $category_id){
			try{
				$insertType = $this->db->prepare("INSERT INTO product_type(type_name, category_id)VALUES(:type_name, :category_id)");
				$arrType = array(':type_name'=>$type_name, ':category_id'=>$category_id);
				if($insertType->execute($arrType)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function checkDuplicateProductsType($type_name, $category_id){
			try{
				$checkType = $this->db->prepare("SELECT * FROM product_type WHERE type_name=:type_name AND category_id=:category_id");
				$arrT = array(':type_name'=>$type_name, ':category_id'=>$category_id);
				$checkType->execute($arrT);
				if($checkType->rowCount()>0){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function getTypeDetailsId($type_id){
			try{
				$getting = $this->db->prepare("SELECT * FROM product_type WHERE type_id=:type_id");
				$arr = array(':type_id'=>$type_id);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function getTypeDetailsName($type_name){
			try{
				$getting = $this->db->prepare("SELECT * FROM product_type WHERE type_name=:type_name");
				$arr = array(':type_name'=>$type_name);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}
	

		public function updateType($type_name, $category_id, $type_id){
			try{
				$update = $this->db->prepare("UPDATE product_type SET type_name=:type_name, category_id=:category_id WHERE type_id=:type_id");
				$arr = array(':type_name'=>$type_name, ':category_id'=>$category_id, ':type_id'=>$type_id);
				if($update->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function deleteProductTypeName($type_name, $type_id){
			try{
				$delete = $this->db->prepare("DELETE FROM product_type WHERE type_name=:type_name AND type_id=:type_id");
				$arr = array(':type_name'=>$type_name, ':type_id'=>$type_id);
				if($delete->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}


		public function addingNewProductsManufacturer($manufacturer_name, $manufacturer_logo){
			try{
				$insertManu = $this->db->prepare("INSERT INTO manufacturer(manufacturer_name, manufacturer_logo)VALUES(:manufacturer_name, :manufacturer_logo)");
				$arrManu = array(':manufacturer_name'=>$manufacturer_name, ':manufacturer_logo'=>$manufacturer_logo);
				if($insertManu->execute($arrManu)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function checkDuplicateProductsManu($manufacturer_name){
			try{
				$checkManu = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_name=:manufacturer_name");
				$arrM = array(':manufacturer_name'=>$manufacturer_name);
				$checkManu->execute($arrM);
				if($checkManu->rowCount()>0){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function checkDuplicateProductsManuLogo($manufacturer_logo){
			try{
				$checkManu = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_logo=:manufacturer_logo");
				$arrM = array(':manufacturer_logo'=>$manufacturer_logo);
				$checkManu->execute($arrM);
				if($checkManu->rowCount()>0){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function getTypeManuId($manufacturer_id){
			try{
				$gettingManu = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_id'=>$manufacturer_id);
				$gettingManu->execute($arr);
				$see = $gettingManu->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}
	

		public function updateManuWithoutLogo($manufacturer_name, $manufacturer_id){
			try{
				$updateManu = $this->db->prepare("UPDATE manufacturer SET manufacturer_name=:manufacturer_name WHERE manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_name'=>$manufacturer_name, ':manufacturer_id'=>$manufacturer_id);
				if($updateManu->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function updateManuWithLogo($manufacturer_name, $manufacturer_id, $manufacturer_logo){
			try{
				$updateManu = $this->db->prepare("UPDATE manufacturer SET manufacturer_name=:manufacturer_name, manufacturer_logo=:manufacturer_logo WHERE manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_name'=>$manufacturer_name, ':manufacturer_id'=>$manufacturer_id, ':manufacturer_logo'=>$manufacturer_logo);
				if($updateManu->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}

		public function deleteProductManuName($manufacturer_name, $manufacturer_id){
			try{
				$delete = $this->db->prepare("DELETE FROM manufacturer WHERE manufacturer_name=:manufacturer_name AND manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_name'=>$manufacturer_name, ':manufacturer_id'=>$manufacturer_id);
				if($delete->execute($arr)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
			}
		}



	}

	class ragzNationProducts extends ragzNationProductsCategory{
		function __construct($db){
			parent:: __construct($db);
		}

		public function insertingTheGenLastNumber($number_type, $year_number, $month, $last_number)
		{
			try {
				$addNumber= $this->db->prepare("INSERT INTO generated_numbers(number_type, year_number, month, last_number)VALUES(:number_type, :year_number, :month, :last_number)");
				$srrNum = array(':number_type'=>$number_type, ':year_number'=>$year_number, ':month'=>$month, ':last_number'=>$last_number);
				if(!empty($addNumber->execute($srrNum))){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				echo  $e->getMessage();
			}
		}

		public function getRagzManufacturerDetails($manufacturer_id){
			try{
				$getting = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_id'=>$manufacturer_id);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getRagzManufacturerNameDetails($manufacturer_name){
			try{
				$getting = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_name=:manufacturer_name");
				$arr = array(':manufacturer_name'=>$manufacturer_name);
				$getting->execute($arr);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function addNewProductDetails($product_name, $product_number, $product_image, $type_id, $manufacturer_id){
			try{
				$insertProDetails = $this->db->prepare("INSERT INTO products_details(product_name, product_number, product_image, type_id, manufacturer_id)VALUES(:product_name, :product_number, :product_image, :type_id, :manufacturer_id)");
				$arrProDet= array(':product_name'=>$product_name, ':product_number'=>$product_number, ':product_image'=>$product_image, ':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id);
				if(!empty($insertProDetails->execute($arrProDet))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateNewProductDetailsWithImage($product_name, $product_number, $product_image, $type_id, $manufacturer_id){
			try{
				$updateProDet = $this->db->prepare("UPDATE products_details SET product_name=:product_name, product_image=:product_image, type_id=:type_id, manufacturer_id=:manufacturer_id WHERE product_number=:product_number");
				$arrUpProDet= array(':product_name'=>$product_name, ':product_number'=>$product_number, 
					':product_image'=>$product_image, ':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id);
				if(!empty($updateProDet->execute($arrUpProDet))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateNewProductThumbImage($product_number, $product_thumbnail){
			try{
				$updateProDet = $this->db->prepare("UPDATE products SET product_thumbnail=:product_thumbnail WHERE product_number=:product_number");
				$arrUpProDet= array(':product_thumbnail'=>$product_thumbnail, ':product_number'=>$product_number, 
					);
				if(!empty($updateProDet->execute($arrUpProDet))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateNewProductDetailsWithoutImage($product_name, $product_number, $type_id, 
			$manufacturer_id){
			try{
				$updateProDet = $this->db->prepare("UPDATE products_details SET product_name=:product_name, type_id=:type_id, manufacturer_id=:manufacturer_id WHERE product_number=:product_number");
				$arrUpProDet= array(':product_name'=>$product_name, ':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id, ':product_number'=>$product_number);
				if(!empty($updateProDet->execute($arrUpProDet))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getProductsDet($product_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products_details WHERE product_number=:product_number");
				$arrGetProDet= array(':product_number'=>$product_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllTheProductsDet()
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products_details ORDER BY product_id");
				$arrGetProDet= array(':product_number'=>$product_number);
				$gettingProDet->execute($arrGetProDet);
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllTheProductsSideBar()
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products ORDER BY type_id DESC LIMIT 0,6");
				$gettingProDet->execute();
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}


		public function getAllTheProductsSideBarSpecial()
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products_details ORDER BY manufacturer_id DESC LIMIT 0,3");
				$gettingProDet->execute();
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllTheProductsSideBarSpecialTwo()
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products ORDER BY product_price DESC LIMIT 0,3");
				$gettingProDet->execute();
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllTheProductsSideBarSpecialThree()
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products ORDER BY type_id DESC LIMIT 0,3");
				$gettingProDet->execute();
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getProductsPublishedProducts($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1 ORDER BY product_id desc");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getProducts($merchant_number)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number");
			$arrGetProDet= array(':merchant_number'=>$merchant_number);
			$query->execute($arrGetProDet);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getDescProducts($merchant_number)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1 ORDER BY product_id desc LIMIT 0,4");
			$arrGetProDet= array(':merchant_number'=>$merchant_number);
			$query->execute($arrGetProDet);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAscProducts($merchant_number)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1 ORDER BY product_price desc LIMIT 0,3");
			$arrGetProDet= array(':merchant_number'=>$merchant_number);
			$query->execute($arrGetProDet);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getProductsPublish($merchant_number)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1");
			$arrGetProDet= array(':merchant_number'=>$merchant_number);
			$query->execute($arrGetProDet);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsPublish()
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE publish=1 ORDER BY product_id DESC");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllBestProductsPublish()
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE publish=1 ORDER BY product_price DESC");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllLastProductsPublish()
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE publish=1 ORDER BY quantity DESC");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function checkAllProductsPublish()
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE publish=1");
			$query->execute();
			if($query->rowCOunt()==0){
				return true;
			}else{
				return false;
			}
		}

		public function getProductsUnPublishedProducts($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=0  ORDER BY product_id desc");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				return $gettingProDet->fetchAll(PDO::FETCH_ASSOC);
			
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getMerchantProductsDet($merchant_number, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number ORDER BY product_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":merchant_number", $merchant_number);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getPaginateProductsPublish($start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products  WHERE publish=1 ORDER BY product_id desc LIMIT :start, :items_per_page");
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getPaginateProductsPublishFeature($start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products  WHERE publish=1 ORDER BY product_price asc LIMIT :start, :items_per_page");
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getSlideProductsPublish()
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE publish=1 ORDER BY product_id desc LIMIT 0, 3");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getPaginateListProductsPublish($start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products  WHERE publish=1 ORDER BY product_price asc LIMIT :start, :items_per_page");
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getPaginateListCateProductsPublish($start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products  WHERE publish=1 ORDER BY category_id desc LIMIT :start, :items_per_page");
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getCategoryProductsManu($manufacturer_id, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products_details WHERE manufacturer_id=:manufacturer_id ORDER BY details_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":manufacturer_id", $manufacturer_id);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getCategoryProductsPriceManu($product_price, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products_details WHERE product_price <= :product_price ORDER BY details_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":product_price", $product_price);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllProductsPriceManu($product_price, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE product_price <= :product_price ORDER BY details_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":product_price", $product_price);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getCategoryCHeckPriceProductsManu($product_price)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE product_price <= :product_price ORDER BY product_id desc ");
				$query->bindValue(":product_price", $product_price);
				$query->execute();
				if($query->rowCount()==0){
					return true;
				}else{
					return false;
				}
				
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getCategoryCHeckProductsManu($manufacturer_id)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products_details WHERE manufacturer_id=:manufacturer_id");
				$query->bindValue(":manufacturer_id", $manufacturer_id);
				$query->execute();
				if($query->rowCount()==0){
					return true;
				}else{
					return false;
				}
				
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getCategoryCHeckProductsMerch($merchant_number)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number");
				$query->bindValue(":merchant_number", $merchant_number);
				$query->execute();
				if($query->rowCount()==0){
					return true;
				}else{
					return false;
				}
				
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getCategoryProductsDeta($category_id, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE category_id=:category_id ORDER BY product_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":category_id", $category_id);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getAllProductsManuList($manufacturer_id)
		{
			$query = $this->db->prepare("SELECT * FROM products_details WHERE manufacturer_id=:manufacturer_id");
			$arr = array(':manufacturer_id'=>$manufacturer_id);
			$query->execute($arr);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsManuListPrice($manufacturer_id, $product_price)
		{
			$query = $this->db->prepare("SELECT * FROM products_details WHERE manufacturer_id=:manufacturer_id AND product_price=:product_price");
			$arr = array(':manufacturer_id'=>$manufacturer_id, ':product_price'=>$product_price);
			$query->execute($arr);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsListPrice($product_price)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE product_price=:product_price");
			$arr = array(':product_price'=>$product_price);
			$query->execute($arr);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsManuListPriceNoCond($product_price, $start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE product_price =:product_price ORDER BY product_price asc LIMIT :start, :items_per_page");
			$query->bindValue(":product_price", $product_price);
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsManuLimit($manufacturer_id)
		{
			try{
				$getting = $this->db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
				$arr = array(':manufacturer_id'=>$manufacturer_id);
				$getting->execute($arr);
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
			
		}



		public function getAllProductsCategoryList($category_id)
		{
			$query = $this->db->prepare("SELECT * FROM products WHERE category_id=:category_id");
			$arr = array(':category_id'=>$category_id);
			$query->execute($arr);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsTypoList($type_id)
		{
			$query = $this->db->prepare("SELECT * FROM products_details WHERE type_id=:type_id");
			$arr = array(':type_id'=>$type_id);
			$query->execute($arr);
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getAllProductsTypeList($type_id, $start, $itemsPerPage)
		{
			$query = $this->db->prepare("SELECT * FROM products_details WHERE type_id=:type_id ORDER BY type_id desc LIMIT :start, :items_per_page");;
			$query->bindValue(":type_id", $type_id);
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;
		}

		public function getMerchantUnPubProductsDet($merchant_number, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=0 ORDER BY product_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":merchant_number", $merchant_number);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getMerchantgPubProductsDet($merchant_number, $start, $itemsPerPage)
		{
			try {
				$query = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1 ORDER BY product_id desc LIMIT :start, :items_per_page");
				$query->bindValue(":merchant_number", $merchant_number);
				$query->bindValue(":start", $start, PDO::PARAM_INT);
				$query->bindValue(":items_per_page", $itemsPerPage, PDO::PARAM_INT);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function checkMerchantProductsDet($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				if($gettingProDet->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function checkMerchantUnPublishProductsDet($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=0");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				if($gettingProDet->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function checkMerchantPublishedProductsDet($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products WHERE merchant_number=:merchant_number AND publish=1");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				if($gettingProDet->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}



		public function countMerchantProductsDet($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT count(product_id) as total FROM products WHERE merchant_number=:merchant_number ");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function sumMerchantProductsDet($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT sum(product_price) as total FROM products WHERE merchant_number=:merchant_number");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function sumMerchantProductsPublish($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT sum(product_price) as total FROM products WHERE merchant_number=:merchant_number AND publish=1");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function sumMerchantUnProductsPublish($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT sum(product_price) as total FROM products WHERE merchant_number=:merchant_number AND publish=0");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function countMerchantProductPublish($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT count(product_id) as total FROM products WHERE merchant_number=:merchant_number AND publish =1");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function countMerchantProductUnPublish($merchant_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT count(product_id) as total FROM products WHERE merchant_number=:merchant_number AND publish =0");
				$arrGetProDet= array(':merchant_number'=>$merchant_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getTrippleProductsDet($product_number)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT * FROM products_details WHERE product_number=:product_number LIMIT 0,3");
				$arrGetProDet= array(':product_number'=>$product_number);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getManuTotal($manufacturer_id)
		{
			try {
				$gettingProDet = $this->db->prepare("SELECT count(manufacturer_id) as new_total FROM products_details WHERE manufacturer_id=:manufacturer_id");
				$arrGetProDet= array(':manufacturer_id'=>$manufacturer_id);
				$gettingProDet->execute($arrGetProDet);
				$ropol = $gettingProDet->fetch();
				return $ropol['new_total'];
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function deleteProductsDet($product_number)
		{
			try {
				$deleteProDet = $this->db->prepare("DELETE FROM products_details WHERE product_number=:product_number");
				$arrDelProDet = array(':product_number'=>$product_number);
				if(!empty($deleteProDet->execute($arrDelProDet))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function addNewProduct($product_thumbnail, $product_number, $product_description, $product_price, $publish, $type_id, $quantity, $product_size, $category_id, $merchant_number){
			try{
				$insertPro = $this->db->prepare("INSERT INTO products(product_thumbnail, product_number, product_description, product_price, publish, type_id, quantity, product_size, category_id, merchant_number)VALUES(:product_thumbnail, :product_number, :product_description, :product_price, :publish, :type_id, :quantity, :product_size, :category_id, :merchant_number)");
				$arrPro= array(':product_thumbnail'=>$product_thumbnail, ':product_number'=>$product_number, ':product_description'=>$product_description, ':product_price'=>$product_price, ':publish'=>$publish, ':type_id'=>$type_id, ':quantity'=>$quantity, ':product_size'=>$product_size, ':category_id'=>$category_id, ':merchant_number'=>$merchant_number);
				if(!empty($insertPro->execute($arrPro))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateTheProductDetailsWithThumbnail($product_thumbnail, $product_number, 
			$product_description, $product_price, $type_id, $quantity, $product_size){
			try{
				$updatePro = $this->db->prepare("UPDATE products SET product_thumbnail=:product_thumbnail, product_description=:product_description, product_price=:product_price, type_id=:type_id, quantity=:quantity, product_size=:product_size WHERE product_number=:product_number");
				$arrUpPro= array(':product_thumbnail'=>$product_thumbnail, ':product_number'=>$product_number, 
					':product_description'=>$product_description, ':product_price'=>$product_price, 
					':type_id'=>$type_id, ':quantity'=>$quantity, ':product_size'=>$product_size);
				if(!empty($updatePro->execute($arrUpPro))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateTheProductDetailsWithOutThumbnail($product_number, $product_description, 
			$product_price, $type_id, $quantity, $product_size, $category_id){
			try{
				$updatePro = $this->db->prepare("UPDATE products SET product_description=:product_description, product_price=:product_price, type_id=:type_id, quantity=:quantity, product_size=:product_size, category_id=:category_id WHERE product_number=:product_number");
				$arrUpPro= array(':product_number'=>$product_number, ':product_description'=>$product_description, ':product_price'=>$product_price, ':type_id'=>$type_id, ':quantity'=>$quantity, ':product_size'=>$product_size, ':category_id'=>$category_id);
				if(!empty($updatePro->execute($arrUpPro))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function getProductsDetails($product_number)
		{
			try {
				$gettingPro = $this->db->prepare("SELECT * FROM products WHERE product_number=:product_number");
				$arrGetPro= array(':product_number'=>$product_number);
				$gettingPro->execute($arrGetPro);
				$ropo = $gettingPro->fetch();
				return $ropo;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function deleteProductsDetails($product_number)
		{
			try {
				$deletePro = $this->db->prepare("DELETE FROM products WHERE product_number=:product_number");
				$arrDelPro= array(':product_number'=>$product_number);
				if(!empty($deletePro->execute($arrDelPro))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function checkDeuplicateProductStock($product_name, $category_id, $type_id, $manufacturer_id){
			try{
				$check = $this->db->prepare("SELECT * FROM product_stock WHERE product_name=:product_name AND category_id=:category_id AND type_id=:type_id AND manufacturer_id=:manufacturer_id");
				$arrCheck = array(':product_name'=>$product_name, ':category_id'=>$category_id, ':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id);
				$check->execute($arrCheck);
				if($check->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function addProductStock($product_name, $category_id, $type_id, $quantity, $manufacturer_id){
			try{
				$stocking = $this->db->prepare("INSERT INTO product_stock(product_name, category_id, type_id, quantity, manufacturer_id) VALUES(:product_name, :category_id, :type_id, :quantity, :manufacturer_id)");
				$arr2 = array(':product_name'=>$product_name, ':category_id'=>$category_id, ':type_id'=>$type_id, 
					':quantity'=>$quantity, ':manufacturer_id'=>$manufacturer_id);
				if(!empty($stocking->execute($arr2))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function getProductStock($product_name, $category_id, $type_id, $manufacturer_id){
			try{
				$sele = $this->db->prepare("SELECT * FROM product_stock WHERE product_name=:product_name AND category_id=:category_id AND type_id=:type_id AND manufacturer_id=:manufacturer_id");
				$arrSele = array(':product_name'=>$product_name, ':category_id'=>$category_id, ':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id);
				$sele->execute($arrSele);
				$see = $sele->fetch();
				return $see;
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function updateProductStock($product_name, $total, $category_id, $type_id, $manufacturer_id){
			try{
				$updateStock = $this->db->prepare("UPDATE product_stock SET quantity=:total WHERE product_name=:product_name AND category_id=:category_id AND type_id=:type_id AND manufacturer_id=:manufacturer_id");
				$arrUp = array(':product_name'=>$product_name, ':total'=>$total, ':category_id'=>$category_id, 
					':type_id'=>$type_id, ':manufacturer_id'=>$manufacturer_id);
				if(!empty($updateStock->execute($arrUp))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo  $e->getMessage();
				return false;
			}
		}

		public function publishTheProduct($product_number){
			try{
				$updatePUblish = $this->db->prepare("UPDATE products SET publish=1 WHERE product_number=:product_number");
				$arrUpPub= array(':product_number'=>$product_number);
				if(!empty($updatePUblish->execute($arrUpPub))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function unPublishTheProduct($product_number){
			try{
				$updatePUblish = $this->db->prepare("UPDATE products SET publish=0 WHERE product_number=:product_number");
				$arrUpPub= array(':product_number'=>$product_number);
				if(!empty($updatePUblish->execute($arrUpPub))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function addProductPublication($product_number, $product_name, $staff_email, $operation, $merchant_number)
		{
			try {
				$addPublication = $this->db->prepare("INSERT INTO product_publication(product_number, product_name, staff_email, operation, merchant_number)VALUES(:product_number, :product_name, :staff_email, :operation, :merchant_number)");
				$arrPub = array(':product_number'=>$product_number, ':product_name'=>$product_name, ':staff_email'=>$staff_email, ':operation'=>$operation, ':merchant_number'=>$merchant_number);
				if(!empty($addPublication->execute($arrPub))){
					return true;
				} else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}


		public function gettingProductsOrders($order_id)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order WHERE order_id=:order_id");
				$arrGet = array(':order_id'=>$order_id);
				$getting->execute($arrGet);
				$fetch = $getting->fetch();
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function gettingProductsOrderDetails($order_id)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details WHERE order_id=:order_id");
				$arrGet = array(':order_id'=>$order_id);
				$getting->execute($arrGet);
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function checkProductsOrdersDet($customer_id, $order_id)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order WHERE customer_id=:customer_id AND order_id=:order_id");
				$arrGet = array(':customer_id'=>$customer_id, ':order_id'=>$order_id);
				$getting->execute($arrGet);
				if($getting->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function gettingAlThelProductOrders()
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details");
				$getting->execute();
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function gettingAllProductOrdered()
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order WHERE order_status=0");
				$getting->execute();
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function checkingProductOrders()
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order WHERE order_status=0");
				$getting->execute();
				if($getting->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function checkProductOrders($product_number)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details WHERE product_id=:product_number");
				$arrGet = array(':product_number'=>$product_number);
				$getting->execute($arrGet);
				if($getting->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}
		
	}