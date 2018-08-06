<?php
	// Account details
	$apiKey = urlencode('agMVycBvlKI-WsKcZTCQGvPwGGbpIQ8GhRLwlEnKpC');
	
	// Message details
	$numbers = array(0879208562);
	$sender = urlencode('35mm.com');
	$message = rawurlencode('This is a test message');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.txtlocal.com/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
?>
