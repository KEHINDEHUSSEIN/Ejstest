<?php if ($view_content=='dashboard'){?>
    
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
				
				_countCollectionsPerDays('<?php echo $admin_token?>','<?php echo $db_day30?>','<?php echo $db_today?>','<?php echo $day30?>','<?php echo $today?>');
                 </script>
    
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





























<?php if ($view_content=='users'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<!--------------------------------network search select------------------------->
 <select id="status_id"  class="text_field select" onchange="_fetch_users_list()">
 <option value="" selected="selected">ALL USER STATUS</option>
       <?php 
   $status_query= mysqli_query($conn,"SELECT distinct(a.status_id),b.`status_name` FROM users_tab a, status_tab b where a.status_id=b.status_id AND a.user_type='ST'");
  while($status_sel=mysqli_fetch_array($status_query)){
  $status_id=$status_sel['status_id'];
  $status_name=$status_sel['status_name'];
   ?>
     <option value="<?php echo $status_id;?>"><?php echo $status_name;?></option>
      <?php }?>
</select>
<!--------------------------------all search select------------------------->
<input id="all_search_txt" onkeyup="_fetch_users_list()" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
</div>
         <div class="alert alert-success"> <span><i class="fa fa-users"></i></span> ADMINISTRATOR'S LIST <button class="btn" onClick="_get_form('create-user-form')"><i class="fa fa-plus"></i> CREATE A NEW ADMIN</button></div>
            <div class="animated fadeIn" id="search-content">
            <?php 
			$status_id='';
			$all_search_txt='';
			$check_code='user-list';
			require_once 'sub-codes.php';
			 ?>
            <br clear="all" />
            </div>
<?php }?>




<?php if ($view_content=='create-user-form'){?>

                <div class="fly-title-div  animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-lock"></i> CREATE A NEW ADMIN</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div sb-container animated fadeInRight" >
                              <div class="inner-div" id="get-form-content">
                                
                                <div class="alert">Fill the form below to <span>create a new administrator.</span></div>
                                
                                   <div class="title">FULLNAME</div>
                                       <input id="fullname" type="text" class="text_field" placeholder="PROJECT NAME" title="PROJECT NAME"/>
                                   <div class="title">PHONE NUMBER</div>
                                      <input id="phone" type="text" class="text_field" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                                   <div class="title">EMAIL ADDRESS</div>
                                      <input id="email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"/>
                                   <div class="title">SELECT ADMINISTRATIVE ROLE</div>
                                     <select id="role_id"  class="text_field selectinput">
                                     <option value="" selected="selected">SELECT HERE</option>
                                           <?php 
                                       $query= mysqli_query($conn,"SELECT * FROM role_tab");
                                      while($sel=mysqli_fetch_array($query)){
                                      $role_id=$sel['role_id'];
                                      $role_name=$sel['role_name'];
                                       ?>
                                         <option value="<?php echo $role_id;?>"><?php echo strtoupper($role_name);?></option>
                                          <?php }?>
                                    </select>
                                   <div class="title">SELECT USER STATUS</div>
                                     <select id="status_id"  class="text_field selectinput">
                                     <option value="" selected="selected">SELECT HERE</option>
                                           <?php 
                                       $query= mysqli_query($conn,"SELECT * FROM status_tab WHERE status_id IN ('A','S')");
                                      while($sel=mysqli_fetch_array($query)){
                                      $status_id=$sel['status_id'];
                                      $status_name=$sel['status_name'];
                                       ?>
                                         <option value="<?php echo $status_id;?>"><?php echo strtoupper($status_name);?></option>
                                          <?php }?>
                                    </select>
                                     <button class="action-btn" type="button" title="Submit" id="create-user-btn" onclick="_create_user();"> <i class="fa fa-check"></i>  SUBMIT </button>
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




























































<?php if ($view_content=='projects'){
	$status_id='A';
		$fetch=$callclass->_get_status_detail($conn, $status_id);
		$array = json_decode($fetch, true);
		$status_name= $array[0]['statusname'];
	?>


<div class="tab-div">
      <button class="tab-btn active-tab" id="active-project-btn" onclick="_get_project_list('active-project-btn','A')">ACTIVATED</button>
      <button class="tab-btn" id="pending-project-btn" onclick="_get_project_list('pending-project-btn','P')">PENDING</button>
      <button class="tab-btn" id="suspended-project-btn" onclick="_get_project_list('suspended-project-btn','S')">SUSPENDED</button>
</div>

    <div class="search-div" data-aos="fade-in" data-aos-duration="700">
    <input id="all_search_txt" onkeyup="_fetch_project_list()" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
    </div>
    
    <div class="project-list-back-div" id="search-content">
            <?php $all_search_txt='';?>
            <?php $check_code='project-list';?>
            <?php require_once 'sub-codes.php'?>
    </div>
<?php }?>





<?php if ($view_content=='get_project_settings_form'){
			$project_id=$ids;
			$count_query=mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1");				
			$count_acount=mysqli_num_rows($count_query);				
	?>

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
                              		<?php if ($count_acount>0){?>
                                    <button class="menu-btn" id="payout-setup-btn" onclick="_get_collection_setup('payout-setup','payout-setup-btn','<?php echo $project_id;?>')">PAYOUT</button>
                              		<button class="menu-btn" id="collection-settings-btn" onclick="_get_collection_setup('collection-settings','collection-settings-btn','<?php echo $project_id;?>')">COLLECTION</button>
                              		<button class="menu-btn" id="compliance-setup-btn" onclick="_get_collection_setup('compliance-setup','compliance-setup-btn','<?php echo $project_id;?>')">COMPLIANCE</button>
                              		<?php }?>
                              </div>
                                
                                <div  id="setup-div">
									<?php $check_code='project-setup';?>
                                    <?php require_once 'sub-codes.php'?>
                                </div>
                                
                        </div>
                </div>

<?php } ?>




























<?php if ($view_content=='collections'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<select class="text_field select" id="status_id" onchange="_fetch_custom_collections_report_status('<?php echo $admin_token;?>')">
	<option value="">ALL STATUS</option>
	<option value="Payer Debited"> SUCCESSFUL</option>
	<option value="Inprogress"> PENDING</option>
	<option value="TREF"> FAILED</option>
</select>
<select class="text_field select" id="search_by">
	<option value=""> SEARCH BY</option>
	<option value="CID"> CLIENT ID</option>
	<option value="TREF"> TRANSACTION REFERRENCE</option>
</select>
<input id="all_search_txt" onkeyup="_fetch_custom_collections_report_status('<?php echo $admin_token;?>')" type="text" class="text_field text" placeholder="Search By Transaction ID" title="Type here to search" />
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

<input type="hidden" id="search_start_date" value="<?php echo $db_day30;?>" />
<input type="hidden" id="search_end_date" value="<?php echo $db_today;?>" />
<input type="hidden" id="display_start_date" value="<?php echo $day30;?>" />
<input type="hidden" id="display_end_date" value="<?php echo $today;?>" />
					<script>_getCollectionSortTransactions('<?php echo $admin_token;?>','','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

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
<select class="text_field select" id="status_id" onchange="_fetch_custom_payout_report_status('<?php echo $admin_token;?>')">
	<option value="">ALL STATUS</option>
	<option value="Transfer Successful"> SUCCESSFUL</option>
	<option value="Inprogress"> PENDING</option>
	<option value="TREF"> FAILED</option>
</select>
<select class="text_field select" id="search_by">
	<option value=""> SEARCH BY</option>
	<option value="CID"> CLIENT ID</option>
	<option value="TREF"> TRANSACTION REFERRENCE</option>
</select>
<input id="all_search_txt" onkeyup="_fetch_custom_payout_report_status('<?php echo $admin_token;?>')" type="text" class="text_field text" placeholder="Search By Transaction ID" title="Type here to search" />
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
<input type="hidden" id="search_start_date" value="<?php echo $db_day30;?>" />
<input type="hidden" id="search_end_date" value="<?php echo $db_today;?>" />
<input type="hidden" id="display_start_date" value="<?php echo $day30;?>" />
<input type="hidden" id="display_end_date" value="<?php echo $today;?>" />
					<script>_getDisbursementSortTransactions('<?php echo $admin_token;?>','','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

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










<?php if ($view_content=='transfer'){?>
<div class="search-div" data-aos="fade-in" data-aos-duration="700">
<select class="text_field select" id="status_id" onchange="_fetch_custom_transfer_report_status('<?php echo $admin_token;?>')">
	<option value="">ALL STATUS</option>
	<option value="Transfer Successful"> SUCCESSFUL</option>
	<option value="Inprogress"> PENDING</option>
	<option value="TREF"> FAILED</option>
</select>
<select class="text_field select" id="trans_type">
	<option value="">ALL TRANSACTION TYPE</option>
	<option value="inter">INTER</option>
	<option value="intra">INTRA</option>
	<option value="interc">INTERC</option>
</select>
<select class="text_field select" id="search_by">
	<option value="">SEARCH BY</option>
	<option value="CID">CLIENT ID</option>
	<option value="TREF">TRANSACTION REFERRENCE</option>
</select>
<input id="all_search_txt" onkeyup="_fetch_custom_transfer_report_status('<?php echo $admin_token;?>')" type="text" class="text_field full" placeholder="Search By Transaction ID" title="Type here to search" />
</div>

            <div class="chart-div-notifications">
                    <div class="text"><i class="fa fa-line-chart"></i> Showing Matrix for</div> 
                    
                    <div class="text" onclick="select_search()">
                    <span id="srch-text">Last 7 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                    <div class="srch-select">
                    <div id="srch-today" onclick="get_transfer_report('srch-today', 'transfer_report', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="get_transfer_report('srch-week', 'transfer_report', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="get_transfer_report('srch-7', 'transfer_report', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="get_transfer_report('srch-month', 'transfer_report', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="get_transfer_report('srch-30', 'transfer_report', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="get_transfer_report('srch-90', 'transfer_report', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="get_transfer_report('srch-year', 'transfer_report', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="get_transfer_report('srch-1year', 'transfer_report', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    </div>
                    
                    <div class="text">
                    <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick=" _fetch_custom_transfer_report('payout_report','custom_search')">Apply</button>
                    </div>
                    </div>
                    <br clear="all" />
              </div>

<div class="ajax-loader" style="display:none; padding:0px;">Loading Transfer Transactions...<br><img src="all-images/images/ajax-loader.gif"/></div>
<div class="table-div">

<?php 
	  /// get presentation values
	  $day30= date('F d Y', strtotime('today - 7 days'));
	  $today= date('F d Y');	
	  
	  /// get chat values
		  $db_day30= date('Y-m-d', strtotime('today - 7 days'));
		  $db_today= date('Y-m-d');
		$view_report='';
		$check_code='transfer-list';
		include 'sub-codes.php';
?>
</div>
<input type="hidden" id="search_start_date" value="<?php echo $db_day30;?>" />
<input type="hidden" id="search_end_date" value="<?php echo $db_today;?>" />
<input type="hidden" id="display_start_date" value="<?php echo $day30;?>" />
<input type="hidden" id="display_end_date" value="<?php echo $today;?>" />
					<script>_getTransferSortTransactions('<?php echo $admin_token;?>','','','','<?php echo $db_day30;?>','<?php echo $db_today;?>');</script>

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




























<?php if ($view_content=='app_settings'){
	$status_id='A';
		$fetch=$callclass->_get_status_detail($conn, $status_id);
		$array = json_decode($fetch, true);
		$status_name= $array[0]['statusname'];
	?>


<div class="tab-div">
      <button class="tab-btn active-tab" id="active-project-btn" onclick="_get_project_list('active-project-btn','A')">ACTIVATED</button>
      <button class="tab-btn" id="pending-project-btn" onclick="_get_project_list('pending-project-btn','P')">PENDING</button>
</div>

    <div class="search-div" data-aos="fade-in" data-aos-duration="700">
    <input id="all_search_txt" onkeyup="_fetch_project_list()" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
    </div>
    
    <div class="project-list-back-div" id="search-content">
            <?php $all_search_txt='';?>
            <?php $check_code='project-list';?>
            <?php require_once 'sub-codes.php'?>
    </div>
<?php }?>



<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">$(".sb-container").scrollBox();</script>
    <script src="js/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>
