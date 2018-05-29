<?php 
require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/ApiManager.php';



if(isset($_POST['username'])){
	(new ApiManager)->login($_POST);
}else{
	@http_response_code(400);
	echo json_encode(['message'=>'Invalid data'],JSON_PRETTY_PRINT);
}