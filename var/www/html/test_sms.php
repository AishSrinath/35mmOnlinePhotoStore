<?php
	require('mail.php');
	$cxname="buyer";
	$cxemail="00353899757387@echoemail.net";
	$subject="Your order is processed";
	$body="Your 35mm order is processed";
	sendmail ($cxname,$cxemail,$subject,$body);
?>
