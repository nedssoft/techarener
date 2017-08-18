<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/mblog/autoloader/Autoloader.php';
$data = new PostController;
$approved = $data->showApprovedPost();


$json = json_encode($approved);
$json_decode = json_decode($json, true, 512);
 
for ($i=0; $i < count($json_decode) ; $i++) { 

	foreach ($json_decode[$i] as $key => $value) {

		echo $key.": ".$value."<br>";
	}
}