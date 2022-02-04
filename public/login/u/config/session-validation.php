<?php
if(empty($suserid)){
session_destroy();
?>
<div class="alert-div">
<div class="alert-div-in">
<div class="animated fadeInDown animated animated">
<div class="avater"><img src="all-images/images/warning.gif" /></div>
<span>Login Session Expired!</span><br /> Please Re-Login To Continue
</div>
<div class="animated fadeInUp animated animated">
<button class="action-btn"  onClick="window.location.href='../../'"><i class="fa fa-check"></i> OK</button>
</div>
</div>
</div>
<?php 
exit;
}else{
	
$userquery=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$suserid' AND status_id='A'");
$user_sel=mysqli_fetch_array($userquery);
	$user_id=$user_sel['user_id'];
 $user_array=$callclass->_get_user_detail($conn, $user_id);
 			  $u_array = json_decode($user_array, true);
				$user_id=$u_array[0]['user_id'];
				$user_name= $u_array[0]['fullname'];
				$user_mobile= $u_array[0]['mobile'];
				$user_email= $u_array[0]['email'];
				$user_passport= $u_array[0]['passport'];
				$user_otp= $u_array[0]['otp'];
				$user_status_id= $u_array[0]['status_id'];
						$fatch=$callclass->_get_status_detail($conn, $user_status_id);
						  $array = json_decode($fatch, true);
							$user_status_name= $array[0]['statusname'];
				$user_reg_date= $u_array[0]['reg_date'];
				$user_last_login= $u_array[0]['last_login'];
	
				$projectcount= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) FROM projects_tab WHERE user_id='$user_id' AND current_project='Y'"));
				$projectcount=$projectcount[0];
				
			if ($projectcount>0){
			$project_query=mysqli_query($conn,"SELECT * FROM projects_tab WHERE user_id='$user_id' AND current_project='Y' LIMIT 1");
			$projec_sel=mysqli_fetch_array($project_query);
				$project_id=$projec_sel['project_id'];
			
				$projectcount= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) FROM projects_tab WHERE user_id='$user_id'"));
				$projectcount=number_format($projectcount[0]);

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
				$collection_charge_type= $array[0]['collection_charge_type'];
				$payout_service_charge=$array[0]['payout_service_charge'];
				$payout_charge_type= $array[0]['payout_charge_type'];
				$staff_id= $array[0]['staff_id'];

					$fetch_collection_charge=$callclass->_get_service_charge_type_detail($conn, $collection_charge_type);
					  $array = json_decode($fetch_collection_charge, true);
						$collection_charge_name= $array[0]['service_charge_type_name'];
						
					$fetch_payout_charge=$callclass->_get_service_charge_type_detail($conn, $payout_charge_type);
					  $array = json_decode($fetch_payout_charge, true);
						$payout_charge_name= $array[0]['service_charge_type_name'];

			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_name=$c_array[0]['country_name'];
				$country_alias=$c_array[0]['country_alias'];
				
				if ($access_token==''){
				$_SESSION['project_id']=$project_id;
				/// login to get the access_token on session
				?>
					<script>
						$(document).ready(function() {
								_login_and_get_access_token_to_session('<?php echo $project_email; ?>','<?php echo $project_password; ?>');
								
						});
					</script>
			<?php }
			}
				
}?>

<?php
if(($user_id=='') || ($user_status_id!='A')){
		session_destroy();
				?>
					<script>
					window.parent(location="../../");
					</script>
<?php }?>


