<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header("Access-Control-Allow-Origin: *");

$website='https://ddp.afootechglobal.com';
$thename='DDP - Dilaac Digital Payment Service';
$page = basename($_SERVER['SCRIPT_NAME']);
$ip_address=$_SERVER[REMOTE_ADDR]; //ip used
$sysname=gethostname();//computer used
/////////////////////////////////////////////////////////////////

$siteuser='root';
$serverpass='';

//$siteuser='afootech';
//$serverpass='.$AG@2020';
$hostname = "localhost";  
//conn_admin string with database  
$conn = mysqli_connect($hostname, $siteuser, $serverpass)or die("Unable to connect to MySQL");
mysqli_select_db($conn,"afootech_ddp");
/////////////////////////////////////////////////////////////////
?>

<?php
session_start();
////////// login session
if ($_POST && !empty($_POST['username'])) {
$_SESSION['username'] = $_POST['username'];
}
$suser=$_SESSION['username'];
if ($_POST && !empty($_POST['password'])) {
$_SESSION['password'] = $_POST['password'];
}
$spass=md5($_SESSION['password']);

///// user session
$suserid=$_SESSION['userid'];


//// for client admin
$project_id=$_SESSION['project_id'];
$sproject_id=$_SESSION['project_id'];
$access_token=$_SESSION['access_token'];



///// for DDP admin
$admin_token=$_SESSION['admin_token'];




$super_admin_username='info@dilaac.com';
$super_admin_password='admin_ddp_pass';
?>



































































































































































































































<?php


class allClass{

    function _get_user_detail($conn, $user_id){
$usersquery=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$user_id'")or die ('cannot select users_tab');
$users_sel=mysqli_fetch_array($usersquery);
	$user_id=$users_sel['user_id'];
	$fullname=$users_sel['fullname'];
	$mobile=$users_sel['mobile'];
	$email=$users_sel['email'];
	$passport=$users_sel['passport'];
	if ($passport==''){
		$passport='friends.png';
	}
	$otp=$users_sel['otp'];
	$role_id=$users_sel['role_id'];
	$status_id=$users_sel['status_id'];
	$reg_date=$users_sel['reg_date'];
	$last_login=$users_sel['last_login'];
	
return '[{"user_id":"'.$user_id.'","fullname":"'.$fullname.'","mobile":"'.$mobile.'","email":"'.$email.'","passport":"'.$passport.'","otp":"'.$otp.'",
"role_id":"'.$role_id.'","status_id":"'.$status_id.'","reg_date":"'.$reg_date.'","last_login":"'.$last_login.'"}]';
}	
		
		
/////////////////////////////		
	function _alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname){
			  $alertsele=mysqli_fetch_array(mysqli_query($conn,"SELECT mast_val FROM masters_tab WHERE mast_id = 'ALT' FOR UPDATE"));
			  $alertno=$alertsele[0]+1;
			  $alertid='ALT'.$alertno;
				  
				mysqli_query($conn,"INSERT INTO `alert_tab` VALUES( '','$alertid','$alert_detail', '$user_id','$user_name', '$ip_address',
				 '$sysname','0',NOW())")or die ("cannot insert alert_tab");
				 
				mysqli_query($conn,"UPDATE masters_tab SET mast_val='$alertno' WHERE mast_id = 'ALT'")
				or die("cannot update masters_tab");
		}


////////////////////////////
    function _get_sequence_count($conn, $item){
			 $count=mysqli_fetch_array(mysqli_query($conn,"SELECT mast_val FROM masters_tab WHERE mast_id = '$item' FOR UPDATE"));
			  $num=$count[0]+1;
			  mysqli_query($conn,"UPDATE `masters_tab` SET `mast_val` = '$num' WHERE mast_id = '$item'")
			  or die("cannot update masters_tab $item");
 			  if ($num<10){$no='00'.$num;}elseif($num>10 && $num<100){$no='0'.$num;}else{$no=$num;}
			  return '[{"num":"'.$num.'","no":"'.$no.'"}]';
       }
		
/////////////////////////////////////////
	function _get_role_detail($conn, $role_id){
		$query=mysqli_query($conn,"SELECT * FROM role_tab WHERE role_id = '$role_id'");
		$fetch=mysqli_fetch_array($query);
			$rolename=$fetch['role_name'];
		return '[{"rolename":"'.$rolename.'"}]';
	}
		
/////////////////////////////////////////
	function _get_status_detail($conn, $status_id){
		$query=mysqli_query($conn,"SELECT * FROM status_tab WHERE status_id='$status_id'");
		$fetch=mysqli_fetch_array($query);
			$statusname=$fetch['status_name'];
		return '[{"statusname":"'.$statusname.'"}]';
	}
		
		
////////////////////////////////		
	function _admin_title_pane($project_name){?>
            <div class="page-title-div dashbord-title animated fadeInDown animated animated">
            <div class="div-in">
                <div class="left-div">
                    <span id="page-title"><i class="fa fa-dashboard"></i> Admin Dashboard</span><br />
                    <div class="project-name" id="project-title-div"><?php echo ucwords(strtolower($project_name)); ?></div>
                </div>
                <div class="right-div">
                    Current Time<br />
                    <?php $this->_dateTimeText();?>
                    <?php echo date("l, d F Y");?>
                </div>
            </div>
            </div>
            
	<?php }
////////////////////////////////		
	function _super_admin_title_pane($thename){?>
            <div class="page-title-div dashbord-title animated fadeInDown animated animated">
            <div class="div-in">
                <div class="left-div">
                    <span id="page-title"><i class="fa fa-dashboard"></i> Admin Dashboard</span><br />
                    <div class="project-name"><?php //echo $thename; ?></div>
                </div>
                <div class="right-div">
                    Current Time<br />
                    <?php $this->_dateTimeText();?>
                    <?php echo date("l, d F Y");?>
                </div>
            </div>
            </div>
            
	<?php }
		
////////////////////////////////		
	function _dateTimeText(){?>
                        <div class="datetime">
                         <span id="clock"><span id="digitalclock" class="styling"></span></span>
                        </div>
		<?php }
		
		
	function _get_alert_detail($conn, $alert_id){
				$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE alert_id='$alert_id'");
				$fetch = mysqli_fetch_assoc($query); 
				$branch_id = $fetch['branch_id'];
				$user_id = $fetch['user_id'];
				$name = $fetch['name'];
				$ipaddress = $fetch['ipaddress'];
				$computer = $fetch['computer'];
				$seen_status = $fetch['seen_status'];
				$date = $fetch['date'];
				return '[{"branch_id":"'.$branch_id.'","user_id":"'.$user_id.'", "name":"'.$name.'", "ipaddress":"'.$ipaddress.'", "computer":"'.$computer.'", "seen_status":"'.$seen_status.'", "date":"'.$date.'"}]';
	}
		
	////////////////////////////////	

/////////////////////////////////////////
	function _get_customer_otp($conn, $email){
		$query=mysqli_query($conn,"SELECT * FROM customers_tab WHERE email='$email'");
		$fetch=mysqli_fetch_array($query);
			$fullname=$fetch['fullname'];
			$otp=$fetch['otp'];
		return '[{"fullname":"'.$fullname.'","otp":"'.$otp.'"}]';
	}




    function _get_project_detail($conn, $project_id){
$project_query=mysqli_query($conn,"SELECT * FROM projects_tab WHERE project_id='$project_id'");
$project_sel=mysqli_fetch_array($project_query);
	$user_id=$project_sel['user_id'];
	$project_client_id=$project_sel['project_client_id'];
	$project_name=$project_sel['project_name'];
	$project_email=$project_sel['project_email'];
	$project_phone=$project_sel['project_phone'];
	$project_password=$project_sel['project_password'];
	$status_id=$project_sel['status_id'];
	$country_code=$project_sel['country_code'];
	$current_project=$project_sel['current_project'];
	$date=$project_sel['date'];
	
return '[{"user_id":"'.$user_id.'","project_client_id":"'.$project_client_id.'","project_name":"'.$project_name.'","project_email":"'.$project_email.'","project_phone":"'.$project_phone.'",
"project_password":"'.$project_password.'","status_id":"'.$status_id.'","country_code":"'.$country_code.'","current_project":"'.$current_project.'",
"date":"'.$date.'"}]';
}	


	function _get_country_detail($conn, $country_code){
		$query=mysqli_query($conn,"SELECT * FROM country_tab WHERE country_code='$country_code'");
		$fetch=mysqli_fetch_array($query);
			$country_name=$fetch['country_name'];
			$country_alias=$fetch['country_alias'];
		return '[{"country_name":"'.$country_name.'","country_alias":"'.$country_alias.'"}]';
	}

	function _get_project_account_detail($conn, $project_id){
		$query=mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id'");
		$fetch=mysqli_fetch_array($query);
			$payout_type_id=$fetch['payout_type_id'];
			$bank_id=$fetch['bank_id'];
			$bank_name=$fetch['bank_name'];
			$account_number=$fetch['account_number'];
			$account_name=$fetch['account_name'];
			$business_certificate=$fetch['business_certificate'];
			$business_reg_number=$fetch['business_reg_number'];
			$activation_status_id=$fetch['activation_status_id'];
			$collection_service_charge=$fetch['collection_service_charge'];
			$collection_charge_type=$fetch['collection_charge_type'];
			if ($collection_service_charge==0){$collection_service_charge='NOT ASSIGNED YET!';}
			$payout_service_charge=$fetch['payout_service_charge'];
			$payout_charge_type=$fetch['payout_charge_type'];
			if ($payout_service_charge==0){$payout_service_charge='NOT ASSIGNED YET!';}

			$staff_id=$fetch['staff_id'];
		return '[{"payout_type_id":"'.$payout_type_id.'","bank_id":"'.$bank_id.'","bank_name":"'.$bank_name.'",
		"account_number":"'.$account_number.'","account_name":"'.$account_name.'","business_certificate":"'.$business_certificate.'",
		"business_reg_number":"'.$business_reg_number.'","activation_status_id":"'.$activation_status_id.'",
		"collection_service_charge":"'.$collection_service_charge.'","payout_service_charge":"'.$payout_service_charge.'",
		"collection_charge_type":"'.$collection_charge_type.'","payout_charge_type":"'.$payout_charge_type.'","staff_id":"'.$staff_id.'"}]';
	}

/////////////////////////////////////////
	function _get_payout_type_detail($conn, $payout_type_id){
		$query=mysqli_query($conn,"SELECT * FROM payout_type_tab WHERE payout_type_id='$payout_type_id'");
		$fetch=mysqli_fetch_array($query);
			$payout_type_name=$fetch['payout_type_name'];
		return '[{"payout_type_name":"'.$payout_type_name.'"}]';
	}
	
function _get_service_charge_type_detail($conn, $service_charge_type_id){
		$query=mysqli_query($conn,"SELECT * FROM service_charge_type_tab WHERE service_charge_type_id='$service_charge_type_id'");
		$fetch=mysqli_fetch_array($query);
			$service_charge_type_name=$fetch['service_charge_type_name'];
		return '[{"service_charge_type_name":"'.$service_charge_type_name.'"}]';
}

}//end of class
$callclass=new allClass();





?>






















