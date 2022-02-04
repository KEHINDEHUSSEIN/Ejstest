<?php require_once '../../../config/connection.php';?>
<?php require_once('session-validation.php');?>
<?php
$action=$_POST['action'];
switch ($action){

case 'logout': // reset password
		session_destroy();
		?>
		<script>
		window.parent(location="../../");
		</script>
		<?php
break;	


case 'get_notification_number':
		$alertcount=mysqli_fetch_array(mysqli_query($conn,"SELECT count(seen_status) FROM alert_tab WHERE seen_status=0 AND user_id='$user_id'"));
		$num=$alertcount[0];
		echo json_encode(array("check" => $num));
break;



case 'get_admin_token_to_session': 
	$admin_token=trim(($_POST['admin_token']));
	$_SESSION['admin_token']=$admin_token;
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
		$AmountTrend=$_POST['AmountTrend'];
		$ChargesTrend=$_POST['ChargesTrend'];
		$CountTrend=$_POST['CountTrend'];
		
		$grandAmount=$_POST['grandAmount'];
		$totalCharges=$_POST['totalCharges'];
		
		/// get presentation values
		$day30=$_POST['display_startDate'];
		$today= $_POST['display_endDate'];	
		$check_code='trendbarchart';
		require_once('../content/sub-codes.php');
break;


case 'dashboard_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("admin_token" => $admin_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;

case 'collection_matrix':	
		$success=$_POST['success'];			  
		$pending=$_POST['pending'];			  
		$failed=$_POST['failed'];
		$check_code='collection_matrix';
		require_once('../content/sub-codes.php');
break;
case 'payout_matrix':	
		$success=$_POST['success'];			  
		$pending=$_POST['pending'];			  
		$failed=$_POST['failed'];
		$check_code='payout_matrix';
		require_once('../content/sub-codes.php');
break;










case 'get-page':
		$view_content=$_POST['page'];
		require_once '../content/content-page.php';
break;


case 'get-form':
		$view_content=$_POST['page'];
		require_once '../content/content-page.php';
break;














case 'create_user': 
			$fullname=trim(strtoupper($_POST['fullname']));
			$email=trim($_POST['email']);
			$phone=trim(strtoupper($_POST['phone']));
			$status_id=trim(strtoupper($_POST['status_id']));
			$role_id=trim(strtoupper($_POST['role_id']));
			
		  $usercheck=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_type='ST' AND email='$email'");
			  $useremail=mysqli_num_rows($usercheck);
			  if ($useremail>0){
				  $check=0; /// user  Exist
		 $alert_detail="Success Alert: A new administrator named $fullname was NOT successfully registered due to email error. Acrion by $user_name.";
			  }else{
				  $check=1; /// user Not Exist
	  ///////////////////////geting sequence//////////////////////////
	  $sequence=$callclass->_get_sequence_count($conn, 'DDP');
	  $array = json_decode($sequence, true);
	  $no= $array[0]['no'];
	  //$num= $array[0]['num'];
	  $staff_id='DDP'.$no;
	  $password=md5($staff_id);		  
		mysqli_query($conn,"INSERT INTO `users_tab`
		(`user_type`, `user_id`, `fullname`, `mobile`, `email`, `role_id`, `status_id`, `password`, `reg_date`, `last_login`)
		('ST', '$staff_id', '$fullname', '$phone', '$email', '$role_id', '$status_id', '$password', NOW(), NOW())")or die (mysqli_error($conn));
		  /////////// get alert//////////////////////////////////
		 $alert_detail="Success Alert: A new administrator was registered successfully by $user_name. Details ----- ID: $staff_id | NAME: $fullname | Email: $email | Phone Number: $phone. ";
			  }
	$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
		////////sending json///////////////////////////
				echo json_encode(array("check" => $check)); 
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
		move_uploaded_file($_FILES["passport"]["tmp_name"],"../uploaded_files/staff_passport/" .$passport);
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
	$user_id=$_POST['user_id'];
	$fullname=trim(strtoupper($_POST['fullname']));
	$email=trim($_POST['email']);
	$phone=$_POST['phone'];
	$status_id=$_POST['status_id'];
	$role_id=$_POST['role_id'];
	$check_email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND user_id!='$user_id' AND user_type='ST' LIMIT 1"));				
		if ($check_email>0){/// check 1
			$alert_detail="Error Alert: $fullname profile was NOT updated due to email error. Action By: $user_name";
			$check=0;
		}else{/// else check 1
			mysqli_query($conn,"UPDATE users_tab SET fullname='$fullname',mobile='$phone',email='$email', status_id='$status_id', role_id='$role_id' WHERE user_id='$user_id'")
			or die ("cannot update users_tab");
			$alert_detail="Success Alert: $fullname profile was updated successfully.  Action By: $user_name";
			$check=1;
		}/// end check 1
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
	echo json_encode(array("check" => $check));
break;	


case 'fetch_users_list': 
	  $status_id=$_POST['status_id'];
	  $all_search_txt=$_POST['all_search_txt'];
	  $check_code='user-list';
	  require_once '../content/sub-codes.php';
break;	
	































case 'get-form-with-id':
		$ids=$_POST['ids'];
		$view_content=$_POST['page'];
		require_once '../content/content-page.php';
break;


case 'get_project_status':
		$proj_status=$_POST['proj_status'];
		if($proj_status=='closed'){?>
		<div class="status close" onclick="_get_project_status('live')"><div class="text animated fadeInRight animated animated">CLOSED</div> <div class="signal animated fadeInLeft animated animated"></div></div>
		<?php }else{?>
		<div class="status" onclick="_get_project_status('closed')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">LIVE</div></div>
		<?php
		}
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






























case 'project_list_tab': 
	$status_id=$_POST['status_id'];
    	$fetch=$callclass->_get_status_detail($conn, $status_id);
		$array = json_decode($fetch, true);
		$status_name= $array[0]['statusname'];
		
	$check_code='project-list';
    require_once '../content/sub-codes.php';
break;	


case 'fetch_project_list': 
	$check_code='project-list';
	$all_search_txt=$_POST['all_search_txt'];
	require_once('../content/sub-codes.php');
break;	


















case 'get-setup': 
	$check_code=$_POST['page'];
	$project_id=$_POST['project_id'];

			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_client_id=$p_array[0]['project_client_id'];
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
					  	$payout_service_charge= $array[0]['payout_service_charge'];
					  	$collection_charge_type= $array[0]['collection_charge_type'];


			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_name=$c_array[0]['country_name'];
				$country_alias=$c_array[0]['country_alias'];

	require_once('../content/sub-codes.php');
break;	






case 'activate_project_panel': 
	$check_code=$action;
	$project_id=$_POST['project_id'];
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_client_id=$p_array[0]['project_client_id'];
				$project_name=$p_array[0]['project_name'];
				$country_code=$p_array[0]['country_code'];


			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_name=$c_array[0]['country_name'];

					$fetch_acount=$callclass->_get_project_account_detail($conn, $project_id);
					  $array = json_decode($fetch_acount, true);
						$collection_service_charge= $array[0]['collection_service_charge'];
					  	$payout_service_charge= $array[0]['payout_service_charge'];
						$collection_charge_type= $array[0]['collection_charge_type'];
					  	$payout_charge_type= $array[0]['payout_charge_type'];

require_once('../content/sub-codes.php');
break;	



case 'activate_project': 
	$project_id=$_POST['project_id'];
	$collection_charges=$_POST['collection_charges'];
	$collection_charges_type=$_POST['collection_charges_type'];
	$payout_charges=$_POST['payout_charges'];
	$payout_charges_type=$_POST['payout_charges_type'];
	
	
		mysqli_query($conn,"UPDATE projects_bank_detail_tab SET activation_status_id='A',
		collection_service_charge='$collection_charges',collection_charge_type='$collection_charges_type',
		payout_service_charge='$payout_charges',payout_charge_type='$payout_charges_type',
		staff_id='$user_id', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));
		
		mysqli_query($conn,"UPDATE projects_tab SET status_id='A', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));

			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];
		$alert_detail="Success Alert: A project named: $project_name was activated successfully.  Action By: $user_name";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
break;	




case 'delete_project': 
	$user_id=$_POST['user_id'];
	$project_id=$_POST['project_id'];

			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];
		$alert_detail="Success Alert: A project named: $project_name (ID: $project_id) was deleted successfully.  Action By: $user_name";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
		
		mysqli_query($conn,"DELETE FROM projects_bank_detail_tab WHERE project_id='$project_id'");
		mysqli_query($conn,"DELETE FROM projects_tab WHERE project_id='$project_id'");
		
	mysqli_query($conn,"UPDATE projects_tab SET current_project='N' WHERE user_id='$user_id'");
	mysqli_query($conn,"UPDATE projects_tab SET current_project='Y' WHERE user_id='$user_id' LIMIT 1");
break;	

case 'suspend_project': 
	$project_id=$_POST['project_id'];
		mysqli_query($conn,"UPDATE projects_tab SET status_id='S', date=NOW() WHERE project_id='$project_id'")or die (mysqli_error($conn));

			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];
		$alert_detail="Success Alert: A project named: $project_name (ID: $project_id) was Suspended successfully.  Action By: $user_name";
		$callclass->_alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname);
		
break;	




























case 'collections_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("admin_token" => $admin_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;


case 'payout_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("admin_token" => $admin_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;


case 'transfer_report':
		$view_report=$_POST['view_report'];
		require_once '../content/report-date-schedule.php';
		echo json_encode(array("admin_token" => $admin_token,"startDate" => $db_day30,"endDate" => $db_today,"display_startDate" => $day30,"display_endDate" => $today)); 
break;








}?>
