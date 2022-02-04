<?php if ($view_content=='dashboard'){?>


	<?php if ($project_status=='P'){?>
        <div class="get-started-div animated zoomIn animated animated">
            <div class="div-in">
                <div class="text"><?php echo ucwords(strtolower($project_name)); ?></div>
                 <div class="alert"> Kindly activate this project to get started.</div>
                    <button class="btn" title="Activate Project" onClick="_get_form('get_project_settings_form')">Activate Project</button>
            </div>
        </div>
    <?php }else{
            
        
            if ($projectcount>0){
            ?>
    
    
            <div class="chart-div-notifications">
                    <div class="text"><i class="fa fa-line-chart"></i> Showing Matrix for</div> 
                    
                    <div class="text" onclick="select_search()">
                    <span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                    <div class="srch-select">
                    <div id="srch-today" onclick="get_dashboard_report('srch-today', 'dashboard_report', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="get_dashboard_report('srch-week', 'dashboard_report', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="get_dashboard_report('srch-7', 'dashboard_report', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="get_dashboard_report('srch-month', 'dashboard_report', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="get_dashboard_report('srch-30', 'dashboard_report', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="get_dashboard_report('srch-90', 'dashboard_report', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="get_dashboard_report('srch-year', 'dashboard_report', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="get_dashboard_report('srch-1year', 'dashboard_report', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    </div>
                    
                    <div class="text">
                    <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick=" _fetch_custom_dashboard_report('dashboard_report','custom_search')">Apply</button>
                    </div>
                    </div>
                    <br clear="all" />
              </div>
              
                <div class="chart-div">
                    <div id="chart-report-div">
                        <div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>
                    </div>
                </div>
              
          
                <script language="javascript">
                $('#datepicker-from').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                
                $('#datepicker-to').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
				<?php
						/// get presentation values
						$day30= date('F d Y', strtotime('today - 30 days'));
						$today= date('F d Y');	
						
						/// get chat values
						$db_day30= date('Y-m-d', strtotime('today - 30 days'));
						$db_today= date('Y-m-d');
				?>
				
				_countCollectionsPerDays('<?php echo $access_token?>','<?php echo $db_day30?>','<?php echo $db_today?>','<?php echo $day30?>','<?php echo $today?>');
                 </script>
        <?php }else{?>
        
            <div class="get-started-div animated zoomIn animated animated">
                <div class="div-in">
                    <div class="text">
                        <div class="img"><img src="all-images/images/warning.gif" alt="warning" /></div>
                        No project found!
                    </div>
                     <div class="alert"> Kindly create a new project to get started.</div>
                        <button class="btn" title="Create A New Project" onClick="_get_form('create-project-form')">Create A New Project</button>
                </div>
            </div>
        <?php }?>
    <?php }?>
    
<?php }?>











<?php if ($view_content=='system_alert'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<input id="all_search_txt" onkeyup="_fetch_random_alert_search('system_alert')" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
</div>


<div class="chart-div-notifications">
<div class="text"><i class="fa fa-line-chart"></i> Showing Notifications for</div> 

<div class="text" onclick="select_search()">
<span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
<div class="srch-select">
<div id="srch-unreal" onclick="get_alert_report('srch-unreal', 'system_alert', 'unread');">Unread Alerts</div>
<div id="srch-today" onclick="get_alert_report('srch-today', 'system_alert', 'view_today_search');">Today</div>
<div id="srch-week" onclick="get_alert_report('srch-week', 'system_alert', 'view_thisweek_search');">This Week</div>
<div id="srch-7" onclick="get_alert_report('srch-7', 'system_alert', 'view_7days_search');">Last 7 Days</div>
<div id="srch-month" onclick="get_alert_report('srch-month', 'system_alert', 'view_thismonth_search');">This Month</div>
<div id="srch-30" onclick="get_alert_report('srch-30', 'system_alert', 'view_30days_search');">Last 30 Days</div>
<div id="srch-90" onclick="get_alert_report('srch-90', 'system_alert', 'view_90days_search');">Last 90 Days</div>
<div id="srch-year" onclick="get_alert_report('srch-year', 'system_alert', 'view_thisyear_search');">This Year</div>
<div id="srch-1year" onclick="get_alert_report('srch-1year', 'system_alert', 'view_1year_search');">Last 1 Year</div>
<div onclick="srch_custom('Custom Search')">Custom Search</div>
</div>
</div>

<div class="text">
<div class="custom-srch-div">
<input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
<input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
<button type="button" class="btn" onclick=" _fetch_custom_alert_report('system_alert','custom_search')">Apply</button>
</div>
</div>
<br clear="all" />
</div>

<div class="system-alert-div">
<?php 
			/// get presentation values
	$day30= date('F d Y', strtotime('today - 30 days'));
	$today= date('F d Y');	
	
	/// get chat values
		$db_day30= date('Y-m-d', strtotime('today - 30 days'));
		$db_today= date('Y-m-d');
		$view_report='';
		$check_code='alert-list';
		include 'sub-codes.php';
?>
</div>


<script language="javascript">
$('#datepicker-from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-M-d',
});

$('#datepicker-to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-M-d',
});
 </script>
<?php }?>




<?php if ($view_content=='read_alert'){?>
<div class="fly-title-div  animated fadeInRight">
<div class="in">
<span id="panel-title"><i class="fa fa-bell-o"></i> Notification Details</span>
<div class="close" title="Close" onclick="alert_close();">X</div>
</div>
</div>
<div class="container-back-div sb-container animated fadeInRight" >
<div class="inner-div">
                
			<?php
				$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE alert_id='$alert_id'");
				$fetch=mysqli_fetch_array($query);
				$alert_detail = $fetch['alert_detail'];
 			$fatch_array=$callclass->_get_alert_detail($conn, $alert_id);
 			  $array = json_decode($fatch_array, true);
				$userid= $array[0]['user_id'];
				$name= trim(ucwords(strtolower($array[0]['name'])));
				$ipaddress= $array[0]['ipaddress'];
				$computer= $array[0]['computer'];
				$seen_status= $array[0]['seen_status'];
				$date= $array[0]['date'];
					 mysqli_query($conn,"UPDATE `alert_tab` SET seen_status=1 WHERE alert_id='$alert_id'");
				?>
                
	             <div class="alert">
                User ID: <span><?php echo $userid;?></span><br />
                Action Performed By: <span><?php echo $name;?></span><br />
                IP Address Used: <span><?php echo $ipaddress;?></span><br />
                Computer Used: <span><?php echo $computer;?></span><br />
                </div>
                
                <div class="alert">
                Alert ID: <span><?php echo $alert_id;?></span><br />
                Date: <span><?php echo $date;?></span><br />
                </div>
                
                   <div class="title">Alert Details:</div>
                <div class="alert alert-success"><?php echo $alert_detail;?></div>
     
                     <button class="action-btn" onclick="alert_close();"> <i class="fa fa-check"></i> OK </button>
     </div>
</div>

<?php } ?>
















<?php if ($view_content=='user-profile'){?>
            <?php include 'users-profile.php'?>
<?php } ?>

<?php if ($view_content=='change-user-password-form'){?>

                <div class="fly-title-div  animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-lock"></i> CHANGE PASSWORD</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div sb-container animated fadeInRight" >
                              <div class="inner-div">
                                
                                <div class="alert">Enter the <span>OLD PASSWORD</span> and create your <span>NEW PASSWORD</span></div>
                                
                                   <div class="title">OLD PASSWORD</div>
                                       <input id="oldpass" type="password" class="text_field" placeholder="ENTER OLD PASSWORD" title="OLD PASSWORD"/>
                                   <div class="title">NEW PASSWORD</div>
                                      <input id="newpass" type="password" class="text_field" placeholder="CREATE NEW PASSWORD" title="NEW PASSWORD"/>
                                   <div class="title">CONFIRM NEW PASSWORD</div>
                                      <input id="cnewpass" type="password" class="text_field" placeholder="CONFIRM NEW PASSWORD" title="CONFIRM NEW PASSWORD"/>
                                     <button class="action-btn" type="button" title="Submit" id="update-user-password-btn" onclick="_update_user_password();"> <i class="fa fa-refresh"></i> CHANGE PASSWORD </button>
                        </div>
                </div>
<?php } ?>













<?php if ($view_content=='create-project-form'){?>

                <div class="fly-title-div  animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-lock"></i> CREATE A PROJECT</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div sb-container animated fadeInRight" >
                              <div class="inner-div" id="get-form-content">
                                
                                <div class="alert">Fill the form below to create a new project <span>create a new project.</span></div>
                                
                                   <div class="title">PROJECT NAME</div>
                                       <input id="project_name" type="text" class="text_field" placeholder="PROJECT NAME" title="PROJECT NAME"/>
                                   <div class="title">PHONE NUMBER</div>
                                      <input id="project_phone" type="text" class="text_field" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                                   <div class="title">PROJECT EMAIL ADDRESS</div>
                                      <input id="project_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"/>
                                   <div class="title">SELECT COUNTRY</div>
                                     <select id="country"  class="text_field select">
                                     <option value="" selected="selected">SELECT COUNTRY</option>
                                           <?php 
                                       $query= mysqli_query($conn,"SELECT * FROM country_tab");
                                      while($sel=mysqli_fetch_array($query)){
                                      $country_code=$sel['country_code'];
                                      $country_name=$sel['country_name'];
                                       ?>
                                         <option value="<?php echo $country_code;?>|<?php echo $country_name;?>"><?php echo strtoupper($country_name);?></option>
                                          <?php }?>
                                    </select>
                                     <button class="action-btn" type="button" title="Submit" id="create-project-btn" onclick="_create_project();"> <i class="fa fa-check"></i>  CREATE PROJECT </button>
                        </div>
                </div>

<script src="js/superplaceholder.js"></script> 
<script>
		superplaceholder({
			el: project_email,
				sentences: [ 'Enter Email Address', 'e.g info@afootechglobal.com', 'support@tecnoverng.prg', 'helo@mtnnigeria.com'],
				options: {
				letterDelay: 80,
				loop: true,
				startOnFocus: false
			}
		});
</script>

<?php } ?>








<?php if ($view_content=='get_otp_sent_to_email_to_verify'){?>

            <div class="alert alert-success"><span><?php echo $project_name;?></span><br /> An OTP has been sent to your email (<span><?php echo $project_email; ?></span>). Kindly enter the OTP to <span>VERIFY THE PROJECT EMAIL.</span></div>
            
               <div class="title">ENTER OTP:</div>
                   <input id="project_otp" type="text" class="text_field" placeholder="ENTER OTP" title="ENTER OTP"/>
            <div class="alert"><span>OTP</span> not received? <span id="resend" onclick="_resend_otp('resend','<?php echo $project_email; ?>')"><i class="fa fa-send"></i> RESEND OTP</span></div>
                 <button class="action-btn" type="button" title="Submit" id="verify-otp-btn" onclick="_verify_otp('<?php echo $project_id; ?>','<?php echo $project_email; ?>','<?php echo $project_password; ?>','<?php echo $project_name; ?>');"> <i class="fa fa-check"></i>  VERIFY </button>
<?php } ?>



























<?php if ($view_content=='projects'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<input id="all_search_txt" onkeyup="_fetch_project_list()" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
</div>

<div class="project-list-back-div" id="search-content">
		<?php $all_search_txt='';?>
		<?php $check_code='project-list';?>
        <?php require_once 'sub-codes.php'?>
</div>
<?php }?>







<?php if ($view_content=='get_project_settings_form'){?>

                <div class="fly-title-div animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-th-large"></i> PROJECT SETTINGS</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div overflow animated fadeInRight" >
                              <div class="inner-div" id="get-form-content">
                              <div class="menu-div">
                              		<button class="menu-btn active-menu" id="project-setup-btn" onclick="_get_collection_setup('project-setup','project-setup-btn','<?php echo $project_id;?>')">PROJECT</button>
                              		<button class="menu-btn" id="payout-setup-btn" onclick="_get_collection_setup('payout-setup','payout-setup-btn','<?php echo $project_id;?>')">PAYOUT</button>
                              		<button class="menu-btn" id="collection-settings-btn" onclick="_get_collection_setup('collection-settings','collection-settings-btn','<?php echo $project_id;?>')">COLLECTION</button>
                              		<button class="menu-btn" id="compliance-setup-btn" onclick="_get_collection_setup('compliance-setup','compliance-setup-btn','<?php echo $project_id;?>')">COMPLIANCE</button>
                              </div>
                                
                                <div  id="setup-div">
									<?php $check_code='project-setup';?>
                                    <?php require_once 'sub-codes.php'?>
                                </div>
                                
                        </div>
                </div>

<?php } ?>



<?php if ($view_content=='get_service_charge_form'){?>

                <div class="fly-title-div animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-th-large"></i> PROJECT SETTINGS</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div overflow animated fadeInRight" >
                              <div class="inner-div" id="get-form-content">
                              <div class="menu-div">
                              		<button class="menu-btn" id="project-setup-btn" onclick="_get_collection_setup('project-setup','project-setup-btn','<?php echo $project_id;?>')">PROJECT</button>
                              		<button class="menu-btn" id="payout-setup-btn" onclick="_get_collection_setup('payout-setup','payout-setup-btn','<?php echo $project_id;?>')">PAYOUT</button>
                              		<button class="menu-btn active-menu" id="collection-settings-btn" onclick="_get_collection_setup('collection-settings','collection-settings-btn','<?php echo $project_id;?>')">COLLECTION</button>
                              		<button class="menu-btn" id="compliance-setup-btn" onclick="_get_collection_setup('compliance-setup','compliance-setup-btn','<?php echo $project_id;?>')">COMPLIANCE</button>
                              </div>
                                
                                <div id="setup-div">
									<?php $check_code='collection-settings';?>
                                    <?php require_once 'sub-codes.php'?>
                                   
                                </div>
                                
                        </div>
                </div>
<?php } ?>










<?php if ($view_content=='request_for_payout_form'){?>
			<?php
					$fetch_acount=$callclass->_get_project_account_detail($conn, $project_id);
					  $array = json_decode($fetch_acount, true);
						$payout_type_id= $array[0]['payout_type_id'];
						$bank_id= $array[0]['bank_id'];
					  	$bank_name= $array[0]['bank_name'];
						$account_number= $array[0]['account_number'];
						$account_name= $array[0]['account_name'];
						$business_certificate= $array[0]['business_certificate'];
					  	$business_reg_number= $array[0]['business_reg_number'];
					  	$activation_status_id= $array[0]['activation_status_id'];
						$collection_service_charge= $array[0]['collection_service_charge'];
						$payout_service_charge=$array[0]['payout_service_charge'];
						$payout_charge_type=$array[0]['payout_charge_type'];
						$staff_id= $array[0]['staff_id'];

                                 $ct_array=$callclass->_get_service_charge_type_detail($conn, $payout_charge_type);
                                  $array = json_decode($ct_array, true);
                                    $service_charge_type_name=$array[0]['service_charge_type_name'];

					$fetch_payout_type=$callclass->_get_payout_type_detail($conn, $payout_type_id);
					  $array = json_decode($fetch_payout_type, true);
						$payout_type_name= $array[0]['payout_type_name'];
			?>

                <div class="fly-title-div  animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-money"></i> REQUEST FOR PAYOUT</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div sb-container animated fadeInRight" >
                              <div class="inner-div" id="get-form-content">                                
                                <div class="detail-list">PROJECT NAME:
                                	<div class="detail-status"><?php echo ucwords(strtolower($project_name)); ?></div><br clear="all" />
                                </div>
                                <div class="detail-list">COUNTRY:
                                	<div class="detail-status"><?php echo ucwords(strtolower($country_name)); ?></div><br clear="all" />
                                </div>
                                
                                <div class="detail-list">AVAILABLE BALANCE: 
                                	<div class="detail-status"><span id="project_currency_form">--</span><b id="myWallet_form">--</b></div>
                                </div>
                                <div class="detail-list"><?php echo $payout_type_name; ?>: 
                                	<div class="detail-status"><?php echo ucwords(strtolower($bank_name)); ?></div>
                                </div>
                                <div class="detail-list"><?php echo $payout_type_name; ?> NUMBER: 
                                	<div class="detail-status"><?php echo $account_number; ?></div>
                                </div>
                                <div class="alert alert-success">
                                     <div class="title">PAY OUT AMOUNT</div>
                                    <input id="pay_out_amount" type="number" class="text_field" placeholder="AMOUNT"/>
                                     <div class="title">NARATION</div>
                                     <textarea class="text_field" id="payment_naration" rows="2" placeholder="NARATION"></textarea>
                                </div>
                                <div class="detail-list">SERVICE CHARGE: 
                                	<div class="detail-status"><?php echo $payout_service_charge; ?><?php echo $service_charge_type_name; ?></div>
                                </div>
                                   <button class="action-btn" type="button" title="Submit" id="request-payout-btn" onclick="_request_for_payout('<?php echo $country_alias; ?>','<?php echo $bank_id; ?>','<?php echo $account_number; ?>','<?php echo $payout_type_id; ?>','<?php echo $access_token; ?>','settlement');"> <i class="fa fa-check"></i>  REQUEST FOR PAYOUT </button>
                                    <input id="api-demo-pry" type="hidden"/>
                                    <input id="api-demo-sec" type="hidden"/>
                        </div>
                </div>
					<script>_get_wallet_balance('<?php echo $access_token;?>');</script>
					<script>_get_collection_data('<?php echo $access_token;?>');</script>
					<script>_get_api_key_disbusment('<?php echo $access_token;?>','demokey');</script>
<?php } ?>































<?php if ($view_content=='collections'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<input id="all_search_txt" onkeyup="getCollectionTransactionByReferrence('<?php echo $access_token;?>')" type="text" class="text_field full" placeholder="Search By Transaction ID" title="Type here to search" />
</div>

            <div class="chart-div-notifications">
                    <div class="text"><i class="fa fa-line-chart"></i> Showing Matrix for</div> 
                    
                    <div class="text" onclick="select_search()">
                    <span id="srch-text">Last 7 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                    <div class="srch-select">
                    <div id="srch-today" onclick="get_collections_report('srch-today', 'collections_report', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="get_collections_report('srch-week', 'collections_report', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="get_collections_report('srch-7', 'collections_report', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="get_collections_report('srch-month', 'collections_report', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="get_collections_report('srch-30', 'collections_report', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="get_collections_report('srch-90', 'collections_report', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="get_collections_report('srch-year', 'collections_report', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="get_collections_report('srch-1year', 'collections_report', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    </div>
                    
                    <div class="text">
                    <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick=" _fetch_custom_collections_report('collections_report','custom_search')">Apply</button>
                    </div>
                    </div>
                    <br clear="all" />
              </div>

<div class="ajax-loader" style="display:none; padding:0px;">Loading Collections...<br><img src="all-images/images/ajax-loader.gif"/></div>
<div class="table-div">

<?php 
	  /// get presentation values
	  $day30= date('F d Y', strtotime('today - 7 days'));
	  $today= date('F d Y');	
	  
	  /// get chat values
		  $db_day30= date('Y-m-d', strtotime('today - 7 days'));
		  $db_today= date('Y-m-d');
		$view_report='';
		$check_code='collections-list';
		include 'sub-codes.php';
?>
</div>
					<script>_getCollectionSortTransactions('<?php echo $access_token;?>','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

                <script language="javascript">
                $('#datepicker-from').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                
                $('#datepicker-to').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                 </script>


<?php }?>






































<?php if ($view_content=='payout'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<input id="all_search_txt" onkeyup="getDisbursementTransactionByReferrence('<?php echo $access_token;?>')" type="text" class="text_field full" placeholder="Search By Transaction ID" title="Type here to search" />
</div>

            <div class="chart-div-notifications">
                    <div class="text"><i class="fa fa-line-chart"></i> Showing Matrix for</div> 
                    
                    <div class="text" onclick="select_search()">
                    <span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                    <div class="srch-select">
                    <div id="srch-today" onclick="get_payout_report('srch-today', 'payout_report', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="get_payout_report('srch-week', 'payout_report', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="get_payout_report('srch-7', 'payout_report', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="get_payout_report('srch-month', 'payout_report', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="get_payout_report('srch-30', 'payout_report', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="get_payout_report('srch-90', 'payout_report', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="get_payout_report('srch-year', 'payout_report', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="get_payout_report('srch-1year', 'payout_report', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    </div>
                    
                    <div class="text">
                    <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick=" _fetch_custom_payout_report('payout_report','custom_search')">Apply</button>
                    </div>
                    </div>
                    <br clear="all" />
              </div>

<div class="ajax-loader" style="display:none; padding:0px;">Loading PayOut...<br><img src="all-images/images/ajax-loader.gif"/></div>
<div class="table-div">

<?php 
			/// get presentation values
	$day30= date('F d Y', strtotime('today - 30 days'));
	$today= date('F d Y');	
	
	/// get chat values
		$db_day30= date('Y-m-d', strtotime('today - 30 days'));
		$db_today= date('Y-m-d');
		$view_report='';
		$check_code='payout-list';
		include 'sub-codes.php';
?>
</div>
					<script>_getDisbursementSortTransactions('<?php echo $access_token;?>','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

                <script language="javascript">
                $('#datepicker-from').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                
                $('#datepicker-to').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                 </script>
<?php }?>









<?php /* START  PART EZECHIEL DOE*/ ?>



<?php if ($view_content=='paymentlink'){?>
<?php if(true) {?>
    <div class="get-started-div animated zoomIn animated animated">
                <div class="div-in">
                    <div class="text">
                         Payment Links
                    </div>
                     <div class="alert"> Accept payments easily by creating a link,
Share the link with your customers to accept payments seamlessly</div>
                        <button class="btn" title="Create A New Project" onClick="_get_form('create-paymentlink-form')">New Link</button>
                </div>
            </div>

<?php }else{  ?>


    <div class="search-div" data-aos="fade-in" data-aos-duration="700">
<input id="all_search_txt" onkeyup="getDisbursementTransactionByReferrence('<?php echo $access_token;?>')" type="text" class="text_field full" placeholder="Search By Transaction ID" title="Type here to search" />
</div>

            <div class="chart-div-notifications">
                    <div class="text"><i class="fa fa-line-chart"></i> Showing Matrix for</div> 
                    
                    <div class="text" onclick="select_search()">
                    <span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                    <div class="srch-select">
                    <div id="srch-today" onclick="get_payout_report('srch-today', 'payout_report', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="get_payout_report('srch-week', 'payout_report', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="get_payout_report('srch-7', 'payout_report', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="get_payout_report('srch-month', 'payout_report', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="get_payout_report('srch-30', 'payout_report', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="get_payout_report('srch-90', 'payout_report', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="get_payout_report('srch-year', 'payout_report', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="get_payout_report('srch-1year', 'payout_report', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    </div>
                    
                    <div class="text">
                    <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick=" _fetch_custom_payout_report('payout_report','custom_search')">Apply</button>
                    </div>
                    </div>
                    <br clear="all" />
              </div>

<div class="ajax-loader" style="display:none; padding:0px;">Loading PayOut...<br><img src="all-images/images/ajax-loader.gif"/></div>
<div class="table-div">

<?php 
			/// get presentation values
	$day30= date('F d Y', strtotime('today - 30 days'));
	$today= date('F d Y');	
	
	/// get chat values
		$db_day30= date('Y-m-d', strtotime('today - 30 days'));
		$db_today= date('Y-m-d');
		$view_report='';
		$check_code='payout-list';
		include 'sub-codes.php';
?>
</div>
					<script>_getDisbursementSortTransactions('<?php echo $access_token;?>','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

                <script language="javascript">
                $('#datepicker-from').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                
                $('#datepicker-to').datetimepicker({
                    lang:'en',
                    timepicker:false,
                    format:'Y-m-d',
                    formatDate:'Y-M-d',
                });
                 </script>
<?php } }?>




<?php if ($view_content=='create-paymentlink-form'){?>

<div class="fly-title-div  animated fadeInRight">
<div class="in">
<span id="panel-title"><i class="fa fa-lock"></i> NEW PAYMENT LINK</span>
<div class="close" title="Close" onclick="alert_close();">X</div>
</div>
</div>
<div class="container-back-div sb-container animated fadeInRight" >
              <div class="inner-div" id="get-form-content">
                
 
                
                   <div class="title">PAYMENT LINK NAME </div>
                       <input id="paymentlink_name" type="text" class="text_field" placeholder="PAYMENT LINK NAME" title="PAYMENT LINK NAME"/>
                   <div class="title">DESCRIPTION</div>
                      
                      <textarea id="paymentlink_description" class="text_field" name="paymentlink_description" rows="4" cols="50"> </textarea>
                   <!-- <div class="title">PAYMENT LINK IMAGE</div>
                   <div style="background:url(all-images/images/cv.jpg) center top; background-size:cover;">
                    <iframe src="" style="border:none; margin:0px; width:100%; height:300px;" id="note-preview"> </iframe>
                    </div>
                   <label>
                    <input type="file" name="paymentlink_image" class="text_field" id="up_note" style="display:none;" accept=".pdf"> 
                    <div class="upload-btn" id="upload-note-btn"> <i class="fa fa-upload"></i> Click Here to Upload </div>
                    </label> !-->
                   <div class="title"></div>
                   <div>
                    <input type="radio" id="paymentlink_type_fixed"   name="paymentlink_type" value="fixed"
                            checked>
                    <label for="fixed">Specify a fixed amount</label>
                    </div>

                    <div>
                    <input type="radio" id="paymentlink_type_noFixed" name="paymentlink_type" value="noFixed">
                    <label for="noFixed">Capture customer’s phone number</label>
                    </div>
 

                    <div class="title">USE YOUR CUSTOM LINK</div>
                       <input id="paymentlink_custom" name="paymentlink_custom" type="text" class="text_field" placeholder="https://dilaac.com/link/" title="USE YOUR CUSTOM LINK"/>
                    
                       <div class="title">POST-PAYMENT LINK REDIRECT</div>
                       <input id="paymentlink_post"  name="paymentlink_post"  type="text" class="text_field" placeholder="https://redirect link" title="POST-PAYMENT LINK REDIRECT"/>
                    
                     <div class="title">SUCCESS CONFIRMATION MESSAGE</div>
                       <input id="paymentlink_succesMessage" name="paymentlink_succesMessage" type="text" class="text_field" placeholder="To be displayed after payment" title="SUCCESS CONFIRMATION MESSAGE"/>
                    
                    <div class="title">SEND NOTIFICATIONS TO</div>
                       <input id="paymentlink_notification" nameid="paymentlink_notification" type="email" class="text_field" placeholder="Email address provided will get notifications." title="SEND NOTIFICATIONS TO"/>
                    <div class="title">ADDITIONAL INFORMATION REQUIRED?</div>
                       <input id="paymentlink_addinformation" name="paymentlink_addinformation" type="text" class="text_field" placeholder="ADDITIONAL INFORMATION REQUIRED?" title="ADDITIONAL INFORMATION REQUIRED?"/>
                    <button class="action-btn" type="button" title="reset" id="reset-paymentlink-btn" > <i class="fa fa-arrows-alt"></i>  CANCEL </button>
                     <button class="action-btn" style="float:right" type="button" title="Submit" id="create-paymentlink-btn" onclick="_create_paymentlink();"> <i class="fa fa-check"></i>  CREATE </button> 
                     
        </div>
</div>

<script src="js/superplaceholder.js"></script> 
<script>
superplaceholder({
el: project_email,
sentences: [ 'Enter Email Address', 'e.g info@afootechglobal.com', 'support@tecnoverng.prg', 'helo@mtnnigeria.com'],
options: {
letterDelay: 80,
loop: true,
startOnFocus: false
}
});
</script>

<?php } ?>


<?php /* END PART EZECHIEL DOE*/  ?>












<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">$(".sb-container").scrollBox();</script>
    <script src="js/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>
