<?php if ($check_code=='trendbarchart'){?>

<div class="chart">
<div class="rev-report">Matrix Between <?php echo $day30; ?> - <?php echo $today; ?><br /><div class="revenue">TA <?php echo number_format($grandAmount,2);?> | SC <?php echo number_format($totalCharges,2);?></div></div>

<div id="chartContainer" style="height: 300px; max-width: 920px; margin: 0px auto;"></div>
<script>
$(document).ready(function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light3",
	title:{
		text: ""
	},
	axisX:{
		valueFormatString: "DD MMM",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: "",
		includeZero: true,
		crosshair: {
			enabled: true
		}
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},
	data: [{
		type: "line",
		showInLegend: true,
		name: "Total Amount",
		markerType: "square",
		xValueFormatString: "DD MMM, YYYY",
		color: "#BC5202",
		dataPoints: [
		<?php echo $AmountTrend ?>
			//{ x: new Date(2017, 0, 3), y: 650 },
			//{ x: new Date(2017, 0, 4), y: 700 },
		]
	},
	{
		type: "line",
		showInLegend: true,
		name: "Service Charge",
		lineDashType: "dash",
		color: "#444",
		dataPoints: [
		<?php echo $ChargesTrend ?>
			//{ x: new Date(2017, 0, 3), y: 510 },
			//{ x: new Date(2017, 0, 4), y: 560 },
		]
	},
		{
		type: "line",
		showInLegend: true,
		name: "Transactions Count",
		lineDashType: "dash",
		color: "#0080C0",
		dataPoints: [
		<?php echo $CountTrend ?>
			//{ x: new Date(2017, 0, 3), y: 5 },
			//{ x: new Date(2017, 0, 4), y: 6 },
	]
	}]

});
chart.render();

function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
})

		_call_countCollections('<?php echo $admin_token?>');
		_call_countDisbursements('<?php echo $admin_token?>');
		
</script>
</div>
<?php }?>




























<?php if ($check_code=='collection_matrix'){?>
            <div id="chartContainer1" style="width:100%; height:200px; margin:auto;"></div>
            
            <script type="text/javascript">
            var options = {
            title: {
            text: "" /*My Performance*/
            },
            data: [{
            type: "pie",
            startAngle: 45,
            showInLegend: "False",
            legendText: "{label}",
            indexLabel: "{label} ({y})",
            yValueFormatString:"#,##0.#"%"",
            dataPoints: [
            { label: "Success", y: <?php echo $success; ?>},
            { label: "Failed", y: <?php echo $pending; ?>},
            { label: "Pending", y: <?php echo $failed; ?>},
            ]
            }]
            };
            $("#chartContainer1").CanvasJSChart(options);
            </script>

<?php }?>


<?php if ($check_code=='payout_matrix'){?>
            <div id="chartContainer2" style="width:100%; height:200px; margin:auto;"></div>
            
            <script type="text/javascript">
            var options = {
            title: {
            text: "" /*My Performance*/
            },
            data: [{
            type: "pie",
            startAngle: 45,
            showInLegend: "False",
            legendText: "{label}",
            indexLabel: "{label} ({y})",
            yValueFormatString:"#,##0.#"%"",
            dataPoints: [
            { label: "Success", y: <?php echo $success; ?>},
            { label: "Failed", y: <?php echo $pending; ?>},
            { label: "Pending", y: <?php echo $failed; ?>},
            ]
            }]
            };
            $("#chartContainer2").CanvasJSChart(options);
            </script>

<?php }?>































<?php if ($check_code=='alert-list'){ ?>                               
               <?php if ($view_report=='unread'){?>
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-bell-o"></i></span> Unread Alerts</div>
				<?php }elseif ($view_report=='random_search'){ ?>
                <div class="alert alert-success" style="text-align:left;"><span><i class="fa fa-search"></i></span> Search Result For <span><?php echo $all_search_txt; ?></span></div>
				<?php }else{ ?>
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-bell-o"></i></span> Notifications Between <span><?php echo $day30; ?></span> - <span><?php echo $today; ?></span></div>
				<?php } ?>




      <?php 
                        $search_like="(alert_id like '%$all_search_txt%' OR
										alert_detail like '%$all_search_txt%' OR
										user_id like '%$all_search_txt%' OR
										name like '%$all_search_txt%' OR
										ipaddress like '%$all_search_txt%' OR
										computer like '%$all_search_txt%' OR
										date like '%$all_search_txt%')";
				 $no=0;
				
							if ($view_report==''){
							$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE date(date) BETWEEN '$db_day30' AND '$db_today'  AND user_id='$user_id'  ORDER BY date DESC LIMIT 200");
							}elseif ($view_report=='unread'){
							$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE seen_status IN (1,3)  AND user_id='$user_id' ORDER BY date DESC");
							}elseif ($view_report=='random_search'){
							$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE $search_like  AND user_id='$user_id' ORDER BY date DESC LIMIT 100");
							}else{
							$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE date(date) BETWEEN '$db_day30' AND '$db_today'  AND user_id='$user_id' ORDER BY date DESC");
							}
				
				while($fetch=mysqli_fetch_array($query)){
				 $no++;
				$alert_id=$fetch['alert_id'];	
				$alert_detail = substr($fetch['alert_detail'], 0, 80);
 			$fatch_array=$callclass->_get_alert_detail($conn, $alert_id);
 			  $array = json_decode($fatch_array, true);
				$user_id= $array[0]['user_id'];
				$name= trim(ucwords(strtolower($array[0]['name'])));
				$ipaddress= $array[0]['ipaddress'];
				$computer= $array[0]['computer'];
				$seen_status= $array[0]['seen_status'];
				$date= $array[0]['date'];
			    ?>
                
					
                <?php if ($seen_status==0){?>
                    <div class="system-alert" id="<?php echo $alert_id; ?>" onclick="_read_alert('<?php echo $alert_id; ?>')">
                    <div class="alert-name"><i class="fa fa-user-circle"></i> <?php echo $name; ?> <span id="<?php echo $alert_id; ?>viewed"><i class="fa fa-check"></i></span></div>
                    <div class="alert-text"><?php echo $alert_detail; ?>...</div>
                    <div class="alert-time"><i class="fa fa-clock-o"></i> <?php echo $date; ?></div>
                    </div>
                    <?php }else{ ?>
                    <div class="system-alert alert-seen" id="<?php echo $alert_id; ?>" onclick="_read_alert('<?php echo $alert_id; ?>')">
                    <div class="alert-name"><i class="fa fa-user-circle"></i> <?php echo $name; ?> <span id="<?php echo $alert_id; ?>viewed"><i class="fa fa-check"></i><i class="fa fa-check"></i></span></div>
                    <div class="alert-text"><?php echo $alert_detail; ?>...</div>
                    <div class="alert-time"><i class="fa fa-clock-o"></i> <?php echo $date; ?></div>
                    </div>
                    <?php } ?>

			<?php } ?>
            
            <?php if ($no==0){?>
                <div class="alert"><i class="fa fa-bell-o"></i> No record found</div>
            <?php } ?>
<?php }?>



























<?php if ($check_code=='user-list'){ ?> 
<div class="search-content-in">			
<?php
                        $search_like="(user_id like '%$all_search_txt%' OR 
                        fullname like '%$all_search_txt%' OR 
                        mobile like '%$all_search_txt%' OR 
                        email like '%$all_search_txt%' OR 
                        reg_date like '%$all_search_txt%' OR 
                        last_login like '%$all_search_txt%')";
                    				 
            $usersquery=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_type = 'ST' AND role_id!=3 AND status_id LIKE '%$status_id%' AND $search_like  ORDER BY fullname ASC")or die ('cannot select users_tab');
			 $no=0;
            while($users_sel=mysqli_fetch_array($usersquery)){
            $no++;
                $users_id=$users_sel['user_id'];
				 $user_array=$callclass->_get_user_detail($conn, $users_id);
							  $u_array = json_decode($user_array, true);
								$users_id= $u_array[0]['user_id'];
								$fullname= $u_array[0]['fullname'];
								$mobile= $u_array[0]['mobile'];
								$email= $u_array[0]['email'];
								$passport= $u_array[0]['passport'];
								$role_id= $u_array[0]['role_id'];
								$otp= $u_array[0]['otp'];
								$status_id= $u_array[0]['status_id'];
								$reg_date= $u_array[0]['reg_date'];
								$last_login= $u_array[0]['last_login'];
								
								if ($status_id=='A'){
								$status_name= 'ACTIVATED';
								}else if($status_id=='S'){
								$status_name= 'SUSPENDED';
								}else{
								$status_name= 'PENDING';
								}
            ?>
            
            <div class="user-div" onclick="_get_users_profile('<?php echo $users_id; ?>','myprofile');">
            <div class="pix-div"><img src="uploaded_files/staff_passport/<?php echo $passport; ?>"/></div>
            <div class="detail">
          	<div class="name-div"><div class="name"> <?php echo ucwords(strtolower($fullname)); ?></div><hr /><br/></div>
            <div class="text">ID: <?php echo $user_id; ?></div>
            <div class="text"><?php echo $mobile; ?></div>
            <?php if ($status_id=='A'){?>
            <div class="active"><?php echo $status_name; ?></div>
            <?php }elseif ($status_id=='S'){ ?>
            <div class="inactive"><?php echo $status_name; ?></div>
            <?php }else{ ?>
            <div class="pending"><?php echo $status_name; ?></div>
            <?php } ?>
            </div>
            <br clear="all" />
            </div>
            <?php } ?>
            <br clear="all" />
            <?php if ($no==0){?>
            <div style="padding:50px; font-size:16px; color:#999; text-align:center;"><i class="fa fa-warning (alias)"></i> No Record Found</div>
            <?php } ?>
            
 </div>         

<?php }?>
















<?php if ($check_code=='project-list'){?> 
		<?php if ($all_search_txt==''){?>                               
         <div class="alert alert-success"> <span><i class="fa fa-th-large"></i></span> <?php echo $status_name;?> PROJECT LIST</div>
        <?php }else{ ?> 
         <div class="alert alert-success"> <span><i class="fa fa-th-large"></i></span> SEARCH RESULT FOR  <span><?php echo $all_search_txt?></span></div>
        <?php }?>                               
                            
    <?php
	                        $search_like="(project_id like '%$all_search_txt%' OR
										project_email like '%$all_search_txt%' OR
										project_phone like '%$all_search_txt%' OR
										project_name like '%$all_search_txt%')";

			$project_query=mysqli_query($conn,"SELECT project_id FROM projects_tab WHERE status_id LIKE '%$status_id%' AND  $search_like ORDER BY project_name ASC");
	$no=0;
		while ($projec_sel=mysqli_fetch_array($project_query)){
			$no++;
            $project_id=$projec_sel['project_id'];
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_client_id=$p_array[0]['project_client_id'];
				$project_name=$p_array[0]['project_name'];
				$current_project=$p_array[0]['current_project'];
				$project_email=$p_array[0]['project_email'];
				$project_password=$p_array[0]['project_password'];
				$project_status=$p_array[0]['status_id'];

			 $project_account_array=$callclass->_get_project_account_detail($conn, $project_id);
 			  $pa_array = json_decode($project_account_array, true);
					$payout_type_id=$pa_array[0]['payout_type_id'];
					$bank_id=$pa_array[0]['bank_id'];
					$bank_name=$pa_array[0]['bank_name'];
					$account_number=$pa_array[0]['account_number'];
					$account_name=$pa_array[0]['account_name'];
					$business_certificate=$pa_array[0]['business_certificate'];
					$business_reg_number=$pa_array[0]['business_reg_number'];
					$activation_status_id=$pa_array[0]['activation_status_id'];
            ?>
	<div class="project-list-div" onclick="_get_form_with_id('get_project_settings_form','<?php echo $project_id;?>')">
    	<div class="num"><?php echo $no;?></div>
        <div class="name"><?php echo ucwords(strtolower($project_name));?></div>
        <div class="details">PROJECT ID: <strong><?php echo $project_id;?></strong> | CLIENT ID: <strong><?php echo $project_client_id;?></strong>  
                <div class="project-status">
					<?php if ($project_status=='A'){ ?>                               
                    <div class="status"><div class="text animated fadeInRight animated animated">ACTIVE</div></div>
					<?php }elseif($project_status=='P'){ ?> 
                    <div class="status close"><div class="text animated fadeInRight animated animated">PENDING</div></div>
					<?php }else{ ?> 
                    <div class="status close"><div class="text animated fadeInRight animated animated">SUSPENDED</div></div>
					<?php }?>                               
                </div>
        </div>
    </div>
<?php }?>
            
            <?php if ($no==0){?>
                <div class="alert"><i class="fa fa-bell-o"></i> No record found</div>
            <?php } ?>
<?php }?>


















<?php if ($check_code=='project-setup'){
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$user_id=$p_array[0]['user_id'];
				$project_client_id=$p_array[0]['project_client_id'];
				$project_name=$p_array[0]['project_name'];
				$project_phone=$p_array[0]['project_phone'];
				$project_email=$p_array[0]['project_email'];
				$project_password= $p_array[0]['project_password'];
				$project_status= $p_array[0]['status_id'];
				$country_code=$p_array[0]['country_code'];

			 $country_array=$callclass->_get_country_detail($conn, $country_code);
 			  $c_array = json_decode($country_array, true);
				$country_name=$c_array[0]['country_name'];
				$country_alias=$c_array[0]['country_alias'];

			$count_query=mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1");				
			$count_acount=mysqli_num_rows($count_query);				
?>


                               
        <div class="alert"><span>PROJECT DETAILS</span></div>
        <div class="detail-list">COUNTRY: <div class="detail-status"><?php echo strtoupper($country_name); ?></div></div>
        <div class="detail-list">AVAILABLE BALANCE: <div class="detail-status"><button class="btn" onclick="_toggle('update-wallet-div')">UPDATE WALLET</button><span id="project_currency_form">--</span><b id="myWallet_form">--</b></div></div>
       		<div id="update-wallet-div" style="display:none;">
                          <div class="alert alert-success">
                             <div class="title">SELECT TRANSACTION TYPE</div>
                               <select id="update_wallet_type"  class="text_field selectinput">
									<option value=""> SELECT TRANSACTION TYPE</option>
									<option value="substration"> DEBIT</option>
									<option value="addition"> CREDIT</option>
                               </select>
                             <div class="title">AMOUNT</div>
                                <input id="update_wallet_amount" type="number" class="text_field" placeholder="AMOUNT" title="AMOUNT"/>
                             <div class="title">NARRATION</div>
                                <input id="update_wallet_narration" type="text" class="text_field" placeholder="NARRATION" title="NARRATION"/>
                              <button class="btn green" type="button" title="Update" id="update-wallet-btn" onclick="_update_client_wallet('<?php echo $admin_token;?>','<?php echo $project_id;?>','<?php echo $project_client_id;?>');"> <i class="fa fa-check"></i> UPDATE WALLET </button><br clear="all" />
                          </div>
            </div>
       
       
       
       <div class="title">PROJECT NAME</div>
           <input id="project_name" type="text" class="text_field" placeholder="PROJECT NAME" title="PROJECT NAME" value="<?php echo ucwords(strtolower($project_name)); ?>"/>
       <div class="title">PHONE NUMBER</div>
          <input id="project_phone" type="text" class="text_field" placeholder="PHONE NUMBER" title="PHONE NUMBER" value="<?php echo $project_phone; ?>"/>
       <div class="title">PROJECT EMAIL ADDRESS</div>
          <input id="project_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS" value="<?php echo $project_email; ?>"/>


				 <?php if ($count_acount<=0){?>
                  <button class="btn" type="button" title="Submit" id="delete-project-btn" onclick="_delete_project('<?php echo $admin_token;?>','<?php echo $project_client_id;?>','<?php echo $user_id;?>');"> <i class="fa fa-close"></i>  DELETE PROJECT </button>
                 <?php }?>
		<script>_getOneClient('<?php echo $admin_token;?>','<?php echo $project_client_id;?>');</script>
<?php }?>




<?php if ($check_code=='payout-setup'){ ?>  
			<?php
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_client_id=$p_array[0]['project_client_id'];
					$fetch_acount=$callclass->_get_project_account_detail($conn, $project_id);
					  $array = json_decode($fetch_acount, true);
						$f_payout_type_id= $array[0]['payout_type_id'];
						$bank_id= $array[0]['bank_id'];
					  	$bank_name= $array[0]['bank_name'];
						$account_number= $array[0]['account_number'];
						$account_name= $array[0]['account_name'];
						$activation_status_id= $array[0]['activation_status_id'];
						$collection_service_charge= $array[0]['collection_service_charge'];
					  	$payout_service_charge= $array[0]['payout_service_charge'];
					  	$payout_charge_type= $array[0]['payout_charge_type'];

					$fetch_payout_charge=$callclass->_get_service_charge_type_detail($conn, $payout_charge_type);
					  $array = json_decode($fetch_payout_charge, true);
						$service_charge_type_name= $array[0]['service_charge_type_name'];
						
					$fetch_payout_type=$callclass->_get_payout_type_detail($conn, $f_payout_type_id);
					  $array = json_decode($fetch_payout_type, true);
						$f_payout_type_name= $array[0]['payout_type_name'];
			?>
             <div class="alert"><span>PAYOUT DETAILS</span></div>
                 <div class="detail-list">PAYOUT CHARGES: <div class="detail-status"><?php echo $payout_service_charge;?><?php echo $service_charge_type_name;?> </div></div>
                 <div class="title">SELECT PAYOUT METHOD</div>
                   <select id="payout_type_id"  class="text_field selectinput" onchange="_payout_type('<?php echo $access_token;?>')">
                  
                         <?php if ($count_acount>0){?>
                       <option value="<?php echo $f_payout_type_id;?>" selected="selected"><?php echo $f_payout_type_name;?></option>
						 <?php }
                     $query= mysqli_query($conn,"SELECT * FROM payout_type_tab");
                    while($sel=mysqli_fetch_array($query)){
                    $payout_type_id=$sel['payout_type_id'];
                    $payout_type_name=$sel['payout_type_name'];
                     ?>
                       <option value="<?php echo $payout_type_id;?>"><?php echo $payout_type_name;?></option>
                        <?php }?>
                  </select>
                  
                         <?php if ($f_payout_type_id=='momo'){?>
                              <div class="alert alert-success" id="payout-momo">
                                 <div class="title">MoMo SERVICE PROVIDER</div>
                                   <select id="momo_id"  class="text_field selectinput">
                                   <option value="<?php echo $bank_id;?>|<?php echo $bank_name;?>" selected="selected"><?php echo $bank_name;?></option>
                                   </select>
                                 <div class="title">MoMo NUMBER</div>
                                    <input id="momo_number" type="text" class="text_field" placeholder="MoMo NUMBER" title="MoMo NUMBER" value="<?php echo $account_number;?>"/>
                              </div>
						 <?php }else{?>
                          <div class="alert alert-success" id="payout-bank">
                             <div class="title">SELECT BANK</div>
                               <select id="bank_id"  class="text_field selectinput">
                                   <option value="<?php echo $bank_id;?>|<?php echo $bank_name;?>" selected="selected"><?php echo $bank_name;?></option>
                               </select>
                             <div class="title">ACCOUNT NUMBER</div>
                                <input id="account_number" type="text" class="text_field" placeholder="ACCOUNT NUMBER" title="ACCOUNT NUMBER" onkeyup="_get_account_name()" maxlength="10" value="<?php echo $account_number;?>"/>
                                <input id="account_name" type="text" class="text_field" placeholder="ACCOUNT NAME" title="ACCOUNT NAME" value="<?php echo $account_name;?>"/>
                          </div>
						 <?php }?>
<?php }?>





<?php if ($check_code=='collection-settings'){ 
					$fetch_collection_charge=$callclass->_get_service_charge_type_detail($conn, $collection_charge_type);
					  $array = json_decode($fetch_collection_charge, true);
						$service_charge_type_name= $array[0]['service_charge_type_name'];
?>                               
                                
                                <div class="alert"><span>COLLECTIONS DETAILS</span></div>
                                                                
                                <div class="detail-list">COLLECTION:<div class="detail-status"> <div class="status" onclick="_get_collection_status('off')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">ON</div></div></div></div>
                             <div class="detail-list">COLLECTION CHARGES: <div class="detail-status"><?php echo $collection_service_charge;?><?php echo $service_charge_type_name;?></div></div>
                             
<?php }?>







<?php if ($check_code=='compliance-setup'){ ?>                                                               
			<?php
						if ($business_certificate!=''){
						$certificate_url="../sa/uploaded_files/business_certificate/$business_certificate";
						}else{
						$certificate_url="";
						}
			?>
                    <div class="alert"><span>COMPLIANCE DETAILS</span></div>
                    
                     <div class="title">BUSINESS REGISTRATION CERTIFICATE</div>
                    <div style="background:url(all-images/images/cv.jpg) center top; background-size:cover;">
                    <iframe src="<?php echo $certificate_url;?>" style="border:none; margin:0px; width:100%; height:300px;" id="note-preview"> </iframe>
                    </div>
                    
                  <div class="title">BUSINESS/CAC NUMBER</div>
                  <input id="business_number" type="text" class="text_field" placeholder="BUSINESS/CAC NUMBER" title="BUSINESS/CAC NUMBER" value="<?php echo $business_reg_number;?>"/>
                  
                  <button class="btn" type="button" title="Decline" id="busness-activate-btn" onclick="_project_compliance('decline_project_panel','<?php echo $project_id;?>');"> <i class="fa fa-check"></i>  DECLINE </button>
                  <button class="btn red" type="button" title="Suspend" id="busness-suspend-btn" onclick="_suspendClient('<?php echo $project_id;?>','<?php echo $project_client_id;?>','<?php echo $admin_token;?>');"> <i class="fa fa-check"></i>  SUSPEND </button>
                  <button class="btn green" type="button" title="Submit" id="busness-activate-btn" onclick="_project_compliance('activate_project_panel','<?php echo $project_id;?>','<?php echo $admin_token;?>');"> <i class="fa fa-check"></i>  ACTIVATE/UPDATE </button>
<?php }?>

<?php if ($check_code=='activate_project_panel'){ ?>                                                               
                  <div class="alert"><span>PROJECT UPDATES/ACTIVATION DETAILS</span><br />
                  kindly provide the services charges below to activate this project.
                  </div>
                  
                  <div class="detail-list">PROJECT NAME: <div class="detail-status"><?php echo $project_name; ?></div></div>
                  <div class="detail-list">COUNTRY: <div class="detail-status"><?php echo strtoupper($country_name); ?></div></div>
                    
                  <div class="title">COLLECTION SERVICE CHARGE</div>
                  <input id="collection_charges" type="number" class="text_field segment" placeholder="COLLECTION CHARGE" title="COLLECTION SERVICE CHARGE" value="<?php echo $collection_service_charge; ?>"/>

					<?php
                                 $ct_array=$callclass->_get_service_charge_type_detail($conn, $collection_charge_type);
                                  $array = json_decode($ct_array, true);
                                    $service_charge_type_name=$array[0]['service_charge_type_name'];
                    ?>
                   <select id="collection_charges_type"  class="text_field selectinput segment">
                  
                         <?php if ($collection_charge_type!=''){?>
                       <option value="<?php echo $collection_charge_type;?>" selected="selected"><?php echo $service_charge_type_name;?></option>
						 <?php }
                     $query= mysqli_query($conn,"SELECT * FROM service_charge_type_tab");
                    while($sel=mysqli_fetch_array($query)){
                    $service_charge_type_id=$sel['service_charge_type_id'];
                    $service_charge_type_name=$sel['service_charge_type_name'];
                     ?>
                       <option value="<?php echo $service_charge_type_id;?>"><?php echo $service_charge_type_name;?></option>
                        <?php }?>
                  </select>
                  <div class="title">PAYOUT SERVICE CHARGE</div>
                  <input id="payout_charges" type="number" class="text_field segment" placeholder="PAYOUT CHARGE" title="PAYOUT SERVICE CHARGE" value="<?php echo $payout_service_charge; ?>"/>
					<?php
                                 $ct_array=$callclass->_get_service_charge_type_detail($conn, $payout_charge_type);
                                  $array = json_decode($ct_array, true);
                                    $service_charge_type_name=$array[0]['service_charge_type_name'];
                    ?>
                   <select id="payout_charges_type"  class="text_field selectinput segment">
                  
                         <?php if ($payout_charge_type!=''){?>
                       <option value="<?php echo $payout_charge_type;?>" selected="selected"><?php echo $service_charge_type_name;?></option>
						 <?php }
						   $query= mysqli_query($conn,"SELECT * FROM service_charge_type_tab");
							while($sel=mysqli_fetch_array($query)){
							$service_charge_type_id=$sel['service_charge_type_id'];
							$service_charge_type_name=$sel['service_charge_type_name'];
						 ?>
                       <option value="<?php echo $service_charge_type_id;?>"><?php echo $service_charge_type_name;?></option>
                        <?php }?>
                  </select>
                  <button class="action-btn" type="button" title="Submit" id="activate-project-btn" onclick="_activate_project('<?php echo $admin_token;?>','<?php echo $project_id;?>','<?php echo $project_client_id;?>');"> <i class="fa fa-check"></i>  ACTIVATE PROJECT </button>
<?php }?>
























<?php if ($check_code=='collections-list'){ ?> 
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-money"></i></span> Collections Between <span id="startDate"><?php echo $day30; ?></span> - <span id="endDate"><?php echo $today; ?></span> <button class="btn" onclick="exportTableToExcel('transaction-table','collectionExportReport')">Export</button></div>

        <table border="0"  cellspacing="1" class="table" id="transaction-table">
              <tr style="background:#bdc3c7;">
                <td>SN&nbsp;&nbsp;&nbsp;</td>
                <!--<td>CLIENT ID</td>-->
                <td>DATE</td>
                <td>CUST. NO.</td>
                <td>AMOUNT</td>
                <td>SERVICE CHARGE</td>
                <td>BAL BEFORE</td>
                <td>STATUS</td>
                <!--<td>NARRATION</td>-->
                <td>REFERENCE</td>
                <td>BAL AFTER</td>
              </tr>
              
              
              
              <tr id="loading"><td colspan="20"><div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div></td></tr>
        </table>
                
</div>

<?php }?>











<?php if ($check_code=='payout-list'){ ?> 
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-money"></i></span> PayOut Between <span id="startDate"><?php echo $day30; ?></span> - <span id="endDate"><?php echo $today; ?></span>    <button class="btn" onclick="exportTableToExcel('transaction-table','payoutExportReport')">Export</button></div>

        <table border="0"  cellspacing="1" class="table" id="transaction-table">
              <tr style="background:#bdc3c7;">
                <td>SN</td>
                <td>DATE</td>
                <td>AMOUNT</td>
                <td>SERVICE CHARGE</td>
                <td>BAL BEFORE</td>
                <td>STATUS</td>
                <td>NARRATION</td>
                <td>REFERENCE</td>
                <td>BAL AFTER</td>
              </tr>
              
              
              <tr id="loading"><td colspan="20"><div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div></td></tr>
        </table>
                
</div>

<?php }?>













<?php if ($check_code=='transfer-list'){ ?> 
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-money"></i></span> Transfer Between <span id="startDate"><?php echo $day30; ?></span> - <span id="endDate"><?php echo $today; ?></span> <button class="btn" onclick="exportTableToExcel('transaction-table','transferExportReport')">Export</button></div>

        <table border="0"  cellspacing="1" class="table" id="transaction-table">
              <tr style="background:#bdc3c7;">
                <td>SN</td>
                <td>DATE</td>
                <td>AMOUNT</td>
                <td>TYPE</td>
                <td>STATUS</td>
                <td>NARRATION</td>
                <td>REFERENCE</td>
              </tr>
              
              <tr id="loading"><td colspan="20"><div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div></td></tr>
        </table>
                
</div>

<?php }?>







