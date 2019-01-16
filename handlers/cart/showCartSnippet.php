<?php 
	if(isset($_SESSION['cart'])){ 

		echo "<a href=\"cart.php\"> Go to cart </a>";
		// echo $totalGoodsinCart = Cart::getTotalQuantity($_SESSION['cart'])[0]. " Items - "; 
		// echo "&#8358;".Cart::getTotalQuantity($_SESSION['cart'])[1]; 
		// echo "</a>";
	}
?>