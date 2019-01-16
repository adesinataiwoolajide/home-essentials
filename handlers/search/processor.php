<?php 
	$query = $_GET['query'];
	$category = $_GET['category'];
	if($category == "All"){
		header("Location: ../../search-result.php?query=$query");
	}else{
		header("Location: ../../search-category-result.php?query=$query&&category=$category");
	}
?>