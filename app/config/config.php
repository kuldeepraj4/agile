<?php
session_start();

//    date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('America/Los_Angeles');
               //connection checking
    //APPROOT
define('APPROOT', dirname(dirname(__FILE__)));
    //URLROOT (Dynamic links)

	// Define url for live
    #define('URLROOT', 'https://agile.sigealogistics.com/public/');
    #define('AJAXROOT', 'https://agile.sigealogistics.com/');
	
	//Define url for localhost
	//define('URLROOT', 'http://localhost:8080/agile_test/public/');
	//define('AJAXROOT', 'http://localhost:8080/agile_test/');
	define('URLROOT', 'http://localhost/agile/public/');
	define('AJAXROOT', 'http://localhost/agile/');

    //--------API CALLS SYSTEM--- 
function callSGWS($urlExtension,$post_data,$upload_file=''){
	$curl = curl_init();
	// url setting for live
	#$url='http://sws.sigealogistics.com/'.$urlExtension;

	// url setting for localhost
	$url='http://localhost/sws/'.$urlExtension;
	//$url='http://localhost/'.$urlExtension;
	$data=$post_data;
	$data['app_id']="myappkey";
	$file='';
	if($upload_file!='' && count($upload_file)>0){
		$file= new CURLFile($upload_file['tmp_name'], $upload_file['type'], $upload_file['name']); 
	}
	$headers = array(
	 'Content-type: multipart/form-data'
	); 
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS,array('param' =>json_encode($data),'file'=>$file));
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	// EXECUTE:
	$result = curl_exec($curl);
	if(!$result){die("Connection Failure");}
	curl_close($curl);
	return $result;
}
?>
