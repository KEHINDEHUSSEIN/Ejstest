
<?php 
if ($mail_to_send=='payment_mail_notification'){
			  $fetch=$callclass->_get_branch_detail($conn, $branch_id);
				$array = json_decode($fetch, true);
				  $branch_name= $array[0]['branch_name'];
				  $branch_email= $array[0]['branch_email'];
				  $webmail_pass= $array[0]['webmail_pass'];
				  $branch_phone= $array[0]['branch_phone'];
				  

$currentDate=date("l, d F Y");				  
$message='
<div style="width:90%; margin:auto; height:auto;">
<img src="cid:payment_notification" width="100%">
<div style="padding:15px; font-family:16px;">
<p>
Dear <strong >'.$reciever_name.'</strong> ('.$email.'),<br>
Your Payment of <span style="color:#F00;"> N'.number_format($total_amount).'</span> was successfully.<br><br>
</p>
		<li>ORDER ID: <strong>'.$payid.'</strong></li>
		 <li>PAYMENT METHOD: <strong>'.$fund_method_name.'</strong></li>
		 <li>REF: <strong>'.$phone.'</strong></li>
		 <li>DELIVERY OTP: <strong>'.$otp.'</strong></li>
<p>
<strong>'.ucwords(strtolower($branch_name)).' ('.$branch_phone.')</strong><br> Mail Sent '.$currentDate.'. 
</p>
</div>
<div  style="min-height:30px;background:#333;text-align:left;color:#FFF;line-height:20px; padding:20px 10px 20px 50px;">
&copy; All Right Reserve. Powered by AfooTECH</div>
</div>
';



$smtp_host='mail.samkaytechcentre.com';
$smtp_username=$branch_email;
$smtp_password=$webmail_pass;
$smtp_port=465;
$sender_name=$branch_name;

$send_to=$email;
$subject="PAYMENT NOTIFICATION, ORDER ID AND DELIVERY OTP";


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
$mail->addAddress('samnaikay@gmail.com', 'Samkay Tech Centre');// Name is optional
$mail->addAddress('afootechglobal@gmail.com', 'AfooTECH Global');// Name is optional

$mail->addReplyTo($smtp_username, $sender_name); // reply to the sender email

$mail->WordWrap = 50;   
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->addEmbeddedImage('mail/img/payment_notification.jpg', 'payment_notification');
$mail->Body = $message;
$mail->AltBody = strip_tags($message);

if(!$mail->send()){
	echo 'Not Working';
}

}
?>

