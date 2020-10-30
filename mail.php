<?php
		
	$recipient = "youremail@mail.com";
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$body = $_POST["email-body"];
	$header = "From: ".$email."\n";

	if(mail($recipient, $subject, $body, $header))
	{
		echo "Message sent successfully.";
	}
	else
	{
		echo "Error sending form";
	} 

?>
