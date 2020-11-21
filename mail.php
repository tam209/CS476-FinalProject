<?php
		
	$recipient = "youremail@email.com";
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$body = $_POST["email-body"];
	$header = "From: ".$email."\n";

	if(mail($recipient, $subject, $body, $header))
	{
		echo "Message sent succesfully.";
	}
	else
	{
		// Removed echo as it will fail every time in the current database. 
		//echo "Error sending form";
	} 

?>
