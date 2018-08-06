<?php	// Authorisation details.
	$username = "aiswarya.g2008@gmail.com";
	$hash = "7608f4f68c4b441c37009ba24190d83efaf76052d84a4fd27ce2a50363d15669";
	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";
	// Data for text message. This is the text message data.
	$sender = "35mm.com"; // This is who the message appears to be from.
	$numbers = "0879208562"; // A single number or a comma-seperated list of numbers	
	$message = "your order will be shipped in 1-6 working days";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	print_r($result);	
	curl_close($ch);
?>