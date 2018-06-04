<?php

class ApiManager{

	private static $connection = null;

	public static function validateJSON($data=NULL) {
	  if(!empty($data)){
	                @json_decode($data);
	                return (json_last_error() === JSON_ERROR_NONE);
	    }
	    return false;
	}
	public static function parseJSON($data=NULL) {
		return @json_decode($data,true);
	}

	public function __construct(){

		//$dsn= "mysql:host=".HOSTNAME.";dbname=".DBNAME;
		//self::$connection = new PDO($dsn, USERNAME, PASSWORD);
	}

	public function sendNotification($deviceToken,Array $message=[]){
		

		$msg = array(
				'body' 	=> 'Welcome '.$message['username'].' to fineagle services',
				'title'	=> 'Welcome',
             	//'icon'	=> 'myicon',
              	//'sound' => 'mySound'
         );


		$fields = array
		(
			'registration_ids'=> [$deviceToken],
			'notification'	=> $msg
		);

		$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		curl_close($ch);
		echo $result;
	}

	public function login(Array $data){
		
        $this->sendNotification($data['device_token'],$data);
	}

}
