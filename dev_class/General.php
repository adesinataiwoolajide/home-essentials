<?php
class General{
	public static function sanitiseInput($string)
	{
		$string = trim($string);
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		return $string;
	}

	
	public function sanitiseValidateEmail($string)
	{
		$string = filter_var($string, FILTER_SANITIZE_EMAIL);
		$string = filter_var($string, FILTER_VALIDATE_EMAIL);
		if($string!== false){
			return true;
		}
		return false;
	}

	public static function generateRandomHash($length)
	{
		return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
	}	

	public static function curlWeb($url)
	{
		$init = curl_init();
		curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($init, CURLOPT_URL,$url);
		$result=curl_exec($init);
		curl_close($init);
		return $result;
	}

	public static function formatDate($date)
	{
		$date = strtotime($date);
		return date("d-M-Y", $date);
	}

	public static function validExtensions($extension){
		$allowedExtensions = array("jpg", "JPEG", "png", "jpeg", "JPEG", "PNG");
		if(in_array($extension, $allowedExtensions)){
			return true;
		}
		return false;
	}

	public static function getExtension($imageName){
		$imageProperties = pathinfo($imageName);
		return $extension = $imageProperties['extension'];
	}

	public static function generateSlug($text){
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, '-');
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text."-".rand(1111,9999);		
	}		
}
?>