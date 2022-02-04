<?php include '../config/connection.php'?>

<?php
  	$action=$_POST['action'];
  switch ($action){

	case 'call_login':
	  $page=$_POST['page'];
	require_once '../content/content-page.php';
	break;
	  


 	case 'vet_email':
	  $email=trim($_POST['email']);
			/////////// confirm user exitence//////////////////////////////////
			$usercheck=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND user_type='CUS'");
					$useremail=mysqli_num_rows($usercheck);
					if ($useremail>0){
						$check=1; /// user  Exist
					}else{
						$check=0; /// user Not Exist
					}
			  ////////sending json///////////////////////////
					  echo json_encode(array("check" => $check)); 
	break;

 
	case 'verify_email':
	  $fullname=trim(strtoupper($_POST['fullname']));
	  $email=trim($_POST['email']);
	  $phone=trim(strtoupper($_POST['phone']));
	  $password=md5($_POST['password']);
			///////////////////////geting sequence//////////////////////////
			$sequence=$callclass->_get_sequence_count($conn, 'DDP');
			$array = json_decode($sequence, true);
			$no= $array[0]['no'];
			//$num= $array[0]['num'];
			$user_id='DDP'.$no;
          ////////////////////// inserting to users_tab//////////////////////////
			$otp = rand(111111,999999);
              mysqli_query($conn,"INSERT INTO `users_tab`
			  (`user_type`, `user_id`, `fullname`, `mobile`, `email`, `status_id`, `otp`, `password`, `reg_date`, `last_login`) VALUES
              ('CUS','$user_id','$fullname','$phone','$email','P','$otp','$password',NOW(),NOW())")or die (mysqli_error($conn));
					//// send mail
				  $mail_to_send='verify_email';
				  require_once('mail/mail.php');
		require_once('../content/content-page.php');
	break;
	
	
	case 'resend_signup_otp':
	  $user_id=trim($_POST['user_id']);
	  $phone=trim(strtoupper($_POST['phone']));
		$user_array=$callclass->_get_user_detail($conn, $user_id);
		$u_array = json_decode($user_array, true);
		$fullname= $u_array[0]['fullname'];
		$email= $u_array[0]['email'];
		$otp= $u_array[0]['otp'];
		//// send mail
		$mail_to_send='verify_email';
		require_once('mail/mail.php');
		require_once('../content/content-page.php');
	break;

	case 'finish_signup':
	  $user_id=trim($_POST['user_id']);
	  $otp=trim(strtoupper($_POST['otp']));
		$user_array=$callclass->_get_user_detail($conn, $user_id);
		$u_array = json_decode($user_array, true);
		$fullname= $u_array[0]['fullname'];
		$email= $u_array[0]['email'];
		$phone= $u_array[0]['phone'];
		$db_otp= $u_array[0]['otp'];
		if ($otp==$db_otp){
			$check=1; //OTP Confirmed

				  /////////// get alert//////////////////////////////////
				 $alert_detail="Success Alert: A new merchant have just sighn-up. Details  : $fullname | $email | $phone";
			  $callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$fullname,$ip_address,$sysname);
		}else{
			$check=0; //invalid OTP
		}
		echo json_encode(array("check" => $check)); 
	break;


	case 'sign_up_finish':
		require_once('../content/content-page.php');
	break;




	  
	  
 	case 'login_check': // for user login
				$username=trim($_POST['username']);
				$password=trim(md5($_POST['password']));
					$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$username' and password='$password' AND user_type='CUS'");
					$usercount = mysqli_num_rows($query);
					if ($usercount>0){
						$usersel=mysqli_fetch_array($query);
						$status=$usersel['status_id'];
							if ($status=='A'){
								$check=1; ///// account is active
							}else{
								$check=2; ///// account is suspended
							}
					}else{
						$check=0; //invalid login details
					}
					
					echo json_encode(array("check" => $check)); 
	break;


	case 'login': // login from index
		$userquery = mysqli_query ($conn,"SELECT * FROM `users_tab` WHERE email = '$suser' AND password = '$spass' AND user_type='CUS' AND status_id='A'");
				$usersel=mysqli_fetch_array($userquery);
				$userid=$usersel['user_id'];
				$_SESSION['userid'] = $userid;
				$suserid=$_SESSION['userid'];
				mysqli_query($conn,"UPDATE `users_tab` SET last_login=NOW() WHERE user_id='$suserid'"); //// update last login
				
				?>
					<script>
						window.parent(location="../login/u");
					</script>
				<?php
	break;
	  
	  
	  
 	case 'proceed_reset_password':
	    	$email=$_POST['email'];
			/////////// confirm user exitence//////////////////////////////////
			$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND user_type='CUS'");
					$checkemail=mysqli_num_rows($query);
					if ($checkemail>0){
					  $fetch=mysqli_fetch_array($query);
						$user_id= $fetch['user_id'];
								 $user_array=$callclass->_get_user_detail($conn, $user_id);
								  $u_array = json_decode($user_array, true);
									$fullname= $u_array[0]['fullname'];
									$status_id= $u_array[0]['status_id'];
						if ($status_id=='A'){
						$otp = rand(111111,999999);
						////////////////update user OTP///////////////
							mysqli_query($conn,"UPDATE users_tab SET otp='$otp' WHERE user_id ='$user_id' AND email='$email'")
							or die("cannot update users_tab");
						////////////////send OTP true email///////////////
						  $mail_to_send='send_reset_password_otp';
						  require_once('mail/mail.php');
						 
						$check=1; /// user  Active
						}elseif($status_id=='I'){
						$check=2; /// user inactive
						}elseif($status_id=='S'){
						$check=3; /// user Suspended
						}else{
						$check=4; /// user Pending
						}
					}else{
						$check=0; /// user Not Exist
					}
			  ////////sending json///////////////////////////
					  echo json_encode(array("check" => $check)); 
	break;


 	case 'reset_password':
	  $email=trim($_POST['email']);
	require_once('../content/content-page.php');
	break;
	
 	case 'resend_otp':
	    	$email=$_POST['email'];	  
			$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email'");
					  $fetch=mysqli_fetch_array($query);
				$user_id= $fetch['user_id'];
			 $user_array=$callclass->_get_user_detail($conn, $user_id);
 			  $u_array = json_decode($user_array, true);
				$otp= $u_array[0]['otp'];
				$fullname= $u_array[0]['fullname'];
						////////////////send OTP true email///////////////
						  $mail_to_send='send_reset_password_otp';
						  require_once('mail/mail.php');
	break;	
	
 	case 'finish_reset_password':
	  $email=trim($_POST['email']);
	  $password=md5($_POST['password']);
	  $otp=trim($_POST['otp']); 
					////////// Check and insert into customers_tab
					$check_user_que=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND otp='$otp'");
					$user_count = mysqli_num_rows($check_user_que);
						if ($user_count>0){ ///// check 1
						
						//////////////get the user ID //////////////
							$user_sel=mysqli_fetch_array($check_user_que);
							$user_id=$user_sel['user_id'];
						//////////////////////////////////////////////////
						  $fetch=$callclass->_get_user_detail($conn, $user_id);
							$array = json_decode($fetch, true);
							  $fullname=$array[0]['fullname'];
						  mysqli_query($conn,"UPDATE users_tab SET password='$password' WHERE 
						 	user_id='$user_id' AND otp='$otp'")or die (mysqli_error($conn));
						  $check=1;
				  /////////// get alert//////////////////////////////////
				 $alert_detail="Success Alert: A Merchant whose name is: $fullname with ID: $user_id have just reset his/her password. Ref:--- $email";
			  $callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$fullname,$ip_address,$sysname);
						}else{						
						  $check=0;
						}
					  echo json_encode(array("check" => $check)); 
	break;

 	case 'password_reset_completed':
	require_once('../content/content-page.php');
	break;
	




  }?>
