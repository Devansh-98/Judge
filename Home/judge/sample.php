<?php
$email = $argv[1];
$otp=$argv[2];

if(mail($email,"Reset Password URGENT","Hi there,use this $otp\n This email was sent using PHP's mail function \n DO NOT REPLY."))
print "Email successfully sent to $email";
else
print "An error occured";
?>
