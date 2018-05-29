<?php 
require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/ApiManager.php';


$data = file_get_contents('php://input');

if(ApiManager::validateJSON($data)){
	$data = ApiManager::parseJSON($data);
	(new ApiManager)->login($data);
}else{
	@http_response_code(400);
	echo json_encode(['message'=>'Invalid json request'],JSON_PRETTY_PRINT);
}