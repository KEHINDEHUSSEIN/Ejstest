<?php require_once '../../../config/connection.php';?>
<?php require_once('session-validation.php');?>
<?php
$action=$_POST['action'];
switch ($action){

case 'logout': // reset password
		session_destroy();
		?>
		<script>
		window.parent(location="../../../");
		</script>
		<?php
break;	


case 'get_notification_number':
		$alertcount=mysqli_fetch_array(mysqli_query($conn,"SELECT count(seen_status) FROM alert_tab WHERE seen_status=0 AND user_id='$user_id'"));
		$num=$alertcount[0];
		echo json_encode(array("check" => $num));
break;



case 'get-page':
		$view_content=$_POST['page'];
		require_once '../content/content-page.php';
break;



case 'get_access_token_for_status':
		$proj_status=$_POST['proj_status'];
		if($proj_status=='closed'){
		mysqli_query($conn,"UPDATE `projects_tab` SET status_id='S' WHERE project_id='$project_id'")or die ("cannot update project_tab");
		}else{
		mysqli_query($conn,"UPDATE `projects_tab` SET status_id='A' WHERE project_id='$project_id'")or die ("cannot update project_tab");
		}
		echo json_encode(array("access_token" => $access_token)); 
break;	



case 'get-form':
		$view_content=$_POST['page'];
		require_once '../content/content-page.php';
break;




case 'trend_json':
		/// get presentation values
		$day30= date('F d Y', strtotime('today - 30 days'));
		$today= date('F d Y');	
		
		/// get chat values
		$db_day30= date('Y-m-d', strtotime('today - 30 days'));
		$db_today= date('Y-m-d');
		echo json_encode(array("startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;


case 'trendbarchart':
		$trend=$_POST['trend'];
		$grandAmount=$_POST['grandAmount'];
		/// get presentation values
		$day30=$_POST['display_startDate'];
		$today= $_POST['display_endDate'];	
		$check_code='trendbarchart';
		require_once('../content/sub-codes.php');
break;

case 'chat_for_pie':	
		$success=$_POST['success'];			  
		$pending=$_POST['pending'];			  
		$failed=$_POST['failed'];
		$check_code='chat_for_pie';
		require_once('../content/sub-codes.php');
break;



case 'get_access_token_for_pie_chart':
		echo json_encode(array("access_token" => $access_token)); 
break;




case 'dashboard_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("access_token" => $access_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;


















case 'system_alert':
		$view_report=$_POST['view_report'];
		$all_search_txt=$_POST['all_search_txt'];			  
		require_once '../content/report-date-schedule.php';
		$check_code='alert-list';
		require_once '../content/sub-codes.php';
break;


case 'read_alert': 
		$alert_id = $_POST['alert_id'];
		$view_content=$action;
		require_once '../content/content-page.php';
break;








case 'user-profile': 
	$view_content='user-profile';
	$users_id=$_POST['users_id'];
	require_once '../content/content-page.php';
break;


case 'update_profile_pix': // Upload Profile Pix for first time login
		$passport=$_FILES['passport']['name'];
		$datetime=date("Ymdhi");
		
		$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF");
		$extension = pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);
		
		if (in_array($extension, $allowedExts)){				  
		$passport = $datetime.'_'.$passport;
		move_uploaded_file($_FILES["passport"]["tmp_name"],"../../sa/uploaded_files/client_passport/" .$passport);
		}
		
		mysqli_query($conn,"UPDATE `users_tab` SET passport='$passport' WHERE user_id='$suserid'")
		or die ("cannot update users_tab");
		/////////// get alert//////////////////////////////////
		$alert_detail='Success Alert: '.$user_name.' Updated profile picture';
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
break;


case 'update_user_password': 
		$oldpass=md5($_POST['oldpass']);
		$newpass=$_POST['newpass'];
		$newpass=md5($newpass);
		$userpass=mysqli_num_rows(mysqli_query($conn,"SELECT password FROM users_tab WHERE password='$oldpass' AND user_id ='$suserid' "));
			if ($userpass>0){
				mysqli_query($conn,"UPDATE users_tab SET password='$newpass' WHERE user_id='$suserid'")
				or die ("cannot update users_tab");
				/////////// get alert//////////////////////////////////
				$alert_detail='Success Alert: User Password changed by '.$user_name;
				$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
				$check=1; /// password updated
				session_destroy();
			}else{
				$check=0; //password not updated
			}
		echo json_encode(array("check" => $check)); 
break;	


case 'update_users_profile': 
	$fullname=trim(strtoupper($_POST['fullname']));
	$email=trim($_POST['email']);
	$phone=trim(strtoupper($_POST['phone']));
	$check_email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND user_id!='$user_id' LIMIT 1"));				
		if ($check_email>0){/// check 1
			$alert_detail='Error Alert: '.$user_name.' profile was NOT updated due to email error';
			$check=0;
		}else{/// else check 1
			mysqli_query($conn,"UPDATE users_tab SET fullname='$fullname',mobile='$phone',email='$email' WHERE user_id='$user_id'")
			or die ("cannot update users_tab");
			$alert_detail='Success Alert: '.$user_name.'  updated his/her profile successful';
			$check=1;
		}/// end check 1
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
	echo json_encode(array("check" => $check));
break;	




















case 'get_otp_sent_to_email_to_verify': 
	$project_name=trim(strtoupper($_POST['project_name']));
	$project_email=trim($_POST['project_email']);
	$project_phone=trim($_POST['project_phone']);
	$country_code=trim($_POST['country_code']);
	$project_password=$_POST['project_password'];

		///////////////////////geting sequence//////////////////////////
		$sequence=$callclass->_get_sequence_count($conn, 'DDP_P');
		$array = json_decode($sequence, true);
		$no= $array[0]['no'];
		//$num= $array[0]['num'];
		$project_id='DDP_P'.$no;

		$_SESSION['project_id']=$project_id;

		mysqli_query($conn,"INSERT INTO `projects_tab`
		(`user_id`, `project_id`, `project_name`, `project_email`, `project_phone`, `project_password`, `status_id`, `country_code`,  `date`)VALUES
		('$user_id', '$project_id', '$project_name','$project_email', '$project_phone', '$project_password', 'P', '$country_code', NOW())")or die (mysqli_error($conn));
	
	$view_content=$action;
	require_once '../content/content-page.php';
break;	






case 'first_login_success': 
	$project_client_id=trim(($_POST['project_client_id']));
	$project_id=trim(($_POST['project_id']));
	$_SESSION['project_id']=$project_id;

	$access_token=trim(($_POST['access_token']));
	$_SESSION['access_token']=$access_token;
	mysqli_query($conn,"UPDATE projects_tab SET current_project='N' WHERE user_id='$user_id'")or die (mysqli_error($conn));
	mysqli_query($conn,"UPDATE projects_tab SET project_client_id='$project_client_id', current_project='Y', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));

			$alert_detail="Success Alert: Project Created successfully by $user_name. ID: $project_id ";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);

			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$country_code=$p_array[0]['country_code'];

			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_alias=$c_array[0]['country_alias'];

		echo json_encode(array("access_token" => $access_token,"country_alias" => $country_alias)); 
break;	








case 'get_access_token_to_session': 
	$access_token=trim(($_POST['access_token']));
	$_SESSION['access_token']=$access_token;
break;	










case 'update_project_profile_locally': 
	$project_name=trim(strtoupper($_POST['project_name']));
	$project_email=trim($_POST['project_email']);
	$project_phone=trim($_POST['project_phone']);
	mysqli_query($conn,"UPDATE projects_tab SET project_name='$project_name',project_email='$project_email', project_phone='$project_phone', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
		$alert_detail="Success Alert: Project Updated successfully by $user_name. ID: $project_id ";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
break;	







case 'get-setup': 
	$check_code=$_POST['page'];
	$project_id=$_POST['project_id'];
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];
				$project_phone=$p_array[0]['project_phone'];
				$project_email=$p_array[0]['project_email'];
				$project_password= $p_array[0]['project_password'];
				$project_status= $p_array[0]['status_id'];
				$country_code=$p_array[0]['country_code'];

					$fetch_acount=$callclass->_get_project_account_detail($conn, $project_id);
					  $array = json_decode($fetch_acount, true);
						$f_payout_type_id= $array[0]['payout_type_id'];
						$bank_id= $array[0]['bank_id'];
					  	$bank_name= $array[0]['bank_name'];
						$account_number= $array[0]['account_number'];
						$account_name= $array[0]['account_name'];
						$business_certificate= $array[0]['business_certificate'];
					  	$business_reg_number= $array[0]['business_reg_number'];
					  	$activation_status_id= $array[0]['activation_status_id'];
						$collection_service_charge= $array[0]['collection_service_charge'];
						$payout_service_charge=$array[0]['payout_service_charge'];
						$staff_id= $array[0]['staff_id'];



			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_name=$c_array[0]['country_name'];
				$country_alias=$c_array[0]['country_alias'];

	require_once('../content/sub-codes.php');
break;	



case 'save_momo_payout': 
	$payout_type_id=$_POST['payout_type_id'];
	$momo_id=$_POST['momo_id'];
	$momo_name=$_POST['momo_name'];
	$momo_number=$_POST['momo_number'];
	$count_acount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1"));				
		if ($count_acount>0){/// check 1
		mysqli_query($conn,"UPDATE projects_bank_detail_tab SET payout_type_id='$payout_type_id',bank_id='$momo_id',bank_name='$momo_name',account_number='$momo_number', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
		}else{/// else check 1
		mysqli_query($conn,"INSERT INTO `projects_bank_detail_tab`
		(`project_id`, `payout_type_id`, `bank_id`, `bank_name`, `account_number`, `date`) VALUES
		('$project_id', '$payout_type_id','$momo_id','$momo_name','$momo_number',NOW())")or die (mysqli_error($conn));
		}
		$alert_detail="Success Alert: Payout Setup Saved successfully by $user_name. Details---- ID: $project_id | Name: $project_name | MoMo Name: $momo_name | MoMo Number: $momo_number";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
break;	

case 'save_bank_payout': 
	$payout_type_id=$_POST['payout_type_id'];
	$bank_id=$_POST['bank_id'];
	$bank_name=$_POST['bank_name'];
	$account_number=$_POST['account_number'];
	$account_name=$_POST['account_name'];
	$count_acount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1"));				
		if ($count_acount>0){/// check 1
		mysqli_query($conn,"UPDATE projects_bank_detail_tab SET payout_type_id='$payout_type_id',bank_id='$bank_id',bank_name='$bank_name',account_number='$account_number', account_name='$account_name', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
		}else{/// else check 1
		mysqli_query($conn,"INSERT INTO `projects_bank_detail_tab`
		(`project_id`, `payout_type_id`, `bank_id`, `bank_name`, `account_number`, `account_name`, `date`) VALUES
		('$project_id', '$payout_type_id','$bank_id','$bank_name','$account_number', '$account_name',NOW())")or die (mysqli_error($conn));
		}
		$alert_detail="Success Alert: Payout Setup Saved successfully by $user_name. Details---- ID: $project_id | Name: $project_name | Bank: $bank_name | Accoun Number: $account_number";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
break;	








case 'request_for_business_activation': 
	$business_number=$_POST['business_number'];
					$datetime=date("Ymdhis");	
					$up_note=$_FILES['up_note']['name'];
					$allowedExts = array("pdf", "doc");
					$extension = pathinfo($_FILES['up_note']['name'], PATHINFO_EXTENSION);
						if (in_array($extension, $allowedExts)){				  
					  $up_note = $datetime.'_'.$up_note;
					  move_uploaded_file($_FILES["up_note"]["tmp_name"],"../../sa/uploaded_files/business_certificate/".$up_note);
						}
	
				$count_acount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1"));				
				if ($count_acount>0){/// check 1
					mysqli_query($conn,"UPDATE projects_bank_detail_tab SET business_certificate='$up_note',business_reg_number='$business_number', activation_status_id='P', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
				}else{/// else check 1
					mysqli_query($conn,"INSERT INTO `projects_bank_detail_tab`
					(project_id,business_certificate,business_reg_number,activation_status_id,date) VALUES
					('$project_id', '$up_note','$business_number','P',NOW())")or die (mysqli_error($conn));
				}
					$alert_detail="Success Alert: Project Activation Requested successfully by $user_name. Details---- ID: $project_id, Name: $project_name ";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);

break;	





case 'fetch_project_list': 
	$check_code='project-list';
	$all_search_txt=$_POST['all_search_txt'];
	require_once('../content/sub-codes.php');
break;	



case 'switch_to_project': 
	$project_id=trim(($_POST['project_id']));
	$_SESSION['project_id']=$project_id;
	
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];

	$_SESSION['access_token']='';

	mysqli_query($conn,"UPDATE projects_tab SET current_project='N' WHERE user_id='$user_id'")or die (mysqli_error($conn));
	mysqli_query($conn,"UPDATE projects_tab SET current_project='Y', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
	
		$alert_detail="Success Alert: Project Switched to $project_name successfully by $user_name. ID: $project_id ";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);

	$check_code='project-list';
	$all_search_txt=$_POST['all_search_txt'];
	require_once('../content/sub-codes.php');
break;	


















case 'payout_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("access_token" => $access_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;



case 'collections_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("access_token" => $access_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;






}?>
