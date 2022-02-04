<?php if ($check_code=='trendbarchart'){?>

<div class="chart">
<div class="rev-report">Revenue Between <?php echo $day30; ?> - <?php echo $today; ?><br /><b id="project_currency_dashboard">--</b><span><?php echo number_format($grandAmount,2);?></span></div>

<div id="chartContainer" style="height: 300px; max-width: 920px; margin: 0px auto;"></div>
<script>
$(document).ready(function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: " "
	},
	axisX:{
		valueFormatString: "DD MMM",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: " ",
		includeZero: false,
		valueFormatString: "##0.00",
		crosshair: {
			enabled: true,
			snapToDataPoint: true,
			labelFormatter: function(e) {
				return "N" + CanvasJS.formatNumber(e.value, "##0.00");
			}
		}
	},
	data: [{
		type: "area",
		xValueFormatString: "DD MMM",
		yValueFormatString: "N##0.00",
		dataPoints: [
		<?php echo $trend ?>
			//{ x: new Date(2020, 01, 05), y: 1000 },
			//{ x: new Date(2020, 02, 05), y: 4000 },
		]
	}]
});
chart.render();

})
		_get_wallet_balance('<?php echo $access_token?>');
		_get_collection_data('<?php echo $access_token?>');
		_call_countCollections('<?php echo $access_token?>');
</script>
</div>
<?php }?>






<?php if ($check_code=='chat_for_pie'){?>
            <div id="chartContainer1" style="width:95%; height:180px; margin:auto;"></div>
            
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






























<?php if ($check_code=='project-setup'){ ?>                               
        <div class="alert">SET <span>PROJECT DETAILS</span></div>
        <div class="detail-list">COUNTRY: 
            <div class="detail-status"><?php echo strtoupper($country_name); ?></div>
        </div>
      <div class="detail-list">AVAILABLE BALANCE: 
          <div class="detail-status"><span id="project_currency_form">--</span><b id="myWallet_form">--</b></div>
      </div>
       <div class="title">PROJECT NAME</div>
           <input id="project_name" type="text" class="text_field" placeholder="PROJECT NAME" title="PROJECT NAME" value="<?php echo ucwords(strtolower($project_name)); ?>"/>
       <div class="title">PHONE NUMBER</div>
          <input id="project_phone" type="text" class="text_field" placeholder="PHONE NUMBER" title="PHONE NUMBER" value="<?php echo $project_phone; ?>"/>
       <div class="title">PROJECT EMAIL ADDRESS</div>
          <input id="project_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS" value="<?php echo $project_email; ?>"/>
         <button class="action-btn" type="button" title="Submit" id="update-project-btn" onclick="_update_project('<?php echo $country_code; ?>','<?php echo $country_name; ?>','<?php echo $access_token; ?>');"> <i class="fa fa-check"></i>  UPDATE PROJECT </button>
	
					<script>_get_wallet_balance('<?php echo $access_token;?>');</script>
					<script>_get_collection_data('<?php echo $access_token;?>');</script>
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


<?php }?>




<?php if ($check_code=='payout-setup'){ ?>  
			<?php
			$count_query=mysqli_query($conn,"SELECT * FROM projects_bank_detail_tab WHERE project_id='$project_id' LIMIT 1");				
			$count_acount=mysqli_num_rows($count_query);				
				if ($count_acount>0){/// check 1
					$fetch_payout_type=$callclass->_get_payout_type_detail($conn, $f_payout_type_id);
					  $array = json_decode($fetch_payout_type, true);
						$f_payout_type_name= $array[0]['payout_type_name'];
				}
			?>
             <div class="alert">SET <span>PAYOUT DETAILS</span></div>
                 <div class="detail-list">PAYOUT SERVICE CHARGES <div class="detail-status"> <?php echo "$payout_service_charge $payout_charge_name";?></div></div>
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
                  
                         <?php if ($count_acount>0){?>
                         <?php if ($f_payout_type_id=='momo'){?>
                              <div class="alert alert-success" id="payout-momo">
                                 <div class="title">MoMo SERVICE PROVIDER</div>
                                   <select id="momo_id"  class="text_field selectinput">
                                   <option value="<?php echo $bank_id;?>|<?php echo $bank_name;?>" selected="selected"><?php echo $bank_name;?></option>
                                   </select>
                                 <div class="title">MoMo NUMBER</div>
                                    <input id="momo_number" type="text" class="text_field" placeholder="MoMo NUMBER" title="MoMo NUMBER" value="<?php echo $account_number;?>"/>
                                    
                                   <button class="action-btn" type="button" title="Submit" id="save-momo-payout-btn" onclick="_save_payout('momo');"> <i class="fa fa-save"></i>  SAVE </button>
                              </div>


                              <div class="alert alert-success" id="payout-bank" style="display:none;">
                                 <div class="title">SELECT BANK</div>
                                   <select id="bank_id"  class="text_field selectinput"></select>
                                 <div class="title">ACCOUNT NUMBER</div>
                                    <input id="account_number" type="text" class="text_field" placeholder="ACCOUNT NUMBER" title="ACCOUNT NUMBER" onkeyup="_get_account_name()" maxlength="10"/>
                                    <input id="account_name" type="text" class="text_field" placeholder="ACCOUNT NAME" title="ACCOUNT NAME" style="display:none;"/>
                                   <button class="action-btn" type="button" title="Submit" id="save-bank-payout-btn" onclick="_save_payout('bank');"> <i class="fa fa-save"></i>  SAVE </button>
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
                               <button class="action-btn" type="button" title="Submit" id="save-bank-payout-btn" onclick="_save_payout('bank');"> <i class="fa fa-save"></i>  SAVE </button>
                          </div>


                              <div class="alert alert-success" id="payout-momo" style="display:none;">
                                 <div class="title">MoMo SERVICE PROVIDER</div>
                                   <select id="momo_id"  class="text_field selectinput"></select>
                                 <div class="title">MoMo NUMBER</div>
                                    <input id="momo_number" type="text" class="text_field" placeholder="MoMo NUMBER" title="MoMo NUMBER"/>
                                    
                                   <button class="action-btn" type="button" title="Submit" id="save-momo-payout-btn" onclick="_save_payout('momo');"> <i class="fa fa-save"></i>  SAVE </button>
                              </div>

						 <?php }
						 }else{?>
                              <div class="alert alert-success" id="payout-momo">
                                 <div class="title">MoMo SERVICE PROVIDER</div>
                                   <select id="momo_id"  class="text_field selectinput"></select>
                                 <div class="title">MoMo NUMBER</div>
                                    <input id="momo_number" type="text" class="text_field" placeholder="MoMo NUMBER" title="MoMo NUMBER"/>
                                    
                                   <button class="action-btn" type="button" title="Submit" id="save-momo-payout-btn" onclick="_save_payout('momo');"> <i class="fa fa-save"></i>  SAVE </button>
                              </div>
                              
                              <div class="alert alert-success" id="payout-bank" style="display:none;">
                                 <div class="title">SELECT BANK</div>
                                   <select id="bank_id"  class="text_field selectinput"></select>
                                 <div class="title">ACCOUNT NUMBER</div>
                                    <input id="account_number" type="text" class="text_field" placeholder="ACCOUNT NUMBER" title="ACCOUNT NUMBER" onkeyup="_get_account_name()" maxlength="10"/>
                                    <input id="account_name" type="text" class="text_field" placeholder="ACCOUNT NAME" title="ACCOUNT NAME" style="display:none;"/>
                                   <button class="action-btn" type="button" title="Submit" id="save-bank-payout-btn" onclick="_save_payout('bank');"> <i class="fa fa-save"></i>  SAVE </button>
                              </div>
                
						 <?php }?>
					<script>_getAllMomo('<?php echo $access_token;?>');</script>
<?php }?>





<?php if ($check_code=='collection-settings'){ ?>                               
                                
                                <div class="alert">PROJECT <span>COLLECTIONS DETAILS</span></div>
                                                                
                                <div class="detail-list">COLLECTION: 
                                	<div class="detail-status">
                                        <div class="status" onclick="_get_collection_status('off')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">ON</div></div>
                                	</div>
                                </div>
                                							
                             <div class="detail-list">COLLECTION SERVICE CHARGES <div class="detail-status"><?php echo "$collection_service_charge $collection_charge_name";?></div></div>
                             
                                <div class="alert alert-success">PROJECT <span>API DEMO KEYS</span> <button class="btn" id="demokey" onclick="_get_api_key('<?php echo $access_token; ?>','demokey')"><i class="fa fa-plus"></i></button>
                                	<div  class="apikey" id="expand-demokey">
                                     <div class="title">PRIMARY KEY</div>
                                    <input id="api-demo-pry" type="text" class="text_field" readonly="readonly"/>
                                     <div class="title">SECONDARY KEY</div>
                                    <input id="api-demo-sec" type="text" class="text_field" readonly="readonly"/>
                                    </div>
                                </div>
                                
                                

						<?php if ($project_status=='A'){?>
                                <div class="alert alert-success">PROJECT <span>API LIVE KEYS</span> <button class="btn" id="livekey" onclick="_get_api_key('<?php echo $access_token; ?>','livekey')"><i class="fa fa-plus"></i></button>
                                	<div  class="apikey" id="expand-livekey">
                                     <div class="title">PRIMARY KEY</div>
                                    <input id="api-live-pry" type="text" class="text_field" readonly="readonly"/>
                                     <div class="title">SECONDARY KEY</div>
                                    <input id="api-live-sec" type="text" class="text_field" readonly="readonly"/>
                                   <button class="action-btn" type="button" title="Submit" id="refresh-api-key-btn" onclick="_refresh_api_key('<?php echo $access_token; ?>');"> <i class="fa fa-refresh"></i>  REFRESH </button>
                                    </div>
                                </div>
						<?php }?>
<?php }?>







<?php if ($check_code=='compliance-setup'){ ?>                               
			<?php
						if ($business_certificate!=''){
						$certificate_url="../sa/uploaded_files/business_certificate/$business_certificate";
						}else{
						$certificate_url="";
						}
			?>
                                
                    <div class="alert">SET <span>COMPLIANCE DETAILS</span></div>
                    
                     <div class="title">BUSINESS REGISTRATION CERTIFICATE</div>
                    <div style="background:url(all-images/images/cv.jpg) center top; background-size:cover;">
                    <iframe src="<?php echo $certificate_url;?>" style="border:none; margin:0px; width:100%; height:300px;" id="note-preview"> </iframe>
                    </div>
 			<?php if ($activation_status_id!='A'){?>
                   <label>
                    <input type="file" class="text_field" id="up_note" style="display:none;" accept=".pdf"/> 
                    <div class="upload-btn" id="upload-note-btn"> <i class="fa fa-upload"></i> Click Here to Upload</div>
                    </label>
            <?php }?>
                    
                  <div class="title">BUSINESS/CAC NUMBER</div>
                  <input id="business_number" type="text" class="text_field" placeholder="BUSINESS/CAC NUMBER" title="BUSINESS/CAC NUMBER" value="<?php echo $business_reg_number;?>"/>
					<?php if ($activation_status_id==''){ ?>                               
                   <button class="action-btn" type="button" title="Submit" id="busness-activate-btn" onclick="_request_for_business_activation();"> <i class="fa fa-check"></i>  REQUEST FOR BUSINESS ACTIVATION </button>
					<?php }else{ ?> 
						<?php if ($activation_status_id!='A'){?>
                               <button class="action-btn" type="button" title="Submit" id="busness-activate-btn" onclick="alert_close();"> <i class="fa fa-close"></i>  CLOSE PANEL </button>
                        <?php }?>                               
					<?php }?>                               
<script type="text/javascript" language="javascript">

$(function(){
    $('#up_note').on('change', function(){
		var file = this.files[0];
		var reader = new FileReader();
		reader.onload = viewer.load;
		reader.readAsDataURL(file);
		viewer.setProperties(file);
  }); 
      var viewer = {
		  load : function(e){
		$('#note-preview').attr('src', e.target.result);
		  },
	  }
});

</script>
<?php }?>
























<?php if ($check_code=='project-list'){ ?> 
		<?php if ($all_search_txt==''){ ?>                               
         <div class="alert alert-success"> <span><i class="fa fa-th-large"></i></span> PROJECT LIST <button class="btn" onClick="_get_form('create-project-form')"><i class="fa fa-plus"></i> CREATE A NEW PROJECT</button></div>
        <?php }else{ ?> 
         <div class="alert alert-success"> <span><i class="fa fa-th-large"></i></span> SEARCH RESULT FOR  <span><?php echo $all_search_txt?></span> <button class="btn" onClick="_get_form('create-project-form')"><i class="fa fa-plus"></i> CREATE A NEW PROJECT</button></div>
        <?php }?>                               
                            
    <?php
	                        $search_like="(project_id like '%$all_search_txt%' OR
										project_name like '%$all_search_txt%')";

	$no=0;
        $project_query=mysqli_query($conn,"SELECT * FROM projects_tab WHERE user_id='$user_id' AND $search_like");
        while ($projec_sel=mysqli_fetch_array($project_query)){
			$no++;
            $project_id=$projec_sel['project_id'];
			 $project_array=$callclass->_get_project_detail($conn, $project_id);
 			  $p_array = json_decode($project_array, true);
				$project_name=$p_array[0]['project_name'];
				$current_project=$p_array[0]['current_project'];
				$project_email=$p_array[0]['project_email'];
				$project_password=$p_array[0]['project_password'];
            ?>
	<div class="project-list-div">
    	<div class="num"><?php echo $no;?></div>
        <div class="name"><?php echo ucwords(strtolower($project_name));?></div>
        <div class="details">PROJECT ID: <strong><?php echo $project_id;?></strong> 
                <div class="project-status">
					<?php if ($current_project=='Y'){ ?>                               
                    <div class="status close"><div class="text animated fadeInRight animated animated">CURRENT</div></div>
					<?php }else{ ?> 
                    <div class="status" onclick="_switch_to_project('<?php echo $project_id;?>','<?php echo ucwords(strtolower($project_name));?>','<?php echo $project_email;?>','<?php echo $project_password;?>')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">SWITCH</div></div>
					<?php }?>                               
                </div>
        </div>
    </div>
<?php }?>
            
            <?php if ($no==0){?>
                <div class="alert"><i class="fa fa-bell-o"></i> No record found</div>
            <?php } ?>
<?php }?>

























<?php if ($check_code=='collections-list'){ ?> 
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-money"></i></span> Collections Between <span id="startDate"><?php echo $day30; ?></span> - <span id="endDate"><?php echo $today; ?></span> <button class="btn" onclick="exportTableToExcel('transaction-table','collectionExportReport')">Export</button></div>

        <table border="0"  cellspacing="1" class="table" id="transaction-table">
              <tr style="background:#bdc3c7;">
                <td>SN</td>
                <td>DATE</td>
                <td>MOBILE NUMBER</td>
                <td>BALANCE BEFORE</td>
                <td>AMOUNT</td>
                <td>SERVICE CHARGE</td>
                <td>BALANCE AFTER</td>
                <td>STATUS</td>
                <td>NARRATION</td>
                <td>REFERENCE</td>
              </tr>
              
              <tr id="payout-loading"><td colspan="20"><div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div></td></tr>
        </table>
                
</div>

<?php }?>
















<?php if ($check_code=='payout-list'){ ?> 
                <div class="alert alert-success" style="text-align:left;"> <span><i class="fa fa-money"></i></span> PayOut Between <span id="startDate"><?php echo $day30; ?></span> - <span id="endDate"><?php echo $today; ?></span> <button class="btn" onclick="exportTableToExcel('transaction-table','payoutExportReport')">Export</button></div>

        <table border="0"  cellspacing="1" class="table" id="transaction-table">
              <tr style="background:#bdc3c7;">
                <td>SN</td>
                <td>DATE</td>
                <td>BALANCE BEFORE</td>
                <td>AMOUNT</td>
                <td>SERVICE CHARGE</td>
                <td>BALANCE AFTER</td>
                <td>STATUS</td>
                <td>PAYOUT TYPE</td>
                <td>NARRATION</td>
                <td>REFERENCE</td>
              </tr>
              
              <tr id="payout-loading"><td colspan="20"><div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div></td></tr>
        </table>
                
</div>

<?php }?>


