<?php 
if ($mail_to_send=='verify_email'){

$currentDate=date("l, d F Y");	
$reciever_name=$user_name;			  
$message='
<div style="width:90%; margin:auto; height:auto;">
<img src="cid:sign_up" width="100%">
<div style="padding:15px; font-family:16px;">
<p>
Dear <strong >'.$fullname.'</strong> ('.$email.'),</p>
<p>
Trust this mail meets you well.<br><br>
Kindly enter this OTP <span style="color:#F00">'.$otp.'</span> to complete your signup process.<br><br>
</p>
<p>
<strong>DDP Management.</strong><br> Mail Sent '.$currentDate.'. 
</p>
</div>
<div  style="min-height:30px;background:#333;text-align:left;color:#FFF;line-height:20px; padding:20px 10px 20px 50px;">
&copy; All Right Reserve. <br>Dilaac Digital Payment Service.</div>
</div>
';



$smtp_host='mail.dilaac.com';
$smtp_username='notification@dilaac.com';
$smtp_password='Caalid@123';
$smtp_port=465;
$sender_name='Dilaac Digital Payment Service';

$send_to=$email;
$subject="SignUp OTP - Dilaac Digital Payment Service";


require 'mail/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $smtp_host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $smtp_username;                 // SMTP username
$mail->Password = $smtp_password;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $smtp_port;                                    // TCP port to connect to

$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);



$mail->setFrom($smtp_username, $sender_name);
$mail->AddAddress($send_to, $reciever_name);
$mail->addAddress('drhustinken2@gmail.com', 'Oyenuga Kehinde');// Name is optional
$mail->addAddress('afootechglobal@gmail.com', 'AfooTECH Global');// Name is optional

$mail->addReplyTo($smtp_username, $sender_name); // reply to the sender email

$mail->WordWrap = 50;   
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->addEmbeddedImage('mail/img/sign_up.jpg', 'sign_up');
$mail->Body = $message;
$mail->AltBody = strip_tags($message);

if(!$mail->send()){
	echo 'Not Working';
}

}
?>

















<?php 
if ($mail_to_send=='send_reset_password_otp'){
$currentDate=date("l, d F Y");	
$reciever_name=$fullname;			  
$message='
<div style="width:90%; margin:auto; height:auto;">
<img src="cid:reset_password" width="100%">
<div style="padding:15px; font-family:16px;">
<p>
Dear <strong >'.$reciever_name.'</strong> ('.$email.'),<br>
Your One Time Password (OTP) is <span style="color:#F00;">'.$otp.'</span>.<br><br>
</p>
<p>
Please  note that this OTP works for you with 10min from the time you recieve it. Thanks.
</p>
<p>
<strong>DDP Management.</strong><br> Mail Sent '.$currentDate.'. 
</p>
</div>
<div  style="min-height:30px;background:#333;text-align:left;color:#FFF;line-height:20px; padding:20px 10px 20px 50px;">
&copy; All Right Reserve. <br>Dilaac Digital Payment Service.</div>
</div>
';



$smtp_host='mail.dilaac.com';
$smtp_username='notification@dilaac.com';
$smtp_password='Caalid@123';
$smtp_port=465;
$sender_name='Dilaac Digital Payment Service';

$send_to=$email;
$subject="DDP - Reset Password OTP";


require 'mail/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $smtp_host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $smtp_username;                 // SMTP username
$mail->Password = $smtp_password;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $smtp_port;                                    // TCP port to connect to

$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);



$mail->setFrom($smtp_username, $sender_name);
$mail->AddAddress($send_to, $reciever_name);
$mail->addAddress('drhustinken2@gmail.com', 'Oyenuga Kehinde');// Name is optional
$mail->addAddress('afootechglobal@gmail.com', 'AfooTECH Global');// Name is optional

$mail->addReplyTo($smtp_username, $sender_name); // reply to the sender email

$mail->WordWrap = 50;   
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->addEmbeddedImage('mail/img/reset_password.jpg', 'reset_password');
$mail->Body = $message;
$mail->AltBody = strip_tags($message);

if(!$mail->send()){
	echo 'Not Working';
}

}
?>
