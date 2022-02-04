//////////////////////////////13/8/2019////////////////////////// by Afolabi Oluwagbnega Sunday
jQuery(document).ready(function() {
    $.backstretch(["all-images/images/bg.jpg"],{duration: 4000, fade: 2000});
    });





function _login_and_get_admin_token_to_session(user,password){
			var dataString ='user='+ user+'&password='+ password;
			$.ajax({
				type: "POST",
				url:admin_login_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var error = data.error;
					var admin_token = data.adminToken;
					var message = data.message;
					if (error==false){
						_get_admin_token_to_session(admin_token);
					}else{
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div>'+message+'').fadeIn(500).delay(5000).fadeOut(100);
					}
				}
			});
}


function _get_admin_token_to_session(admin_token){
		var action='get_admin_token_to_session';
		var dataString ='action='+ action+'&admin_token='+ admin_token;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
		_get_dashboard_trend(admin_token);
		}
		});
}










//////////////// for dashboard trend
function _get_dashboard_trend(admin_token){
		var action='trend_json';
		var dataString ='action='+ action;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		dataType: 'json',
		cache: false,
		success: function(report){
		  var startDate = report.startDate;
		  var endDate = report.endDate;
		  var display_startDate = report.display_startDate;
		  var display_endDate = report.display_endDate;
		_countCollectionsPerDays(admin_token,startDate,endDate,display_startDate,display_endDate);
		}
		});
}

function _countCollectionsPerDays(admin_token,startDate,endDate,display_startDate,display_endDate){
			var status='Payer Debited';
			var client_id='';
			var currency='';
			var dataString ='status='+ status+'&clientID='+ client_id+'&currency='+ currency+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:countCollectionsPerDays_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  
			  var grandAmount=0;
			  var totalCharges=0;
			  
			  var AmountTrend ='';
			  var ChargesTrend ='';
			  var CountTrend ='';
			  if (error==false){
				for (var i = 0; i < data.length; i++) {
				  var day = data[i].day;
				  var totalAmount = data[i].totalAmount;
				  var counts = data[i].count;
				  var serviceCharge = data[i].serviceCharge;

						trans_date = new Date(day)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth();
						ToDay=trans_date.getDate();
						
					AmountTrend +='{ x: new Date('+ToYear+', '+ToMonth+', '+ToDay+'), y: '+totalAmount +'},';
					ChargesTrend +='{ x: new Date('+ToYear+', '+ToMonth+', '+ToDay+'), y: '+serviceCharge +'},';
					CountTrend +='{ x: new Date('+ToYear+', '+ToMonth+', '+ToDay+'), y: '+counts +'},';
					grandAmount=grandAmount + totalAmount;
					totalCharges=totalCharges + serviceCharge;
				}
				_chart_for_trend(AmountTrend,ChargesTrend,CountTrend,grandAmount,totalCharges,display_startDate,display_endDate);
			  }
		  }
	  });
}


function _chart_for_trend(AmountTrend,ChargesTrend,CountTrend,grandAmount,totalCharges,display_startDate,display_endDate){
	var action='trendbarchart';
	var dataString ='action='+ action+'&AmountTrend='+ AmountTrend+'&ChargesTrend='+ ChargesTrend+'&CountTrend='+ CountTrend+'&grandAmount='+ grandAmount+'&totalCharges='+ totalCharges+'&display_startDate='+ display_startDate+'&display_endDate='+ display_endDate;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#chart-report-div').html(html);
		}
		});
}








function select_search(){
		$('.srch-select').toggle('fast');
};
function srch_custom(text){
		$('#srch-text').html(text);
		$('.custom-srch-div').fadeIn(500);
};



function get_dashboard_report(id,action,view_report){
		$('#srch-text').html($('#'+id).html());
		$('.custom-srch-div').fadeOut(500);
		$('#chart-report-div').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_countCollectionsPerDays(admin_token,startDate,endDate,display_startDate,display_endDate)
				}
		});
	}


function _fetch_custom_dashboard_report(action,view_report){
		var datefrom=$('#datepicker-from').val();
		var dateto=$('#datepicker-to').val();
			if((datefrom=='')||(dateto=='')){
	$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Search Date Fields Empty<br /><span>Please fill all the feilds</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{		
		$('#chart-report-div').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&datefrom='+datefrom+'&dateto='+dateto+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_countCollectionsPerDays(admin_token,startDate,endDate,display_startDate,display_endDate)
				}
		});
			}
};


function _call_countCollections(admin_token){
	var clientID='';
	var dataString ='clientID='+ clientID;
		$.ajax({
		type: "GET",
		url: countCollections_url,
		data: dataString,
		dataType: 'json',
		headers: {
		"AdminToken": admin_token,
		},
		cache: false,
		success: function(report){
				  var error = report.error;
				  var data = report.data;
				var success =data.success;
				var pending =data.pending;
				var failed =data.failed;
				_collection_matrix(success,pending,failed);
		}
		});
}

function _collection_matrix(success,pending,failed){
	var action='collection_matrix';
	var dataString ='action='+ action+'&success='+success+'&pending='+pending+'&failed='+failed;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#collection-matrix').html(html);
		}
		});
}


function _call_countDisbursements(admin_token){
	var clientID='';
	var dataString ='clientID='+ clientID;
		$.ajax({
		type: "GET",
		url: countDisbursements_url,
		data: dataString,
		dataType: 'json',
		headers: {
		"AdminToken": admin_token,
		},
		cache: false,
		success: function(report){
				  var error = report.error;
				  var data = report.data;
				var success =data.success;
				var pending =data.pending;
				var failed =data.failed;
				_payout_matrix(success,pending,failed);
		}
		});
}

function _payout_matrix(success,pending,failed){
	var action='payout_matrix';
	var dataString ='action='+ action+'&success='+success+'&pending='+pending+'&failed='+failed;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#payout-matrix').html(html);
		}
		});
}


































































function _create_user(){
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var role_id = $('#role_id').val();
			var status_id = $('#status_id').val();
			if((fullname=='')||(email=='')||(phone=='')||(email.indexOf('@')<=0)){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
			if (confirm("Confirm!!\n\n Are you sure to REGISTER THIS ADMINISTRATOR?")){
		$('#create-user-btn').html('PROCESSING...');
			document.getElementById('create-user-btn').disabled=true;
			var action ='create_user';
			var dataString ='action='+ action+'&fullname='+ fullname+'&email='+ email+'&phone='+ phone+'&role_id='+ role_id+'&status_id='+ status_id;
			$.ajax({
				type: "POST",
				url: local_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
				var scheck = data.check;
					if(scheck==1){
						_get_page('users', 'users');			
						$('#success-div').html('<div><i class="fa fa-check"></i></div> NEW ADMINISTRATOR REGISTERED SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
						alert_close();
					}else{
						$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Email Error!<br><span> Email Cannot Be Use</span>').fadeIn(500).delay(5000).fadeOut(100);
					}
						$('#create-user-btn').html('<i class="fa fa-check"></i> SUBMIT');
						document.getElementById('create-user-btn').disabled=false;
						
				}
			});
			}else{
				return false;
			}
			}
}


function _get_users_profile(users_id, divid){
			if(divid!=''){
				_get_active_link(divid);
			}
		$('#page-content').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var action='user-profile';
			var dataString ='action='+ action+'&users_id='+ users_id;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('#page-content').html(html);}
			});
}


$(function(){
    Test = {
        UpdatePreview: function(obj){
          // if IE < 10 doesn't support FileReader
          if(!window.FileReader){
             // don't know how to proceed to assign src to image tag
          } else {
			  _upload_profile_pix();
             var reader = new FileReader();
             var target = null;

             reader.onload = function(e) {
              target =  e.target || e.srcElement;
               $("#passportimg1,#passportimg2,#passportimg3").prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };
});


function _upload_profile_pix(){
		var action = 'update_profile_pix';
        var file_data = $('#passport').prop('files')[0];
		if (file_data==''){}else{ 
        var form_data = new FormData();                  
        form_data.append('passport', file_data);
        form_data.append('action', action);
        $.ajax({
            url: local_url,
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(html){
		$('#success-div').html('<div><i class="fa fa-check"></i></div> Passport Updated Successfully').fadeIn(500).delay(5000).fadeOut(100);
            $('#passport').val('');
			}
        });
		}
}


///////////////change user password//////////////
function _update_user_password(userid){
 			$('.success-div').hide()
			var oldpass = $('#oldpass').val();
			var newpass = $('#newpass').val();
			var cnewpass = $('#cnewpass').val();
			if((oldpass=='')||(newpass=='')||(cnewpass=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill The Passwords<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}
			else if(newpass!=cnewpass){
$('#not-success-div').html('<div><i class="fa fa-close"></i></div>New Password Not Match<br /><span>Check the fields again</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
		$('#update-user-password-btn').html('Updating...');
		var action ='update_user_password';
			var dataString ='action='+ action+'&userid='+ userid+'&oldpass='+ oldpass+'&newpass='+ newpass;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data){
		$('#update-user-password-btn').html('<i class="fa fa-refresh"></i> CHANGE PASSWORD ');
			var scheck = data.check;
				if(scheck==0){
$('#not-success-div').html('<div><i class="fa fa-close"></i></div> Incorrect Old Password <br /><span>The old password is not correct</span>').fadeIn(500).delay(5000).fadeOut(100);
				}else{
$('#success-div').html('<div><i class="fa fa-check"></i></div> Password Updated Successfully!<br /><span>Please Re-Login To Continue</span>').fadeIn(500).delay(5000).fadeOut(100);
				alert_close()
				}				
				}
			});
			}
}



function _update_user_profile(user_id){
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var role_id = $('#role_id').val();
			var status_id = $('#status_id').val();
			if((fullname=='')||(email=='')||(phone=='')||(email.indexOf('@')<=0)){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
			if (confirm("Confirm!!\n\n Are you sure to UPDATE?")){
		$('#update-user-btn').html('Updating...');
			document.getElementById('update-user-btn').disabled=true;
			var action ='update_users_profile';
			var dataString ='action='+ action+'&user_id='+ user_id+'&fullname='+ fullname+'&email='+ email+'&phone='+ phone+'&role_id='+ role_id+'&status_id='+ status_id;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data){
			var scheck = data.check;
			if(scheck==1){
				$('#success-div').html('<div><i class="fa fa-check"></i></div> User Profile Updated Successfully!').fadeIn(500).delay(5000).fadeOut(100);
				_get_users_profile(user_id,'myprofile');
			}else{
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Email Error!<br><span> Email Cannot Be Use</span>').fadeIn(500).delay(5000).fadeOut(100);
			}
				$('#update-user-btn').html('Update <i class="fa fa-check"></i>');
				document.getElementById('update-user-btn').disabled=false;
				}
			});
			}else{
				return false;
			}
			}
	
}

	function _fetch_users_list(){
			var status_id = $('#status_id').val();
			var all_search_txt = $('#all_search_txt').val();
		$('#search-content').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var action='fetch_users_list';
			var dataString ='action='+ action+'&all_search_txt='+ all_search_txt+'&status_id='+ status_id;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){$('#search-content').html(html);}
			});
	}

































































function _open_menu(){
var x = document.getElementById("menu-div");
  if (x.innerHTML === '<i class="fa fa-navicon (alias)"></i>') {
    x.innerHTML = '<i class="fa fa-close"></i>';
	   $('.side-nav-div').animate({'left':'0px'},200);
  } else {
    x.innerHTML = '<i class="fa fa-navicon (alias)"></i>';
	   $('.side-nav-div').animate({'left':'-100px'},200);
  }
}




function alert_close(){
		$('#get-more-div').html('').fadeOut(200);
}



function _get_active_link(divid){
		 $('#sdashboard, #sprojects').removeClass('active-li');
		 $('#dashboard, #users, #projects,#payout,#collections,#transfer,#app_settings').removeClass('active-li');
		 $('#'+divid).addClass('active-li');
		 $('#s'+divid).addClass('active-li');
		 $('#page-title').html($('#_'+divid).html());
}

function _open_li(ids){
		 $('#'+ids+'-sub-li').toggle('slow');
}



function _toggle_profile_pix_div(){
	   $('.toggle-profile-div').toggle('slow');
}



$(document).ready(function() {
		window.setInterval(function(){
			get_notification_number();
		},30000);
});



function get_notification_number(){
		var action='get_notification_number';
		var dataString ='action='+ action;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			success: function(data){
 	var scheck = data.check;
	if (scheck>0){
		if (scheck>9){var scheck='9+';}
		$('.notification').html('<i class="fa fa-bell-o"></i><div>'+scheck+'</div>');
	}else{
		$('.notification').html('<i class="fa fa-bell-o"></i><div>0</div>');
	}
				}
		});
}











function get_alert_report(id,action,view_report){
		$('#srch-text').html($('#'+id).html());
		$('.custom-srch-div').fadeOut(500);
		$('.system-alert-div').html('<div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>');
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){
				$('.system-alert-div').html(html);
				}
		});
	}
	
function _fetch_custom_alert_report(action,view_report){
		var datefrom=$('#datepicker-from').val();
		var dateto=$('#datepicker-to').val();
			if((datefrom=='')||(dateto=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Search Date Fields Empty<br /><span>Please fill all the feilds</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
		$('.system-alert-div').html('<div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>');
			var dataString ='action='+ action+'&datefrom='+datefrom+'&dateto='+dateto+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){
				$('.system-alert-div').html(html);
				}
		});
			}
};


	function _fetch_random_alert_search(action){
		var view_report='random_search';
			var all_search_txt = $('#all_search_txt').val();
		$('.system-alert-div').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&view_report='+ view_report+'&all_search_txt='+ all_search_txt;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('.system-alert-div').html(html);}
			});
	}

	function _read_alert(alert_id){	
		 $('#'+alert_id+'viewed').html('<i class="fa fa-check"></i><i class="fa fa-check"></i>');
		 $('#'+alert_id).addClass('system-alert alert-seen');

		$('#get-more-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
			var action='read_alert';
			var dataString ='action='+ action+'&alert_id='+ alert_id;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('#get-more-div').html(html);}
			});
	}





function _get_page(page, divid){
	 _get_active_link(divid);
	$('#page-content').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
		var action='get-page';
		var dataString ='action='+ action+'&page='+ page;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#page-content').html(html);
			}
		});
}

























































function _get_project_list(btn_id,status_id){
	_get_project_list_tab(btn_id);
	$('#search-content').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
		var action='project_list_tab';
		var dataString ='action='+ action+'&status_id='+ status_id;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#search-content').html(html);
			}
		});
}

function _get_project_list_tab(btn_id){
		 $('#active-project-btn, #pending-project-btn, #new-project-btn,#suspended-project-btn').removeClass('active-tab');
		 $('#'+btn_id).addClass('active-tab');
}

function _fetch_project_list(){
		var all_search_txt = $('#all_search_txt').val();
	$('#search-content').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
		var action='fetch_project_list';
		var dataString ='action='+ action+'&all_search_txt='+ all_search_txt;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#search-content').html(html);
			}
		});
}



function _getOneClient(admin_token,project_client_id){
	var dataString='ID='+ project_client_id;
		  $.ajax({
			  type: "GET",
			  url:getOneClient_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
				  var error = report.error;
				  var data = report.data;
				$('#project_currency_form').html(data.currencyName);
				$('#myWallet_form').html(data.wallet);
			  }
		  });
}





















































function _get_form(page){
		$('#get-more-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
			var action='get-form';
			var dataString ='action='+ action+'&page='+ page;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('#get-more-div').html(html);}
			});
}

function _get_form_with_id(page,ids){
		$('#get-more-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
			var action='get-form-with-id';
			var dataString ='action='+ action+'&page='+ page+'&ids='+ ids;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('#get-more-div').html(html);}
			});
}

















function _get_collection_setup_form(project_id){
		$('#get-more-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
			var action='get_collection_setup_form';
			var dataString ='action='+ action+'&project_id='+ project_id;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){$('#get-more-div').html(html);}
			});
}


function _get_collection_setup(page,btn_id,project_id){
	_get_active_collection(btn_id);
	
	$('#setup-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
		var action='get-setup';
		var dataString ='action='+ action+'&page='+ page+'&project_id='+ project_id;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#setup-div').html(html);
			}
		});
}

function _get_active_collection(btn_id){
		 $('#collection-setup-btn, #payout-setup-btn, #compliance-setup-btn, #project-setup-btn,  #collection-settings-btn').removeClass('active-menu');
		 $('#'+btn_id).addClass('active-menu');
}


function _project_compliance(action,project_id){
	$('#setup-div').html('<div class="ajax-loader">Loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
		var dataString ='action='+ action+'&project_id='+ project_id;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#setup-div').html(html);
			}
		});
}


function _activate_project(admin_token,project_id,project_client_id){
	var collection_charges = $('#collection_charges').val();
	var collection_charges_type = $('#collection_charges_type').val();
	var payout_charges = $('#payout_charges').val();
	var payout_charges_type = $('#payout_charges_type').val();
	
		if((collection_charges=='')||(collection_charges<=0)||(payout_charges=='')||(payout_charges<=0)){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> ERROR!!<br /><span>Check the inputs and try again.</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				
	
				if (confirm("Confirm!!\n\n Are you sure to ACTIVATE THIS PROJECT?")){
					$('#activate-project-btn').html('ACTIVATING...');
					document.getElementById('activate-project-btn').disabled=true;
					var dataString ='clientID='+ project_client_id;
						  $.ajax({
							  type: "POST",
							  url:activateClient_url,
							  data: dataString,
							  dataType: 'json',
								headers: {
								"AdminToken": admin_token
								},
							  cache: false,
							  success: function(report){
									var error = report.error;
									if (error==false){
									_addClientServiceChargeCollection(admin_token,project_client_id,collection_charges,collection_charges_type);
									_addClientServiceChargeDisbursement(admin_token,project_client_id,payout_charges,payout_charges_type);
										_activate_project_locally(project_id);
									}else{
										$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div>'+message+'').fadeIn(500).delay(5000).fadeOut(100);
									$('#activate-project-btn').html('<i class="fa fa-check"></i>  ACTIVATE PROJECT ');
									document.getElementById('activate-project-btn').disabled=false;
									}
							  }
						  });
									
				}else{
					return false;
				}
			}

}


function _addClientServiceChargeCollection(admin_token,project_client_id,collection_charges,collection_charges_type){
	var dataString ='clientID='+ project_client_id+'&price='+ collection_charges+'&type='+ collection_charges_type;
		  $.ajax({
			  type: "POST",
			  url:addClientServiceChargeCollection_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
				  
			  }
		  });
}
function _addClientServiceChargeDisbursement(admin_token,project_client_id,payout_charges,payout_charges_type){
	var dataString ='clientID='+ project_client_id+'&price='+ payout_charges+'&type='+ payout_charges_type;
		  $.ajax({
			  type: "POST",
			  url:addClientServiceChargeDisbursement_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
				  
			  }
		  });
}



function _activate_project_locally(project_id){
	var action ='activate_project';
	var collection_charges = $('#collection_charges').val();
	var collection_charges_type = $('#collection_charges_type').val();
	var payout_charges = $('#payout_charges').val();
	var payout_charges_type = $('#payout_charges_type').val();
					var dataString ='action='+ action+'&project_id='+ project_id+'&collection_charges='+ collection_charges+'&collection_charges_type='+ collection_charges_type+'&payout_charges='+ payout_charges+'&payout_charges_type='+ payout_charges_type;
					$.ajax({
					type: "POST",
					url: local_url,
					data: dataString,
					cache: false,
					success: function(html){
					$('#success-div').html('<div><i class="fa fa-check"></i></div>PROJECT ACTIVATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
					_get_page('projects', 'projects');
					alert_close();
						}
					});
}


function _delete_project(admin_token,project_id,project_client_id,user_id){
	if (confirm("Confirm!!\n\n Are you sure to DELETE THIS PROJECT?")){
					$('#delete-project-btn').html('DELETING...');
					document.getElementById('delete-project-btn').disabled=true;
	var dataString ='clientID='+ project_client_id;
		  $.ajax({
			  type: "POST",
			  url:deleteClient_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
					var error = report.error;
					if (error==false){
						_delete_project_locally(project_id,user_id);
					}else{
						$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div>'+message+'').fadeIn(500).delay(5000).fadeOut(100);
					$('#busness-suspend-btn').html('<i class="fa fa-check"></i>  SUSPEND ');
					document.getElementById('busness-suspend-btn').disabled=false;
					}
			  }
		  });
	}else{
					return false;
	}
}

function _delete_project_locally(project_id,user_id){
var action ='delete_project';
					var dataString ='action='+ action+'&project_id='+ project_id+'&user_id='+ user_id;
					$.ajax({
					type: "POST",
					url: local_url,
					data: dataString,
					cache: false,
					success: function(html){
					$('#success-div').html('<div><i class="fa fa-check"></i></div>PROJECT DELETED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
					_get_project_list('pending-project-btn','P');
					alert_close();
						}
					});
}






function _suspendClient(project_id,project_client_id,admin_token){
	if (confirm("Confirm!!\n\n Are you sure to SUSPEND THIS PROJECT?")){
					$('#busness-suspend-btn').html('SUSPENDING...');
					document.getElementById('busness-suspend-btn').disabled=true;
	var dataString ='clientID='+ project_client_id;
		  $.ajax({
			  type: "POST",
			  url:suspendClient_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
					var error = report.error;
					if (error==false){
						_suspend_project(project_id);
					}else{
						$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div>'+message+'').fadeIn(500).delay(5000).fadeOut(100);
					$('#busness-suspend-btn').html('<i class="fa fa-check"></i>  SUSPEND ');
					document.getElementById('busness-suspend-btn').disabled=false;
					}
			  }
		  });
	}else{
					return false;
	}
}



function _suspend_project(project_id){
				var action ='suspend_project';
					var dataString ='action='+ action+'&project_id='+ project_id;
					$.ajax({
					type: "POST",
					url: local_url,
					data: dataString,
					cache: false,
					success: function(html){
					$('#success-div').html('<div><i class="fa fa-check"></i></div>PROJECT SUSPENDED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
					_get_page('projects', 'projects');
					alert_close();
						}
					});
}





















































































































































































function _getCollectionSortTransactions(admin_token,status,clientID,startDate,endDate){
			var dataString ='status='+ status+'&clientID='+ clientID+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getCollectionSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  var trans_type = data[i].transactionType;
				  var trans_name = data[i].transactionTypeName;
				  var trans_type_number = data[i].transactionTypeNumber;
				  if (status=='Payer Debited'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+trans_type_number+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#loading').hide();
		  }
	  });
}


function get_collections_report(id,action,view_report){
		$('#srch-text').html($('#'+id).html());
		$('.custom-srch-div').fadeOut(500);
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;			  
				_getCollectionSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
	}

	
function _fetch_custom_collections_report(action,view_report){
		var datefrom=$('#datepicker-from').val();
		var dateto=$('#datepicker-to').val();
			if((datefrom=='')||(dateto=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Search Date Fields Empty<br /><span>Please fill all the feilds</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{		
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&datefrom='+datefrom+'&dateto='+dateto+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getCollectionSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
		
			}
};

function _fetch_custom_collections_report_status(admin_token){		
			var status=$('#status_id').val();
			var search_by = $('#search_by').val();
			var all_search_txt = $('#all_search_txt').val();
				var startDate=$('#search_start_date').val();
				var endDate=$('#search_end_date').val();
				var display_startDate=$('#display_start_date').val();
				var display_endDate=$('#display_end_date').val();
				
		$('.ajax-loader').toggle('slow');
				
			if (search_by==''){
				var client_id='';
				_getCollectionSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
			}else if(search_by=='CID'){
				var client_id=all_search_txt;
				_getCollectionSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
			}else if(search_by=='TREF'){
				var transactionReferrence=all_search_txt;
				getCollectionTransactionByReferrence(admin_token,transactionReferrence)
			}
		
};


function _getCollectionSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate){
			document.getElementById('search_start_date').value=startDate;
			  document.getElementById('search_end_date').value=endDate;
			  document.getElementById('display_start_date').value=display_startDate;
			  document.getElementById('display_end_date').value=display_endDate;

			var dataString ='status='+ status+'&clientID='+ client_id+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getCollectionSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN&nbsp;&nbsp;&nbsp;</td><td>DATE</td><td>CUST. NO.</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BAL AFTER</td><td>STATUS</td><td>REFERENCE</td><td>BAL BEFORE</td></tr>');
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  var trans_type = data[i].transactionType;
				  var trans_name = data[i].transactionTypeName;
				  var trans_type_number = data[i].transactionTypeNumber;
				  if (status=='Payer Debited'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+trans_type_number+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_before+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#startDate').html(display_startDate);
				$('#endDate').html(display_endDate);
		  }
	  });
}


function getCollectionTransactionByReferrence(admin_token,transactionReferrence){
		var dataString ='transactionReferrence='+ transactionReferrence;
	  $.ajax({
		  type: "GET",
		  url:getCollectionTransactionByReferrence_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN&nbsp;&nbsp;&nbsp;</td><td>DATE</td><td>CUST. NO.</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BAL AFTER</td><td>STATUS</td><td>REFERENCE</td><td>BAL BEFORE</td></tr>');
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  var trans_type = data[i].transactionType;
				  var trans_name = data[i].transactionTypeName;
				  var trans_type_number = data[i].transactionTypeNumber;
				  if (status=='Payer Debited'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+trans_type_number+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_before+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
		  }
		});
};




























































function _getDisbursementSortTransactions(admin_token,status,clientID,startDate,endDate){
			var dataString ='status='+ status+'&clientID='+ clientID+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_before+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#loading').hide();
		  }
	  });
}


function get_payout_report(id,action,view_report){
		$('#srch-text').html($('#'+id).html());
		$('.custom-srch-div').fadeOut(500);
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;			  
				_getDisbursementSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
	}

	
function _fetch_custom_payout_report(action,view_report){
		var datefrom=$('#datepicker-from').val();
		var dateto=$('#datepicker-to').val();
			if((datefrom=='')||(dateto=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Search Date Fields Empty<br /><span>Please fill all the feilds</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{		
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&datefrom='+datefrom+'&dateto='+dateto+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getDisbursementSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
		
			}
};

function _fetch_custom_payout_report_status(admin_token){		
			var status=$('#status_id').val();
			var search_by = $('#search_by').val();
			var all_search_txt = $('#all_search_txt').val();
				var startDate=$('#search_start_date').val();
				var endDate=$('#search_end_date').val();
				var display_startDate=$('#display_start_date').val();
				var display_endDate=$('#display_end_date').val();
				
		$('.ajax-loader').toggle('slow');
				
			if (search_by==''){
				var client_id='';
				_getDisbursementSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
			}else if(search_by=='CID'){
				var client_id=all_search_txt;
				_getDisbursementSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate)
			}else if(search_by=='TREF'){
				var transactionReferrence=all_search_txt;
				getDisbursementTransactionByReferrence(admin_token,transactionReferrence)
			}
		
};


function _getDisbursementSortTransactions_by_auto_date_search(admin_token,client_id,status,startDate,endDate,display_startDate,display_endDate){
			document.getElementById('search_start_date').value=startDate;
			  document.getElementById('search_end_date').value=endDate;
			  document.getElementById('display_start_date').value=display_startDate;
			  document.getElementById('display_end_date').value=display_endDate;

			var dataString ='status='+ status+'&clientID='+ client_id+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BAL BEFORE</td><td>STATUS</td><td>NARRATION</td><td>REFERENCE</td><td>BAL AFTER</td></tr>');
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_before+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#startDate').html(display_startDate);
				$('#endDate').html(display_endDate);
		  }
	  });
}


function getDisbursementTransactionByReferrence(admin_token,transactionReferrence){
		var dataString ='transactionReferrence='+ transactionReferrence;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementTransactionByReferrence_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BAL BEFORE</td><td>STATUS</td><td>NARRATION</td><td>REFERENCE</td><td>BAL AFTER</td></tr>');
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var client_id = data[i].clientID;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var currency = data[i].currency;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_before+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td><td>'+balance_after+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
		  }
		});
};











































































function _getTransferSortTransactions(admin_token,status,client_id,transactionType,startDate,endDate){
			var dataString ='status='+ status+'&clientID='+ client_id+'&transactionType='+ transactionType+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getTransferSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var amount = data[i].amount;
				  var status = data[i].status;
				  var type = data[i].transactionType;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+amount+'</td><td>'+type+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#loading').hide();
		  }
	  });
}










function get_transfer_report(id,action,view_report){
		$('#srch-text').html($('#'+id).html());
		$('.custom-srch-div').fadeOut(500);
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
				var transactionType=$('#trans_type').val();
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;			  
			  
				_getTransferSortTransactions_by_auto_date_search(admin_token,status,client_id,transactionType,startDate,endDate,display_startDate,display_endDate)
				}
		});
	}






function _getTransferSortTransactions_by_auto_date_search(admin_token,status,client_id,transactionType,startDate,endDate,display_startDate,display_endDate){
			document.getElementById('search_start_date').value=startDate;
			  document.getElementById('search_end_date').value=endDate;
			  document.getElementById('display_start_date').value=display_startDate;
			  document.getElementById('display_end_date').value=display_endDate;

			var dataString ='clientID='+ client_id+'&status='+ status+'&transactionType='+ transactionType+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getTransferSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AdminToken": admin_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>AMOUNT</td><td>TYPE</td><td>STATUS</td><td>NARRATION</td><td>REFERENCE</td></tr>');

			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var amount = data[i].amount;
				  var status = data[i].status;
				  var type = data[i].transactionType;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else if (status=='Inprogress'){
					  status='PENDING';
					   var style='PENDING'
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=Number(total_amount)+Number(amount);

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+amount+'</td><td>'+type+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
				$('#loading').hide();
				$('#startDate').html(display_startDate);
				$('#endDate').html(display_endDate);
			  }
		  }
	  });
}








function _fetch_custom_transfer_report(action,view_report){
		var datefrom=$('#datepicker-from').val();
		var dateto=$('#datepicker-to').val();
			if((datefrom=='')||(dateto=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Search Date Fields Empty<br /><span>Please fill all the feilds</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{		
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&datefrom='+datefrom+'&dateto='+dateto+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var admin_token = data.admin_token;
				var client_id='';
				var status=$('#status_id').val();;
				var transactionType=$('#trans_type').val();
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
			  
				_getTransferSortTransactions_by_auto_date_search(admin_token,status,client_id,transactionType,startDate,endDate,display_startDate,display_endDate)
				}
		});
		
			}
};
























function exportTableToExcel(tableID,filename){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20').replace(/#/g, '%23');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
   
    // Create download link element
    downloadLink = document.createElement("a");
   
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click();
    }
}

















































function _toggle(div_id){
	$('#'+div_id).toggle('slow');
}

function _update_client_wallet(admin_token,project_id,project_client_id){
		var type=$('#update_wallet_type').val();
		var amount=$('#update_wallet_amount').val();
		var narration=$('#update_wallet_narration').val();
			if((update_wallet_type=='')||(update_wallet_amount=='')||(narration=='')||(update_wallet_amount<=0)){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Error!<br /><span>Check The Parameters And try Again</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{		
		if (confirm("Confirm!!\n\n Are you sure to UPDATE THIS WALLET?")){
					$('#update-wallet-btn').html('UPDATING...');
					document.getElementById('update-wallet-btn').disabled=true;
	var dataString ='clientID='+ project_client_id+'&type='+type+'&amount='+amount+'&message='+narration;
		  $.ajax({
			  type: "POST",
			  url:updateClientWallet_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AdminToken": admin_token
				},
			  cache: false,
			  success: function(report){
					var error = report.error;
					if (error==false){
						$('#update-wallet-div').hide();
						_get_collection_setup('project-setup','project-setup-btn',project_id);
					$('#success-div').html('<div><i class="fa fa-check"></i></div>CLIENT WALLET UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
					}else{
						$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div>'+message+'').fadeIn(500).delay(5000).fadeOut(100);
					$('#update-wallet-btn').html('<i class="fa fa-check"></i>  UPDATE WALLET ');
					document.getElementById('update-wallet-btn').disabled=false;
					}
			  }
		  });
	}else{
					return false;
	}
			}
}






