<?php
class Cart{
	public static function getTotalQuantity($cart){
		$sessionCart = $cart;
		$newquantity = 0;
		$totalPrice = 0;
		$wght =0;
		if(count($cart)){
			foreach ($sessionCart as $key => $value) {
				$quantity = (int)$sessionCart[$key]['quantity'];
				$price = (int)$sessionCart[$key]['price'];
				$totalPrice += $quantity * $price;
				
				$newquantity += $sessionCart[$key]['quantity'];
			}
		}else{
			$newquantity = 0;
			$totalPrice = 0;
			$wght =0;
			
		}
		return array($newquantity, $totalPrice);
	}

	public static function showSizes($sizes){
		$var = array_count_values($sizes);
		foreach($var as $key => $values){
			echo "Size ". $key ." - ". $values ." pieces";
			echo "<br>";
		}
	}
}
?>