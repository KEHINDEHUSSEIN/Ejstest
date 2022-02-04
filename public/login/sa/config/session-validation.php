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
<button class="action-btn"  onClick="window.location.href='../'"><i class="fa fa-check"></i> OK</button>
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
	
				$pending_project_count= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) FROM projects_tab WHERE status_id='P'"));
				$pending_project_count=number_format($pending_project_count[0]);
				
}?>



<?php
if(($user_id=='') || ($user_status_id!='A')){
		session_destroy();
				?>
					<script>
					window.parent(location="../");
					</script>
<?php }?>


