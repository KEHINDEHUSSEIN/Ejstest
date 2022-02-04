//////////////////////////////13/8/2019////////////////////////// by Afolabi Oluwagbnega Sunday
jQuery(document).ready(function() {
    $.backstretch(["all-images/images/bg.jpg"],{duration: 4000, fade: 2000});
    });




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


$(document).ready(function() {
		//window.setInterval(function(){
		//	get_notification_number();
		//},3000);
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




function _toggle_profile_pix_div(){
	   $('.toggle-profile-div').toggle('slow');
}




function _get_project_status(proj_status){
			var action ='get_access_token_for_status'
			var dataString ='action='+ action+'&proj_status='+ proj_status;
			$.ajax({
				type: "POST",
				url: local_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var access_token = data.access_token;
					_activate_suspend_Account(proj_status,access_token);
				}
			});
}

function _activate_suspend_Account(proj_status,access_token){
			var dataString ='access_token='+ access_token;
			if (proj_status=='closed'){
				var url=suspendAccount_url;
			}else{
				var url=activateAccount_url;
			}
	  $.ajax({
		  type: "POST",
		  url:url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			if (proj_status=='closed'){
				$('.project-status').html('<div class="status close" onclick="_get_project_status('+proj_status+')"><div class="text animated fadeInRight animated animated">CLOSED</div> <div class="signal animated fadeInLeft animated animated"></div></div>');
			}else{
				$('.project-status').html('<div class="status" onclick="_get_project_status('+proj_status+')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">LIVE</div></div>');
			}
		  }
	  });
}

function alert_close(){
		$('#get-more-div').html('').fadeOut(200);
}



function _get_active_link(divid){
		 $('#sdashboard, #sprojects').removeClass('active-li');
		 $('#dashboard, #projects,#payout,#collections').removeClass('active-li');
		 $('#'+divid).addClass('active-li');
		 $('#s'+divid).addClass('active-li');
		 $('#page-title').html($('#_'+divid).html());
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










//////////////// login to endpoint/////////////////////////

function _login_and_get_access_token_to_session(project_email,project_password){
			var dataString ='user='+ project_email+'&password='+ project_password;
			$.ajax({
				type: "POST",
				url:login_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var error = data.error;
					var access_token = data.accessToken;
					var message = data.message;
					if (error==false){
						_get_access_token_to_session(access_token);
					}else{
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> yes!!! '+message+'').fadeIn(500).delay(5000).fadeOut(100);
					}
				}
			});
}


function _get_access_token_to_session(access_token){
		var action='get_access_token_to_session';
		var dataString ='action='+ action+'&access_token='+ access_token;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
		_get_dashboard_trend(access_token);
		}
		});
}
















//////////////// for dashboard trend
function _get_dashboard_trend(access_token){
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
		_countCollectionsPerDays(access_token,startDate,endDate,display_startDate,display_endDate);
		}
		});
}

function _countCollectionsPerDays(access_token,startDate,endDate,display_startDate,display_endDate){
			var status='Payer Debited';
			var dataString ='status='+ status+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:countCollectionsPerDays_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  var grandAmount=0;
			  var trend ='';
			  if (error==false){
				for (var i = 0; i < data.length; i++) {
				  var day = data[i].day;
				  var totalAmount = data[i].totalAmount;

						trans_date = new Date(day)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth();
						ToDay=trans_date.getDate();
					trend +='{ x: new Date('+ToYear+', '+ToMonth+', '+ToDay+'), y: '+totalAmount +'},';
					grandAmount=grandAmount + totalAmount;
				}
				_chart_for_trend(trend,grandAmount,display_startDate,display_endDate);
			  }
		  }
	  });
}


function _chart_for_trend(trend,grandAmount,display_startDate,display_endDate){
	var action='trendbarchart';
	var dataString ='action='+ action+'&trend='+ trend+'&grandAmount='+ grandAmount+'&display_startDate='+ display_startDate+'&display_endDate='+ display_endDate;
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



















//////////////////////////////// get all value form mongo db///////////////////////

function _get_wallet_balance(access_token){
	var dataString='';
		  $.ajax({
			  type: "GET",
			  url:getWalletBalance_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AccessToken": access_token
				},
			  cache: false,
			  success: function(report){
				  var error = report.error;
				  var data = report.data;
				$('#available_balance').html(data.wallet.toLocaleString());
				$('#myWallet_form').html(data.wallet.toLocaleString());
			  }
		  });
}





function _get_collection_data(access_token){
	var dataString='';
		  $.ajax({
			  type: "GET",
			  url:getCollectionData_url,
			  data: dataString,
			  dataType: 'json',
				headers: {
				"AccessToken": access_token
				},
			  cache: false,
			  success: function(report){
				  var error = report.error;
				  var data = report.data;
				$('#project_currency_dashboard').html(data.currencyName);
				$('#project_currency_side').html(data.currencyName);
				$('#project_currency_form').html(data.currencyName);
			  }
		  });
}




function _call_countCollections(access_token){
	var dataString ='';
		$.ajax({
		type: "GET",
		url: countCollections_url,
		data: dataString,
		dataType: 'json',
		headers: {
		"AccessToken": access_token,
		},
		cache: false,
		success: function(report){
				  var error = report.error;
				  var data = report.data;
				var success =data.success;
				var pending =data.pending;
				var failed =data.failed;
				_chart_for_pie(success,pending,failed);
		}
		});
}

function _chart_for_pie(success,pending,failed){
	var action='chat_for_pie';
	var dataString ='action='+ action+'&success='+success+'&pending='+pending+'&failed='+failed;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#chart-for-pie').html(html);
		}
		});
}


























/////////////////////////////////////////all report/////////////////////////////////////
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
		$('.ajax-loader').toggle('slow');
			var dataString ='action='+ action+'&view_report='+ view_report;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
		    dataType: 'json',
			cache: false,
			success: function(data){
			  var access_token = data.access_token;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_countCollectionsPerDays(access_token,startDate,endDate,display_startDate,display_endDate);
				}
		});
	}
	
	

function _fetch_custom_dashboard_report(action,view_report){
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
			  var access_token = data.access_token;
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_countCollectionsPerDays(access_token,startDate,endDate,display_startDate,display_endDate);
				}
		});
		
			}
};
























function _request_for_payout(country_alias,bank_id,account_number,payout_type_id,access_token,payout_type){
			var pay_out_amount = $('#pay_out_amount').val();
			var payment_naration = $('#payment_naration').val();
			var username = $('#api-demo-pry').val();
			var password = $('#api-demo-sec').val();
  if((pay_out_amount=='')||(pay_out_amount<0)||(payment_naration=='')){
	  $('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
  }else{
	  if (confirm("Confirm!!\n\n Are you sure to PAY OUT?")){
		  $('#request-payout-btn').html('PROCESSING...');
		  document.getElementById('request-payout-btn').disabled=true;
		  if (payout_type_id=='bank'){
			  var _url=disburseBankTransaction_url;
		  var dataString ='payeeCountry='+ country_alias+'&payeeBankCode='+ bank_id+'&payeeAccount='+ account_number+'&amount='+ pay_out_amount+'&message='+ payment_naration+'&type='+ payout_type;
		  }else{
			  var _url=disburseMomoTransaction_url;
		  var dataString ='payeeCountry='+ country_alias+'&momo='+ bank_id+'&payeeAccount='+ account_number+'&amount='+ pay_out_amount+'&message='+ payment_naration+'&type='+ payout_type;
		  }
	  $.ajax({
		  type: "POST",
		  url:_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		   "Authorization": "Basic " + btoa(username + ":" + password),
		   "Content-Type": "application/x-www-form-urlencoded"
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var message = report.message;
			if (error==false){
					$('#success-div').html('<div><i class="fa fa-check"></i></div> PAYOUT REQUSEST SENT SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
					alert_close();
					_get_wallet_balance(access_token);
					_get_collection_data(access_token);
			}else{
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
				  $('#request-payout-btn').html('<i class="fa fa-check"></i>  REQUEST FOR PAYOUT');
				  document.getElementById('request-payout-btn').disabled=false;
			}
		  }
	  });
				}else{
					return false;
				}
			}
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
			var phone = $('#phoneno').val();
			if((fullname=='')||(email=='')||(phone=='')){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
			if (confirm("Confirm!!\n\n Are you sure to UPDATE?")){
		$('#update-user-btn').html('Updating...');
			document.getElementById('update-user-btn').disabled=true;
			var action ='update_users_profile';
			var dataString ='action='+ action+'&user_id='+ user_id+'&fullname='+ fullname+'&email='+ email+'&phone='+ phone;
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












function _create_project(){
			var project_name = $('#project_name').val();
			var project_phone = $('#project_phone').val();
			var project_email = $('#project_email').val();
			
			var country = $('#country').val();
			var country_code=country.substr(0,country.indexOf("|"));
			var country_name=country.substr(country.indexOf("|")+1);
			if((project_name=='')||(project_phone=='')||(project_email=='')||(country=='')||(project_email.indexOf('@')<=0)){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				if (confirm("Confirm!!\n\n Are you sure to CREATE THIS PROJECT?")){
					$('#create-project-btn').html('PROCESSING...');
					document.getElementById('create-project-btn').disabled=true;
					var dataString ='name='+ project_name+'&mobileNumber='+ project_phone+'&email='+ project_email+'&countryCode='+ country_code+'&country='+ country_name+'&password='+ project_password;
						$.ajax({
							type: "POST",
							url:register_url,
							data: dataString,
							dataType: 'json',
							cache: false,
							success: function(data){
								var error = data.error;
								var message = data.message;
								if (error==false){
								_get_otp_sent_to_email_to_verify(); 
								}else{
										$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
										$('#create-project-btn').html('<i class="fa fa-check"></i> CREATE PROJECT');
											document.getElementById('create-project-btn').disabled=false;
								}
							}
						});
				}else{
					return false;
				}
			}
}

function _create_paymentlink(){
	var paymentlink_name = $('#paymentlink_name').val();
	var paymentlink_description = $('#paymentlink_description').val();
	var paymentlink_type = $('#paymentlink_type').val();
	var paymentlink_custom = $('#paymentlink_custom').val();
	var paymentlink_post = $('#paymentlink_post').val();
	var paymentlink_succesMessage = $('#paymentlink_succesMessage').val();
	var paymentlink_notification = $('#paymentlink_notification').val();
	var paymentlink_addinformation = $('#paymentlink_addinformation').val(); 
	
	
	if((paymentlink_name=='')){
$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
	}else{
		if (confirm("Confirm!!\n\n Are you sure to CREATE THIS PAYMENT LINK?")){
			$('#create-paymentlink-btn').html('PROCESSING...');
			document.getElementById('create-paymentlink-btn').disabled=true;
			var dataString ='name='+ paymentlink_name+'&paymentlink_description='+ paymentlink_description+'&paymentlink_type='+ paymentlink_type+'&paymentlink_custom='+ paymentlink_custom+'&paymentlink_post='+ paymentlink_post+'&paymentlink_succesMessage='+ paymentlink_succesMessage+'&paymentlink_notification='+ paymentlink_notification+'&paymentlink_addinformation='+ paymentlink_addinformation;
				$.ajax({
					type: "POST",
					url:register_url,
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(data){
						var error = data.error;
						var message = data.message;
						if (error==false){
						_get_otp_sent_to_email_to_verify(); 
						}else{
								$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
								$('#create-project-btn').html('<i class="fa fa-check"></i> CREATE PROJECT');
									document.getElementById('create-project-btn').disabled=false;
						}
					}
				});
		}else{
			return false;
		}
	}
}

function _get_otp_sent_to_email_to_verify(){ 
			var project_name = $('#project_name').val();
			var project_phone = $('#project_phone').val();
			var project_email = $('#project_email').val();
			
			var country = $('#country').val();
			var country_code=country.substr(0,country.indexOf("|"));
			var country_name=country.substr(country.indexOf("|")+1);
			var project_password = 'ddp_pass';
		var action='get_otp_sent_to_email_to_verify';
		$('#get-form-content').html('<div class="ajax-loader">Sending OTP...<br><img src="all-images/images/ajax-loader.gif"/></div>');
			var dataString ='action='+ action+'&project_name='+ project_name+'&project_phone='+ project_phone+'&project_email='+ project_email+'&country_code='+ country_code+'&country_name='+ country_name+'&project_password='+ project_password;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
		$("#get-form-content").html(html);
		}
		});
}



function _verify_otp(project_id,project_email,project_password,project_name){ 
		var project_otp = $('#project_otp').val();
			$('#verify-otp-btn').html('VERIFYING...');
			document.getElementById('verify-otp-btn').disabled=true;
			var dataString ='user='+ project_email+'&otp='+ project_otp;
			$.ajax({
				type: "POST",
				url:verifyEmail_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var error = data.error;
					var message = data.error;
					if (error==false){
					_first_login_project(project_id,project_email,project_password,project_name); //// insert to projects_tab and login
					}else{
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> INVALID OTP!').fadeIn(500).delay(5000).fadeOut(100);
							$('#verify-otp-btn').html('<i class="fa fa-check"></i> CREATE PROJECT');
								document.getElementById('verify-otp-btn').disabled=false;
					}
				}
			});
}


function _resend_otp(ids,project_email){
				var btn_text=$('#'+ids).html();
				$('#'+ids).html('SENDING...');
		var dataString ='user='+ project_email;
		$.ajax({
				type: "POST",
				url:resentOTP_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var error = data.error;
					var message = data.error;
					if (error==false){
					$('#success-div').html('<div><i class="fa fa-check"></i></div> OTP SENT!<br /><span>Check your email inbox or spam</span>').fadeIn(500).delay(5000).fadeOut(100);
					$('#'+ids).html(btn_text);
					}else{
					$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
					$('#'+ids).html(btn_text);
					}
				}
		});
}






function _first_login_project(project_id,project_email,project_password,project_name){
			var dataString ='user='+ project_email+'&password='+ project_password;
			$.ajax({
				type: "POST",
				url:login_url,
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var error = data.error;
					var access_token = data.accessToken;
					var message = data.message;
					if (error==false){
						_get_profile(project_id,access_token,project_name);
					}else{
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
							$('#verify-otp-btn').html('<i class="fa fa-check"></i> CREATE PROJECT');
							document.getElementById('verify-otp-btn').disabled=false;
					}
				}
			});
}
function _get_profile(project_id,access_token,project_name){
			var dataString ='';
			$.ajax({
				type: "GET",
				url:getProfile_url,
				data: dataString,
				dataType: 'json',
				headers: {
				"AccessToken": access_token,
				},
				cache: false,
				success: function(report){
					var error = report.error;
					var data = report.data;
					 var project_client_id = data.clientID; 
					_send_access_token_to_session(project_id,project_client_id,access_token,project_name);
				}
			});
}



function _send_access_token_to_session(project_id,project_client_id,access_token,project_name){
		var action='first_login_success';
		var dataString ='action='+ action+'&project_id='+ project_id+'&project_client_id='+ project_client_id+'&access_token='+ access_token;
		$.ajax({
		  type: "POST",
		  url:local_url,
		  data: dataString,
		  dataType: 'json',
		  cache: false,
		  success: function(data){
					var country_alias = data.country_alias;
					var access_token = data.access_token;
					_set_collection_data(access_token,country_alias,project_name);
		}
		});
}




function _set_collection_data(access_token,country_alias,project_name){
			var dataString ='countryCode='+ country_alias;
			$.ajax({
				type: "POST",
				url:setCollectionData_url,
				data: dataString,
				dataType: 'json',
				headers: {
				"AccessToken": access_token,
				"Content-Type": "application/x-www-form-urlencoded"
				},
				cache: false,
				success: function(data){
					var error = data.error;
					var message = data.message;
					if (error==false){
					$('#success-div').html('<div><i class="fa fa-check"></i></div> PROJECT CREATED SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
					 alert_close();
					 $('#project-title-div').html(project_name);
					_get_page('dashboard', 'dashboard');
					}else{
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
					}
				}
			});
}

































function _update_project(country_code,country_name,access_token){
			var project_name = $('#project_name').val();
			var project_phone = $('#project_phone').val();
			var project_email = $('#project_email').val();
			
			if((project_name=='')||(project_phone=='')||(project_email=='')||(project_email.indexOf('@')<=0)){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				if (confirm("Confirm!!\n\n Are you sure to UPDATE THIS PROJECT?")){
					$('#update-project-btn').html('PROCESSING...');
					document.getElementById('update-project-btn').disabled=true;
					var dataString ='name='+ project_name+'&mobileNumber='+ project_phone+'&email='+ project_email+'&countryCode='+ country_code+'&country='+ country_name;
						$.ajax({
							type: "POST",
							url:editProfile_url,
							data: dataString,
							dataType: 'json',
							headers: {
							"AccessToken": access_token
							},
							cache: false,
							success: function(data){
								var error = data.error;
								var message = data.message;
								if (error==false){
								_update_project_profile_locally();
								}else{
										$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> '+message+'').fadeIn(500).delay(5000).fadeOut(100);
										$('#update-project-btn').html('<i class="fa fa-check"></i> UPDATE PROJECT');
											document.getElementById('update-project-btn').disabled=false;
								}
							}
						});
				}else{
					return false;
				}
			}
}



function _update_project_profile_locally(){ 
			var project_name = $('#project_name').val();
			var project_phone = $('#project_phone').val();
			var project_email = $('#project_email').val();
			
		var action='update_project_profile_locally';
			var dataString ='action='+ action+'&project_name='+ project_name+'&project_phone='+ project_phone+'&project_email='+ project_email;
		$.ajax({
		type: "POST",
		url: local_url,
		data: dataString,
		cache: false,
		success: function(html){
		$('#success-div').html('<div><i class="fa fa-check"></i></div> PROJECT UPDATED').fadeIn(500).delay(5000).fadeOut(100);
		$('#update-project-btn').html('<i class="fa fa-check"></i> UPDATE PROJECT');
			document.getElementById('update-project-btn').disabled=false;
		}
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


function _payout_type(access_token){
		var payout_type_id = $('#payout_type_id').val();
		 $('#payout-momo,#payout-bank').hide();
		 $('#payout-'+payout_type_id).fadeIn(500);
		 if (payout_type_id=='momo'){
			$('#momo_id').html('');
			$('#momo_number').val('');
			 _getAllMomo(access_token);
		 }else{
			$('#bank_id').html('');
			$('#account_number').val('');
			$('#account_name').hide();
			 _getAllBank(access_token);
		 }
}



function _getAllMomo(access_token){
	var dataString='';
	  $.ajax({
		  type: "GET",
		  url:getAllMomo_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  for (var i = 0; i < data.length; i++) {
					  var select = document.getElementById("momo_id");
					  var option = document.createElement("option");
					  option.text = data[i].momoName;
					  option.value = data[i].momoCode+'|'+data[i].momoName;
					  select.add(option);
				  }					
			  }
		  }
	  });
}

function _getAllBank(access_token){
	var dataString='';
	  $.ajax({
		  type: "GET",
		  url:getAllBank_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  for (var i = 0; i < data.length; i++) {
					  var select = document.getElementById("bank_id");
					  var option = document.createElement("option");
					  option.text = data[i].name;
					  option.value = data[i].code+'|'+data[i].name;
					  select.add(option);
				  }					
			  }
		  }
	  });
}




function _get_account_name(){
	var account_number = $('#account_number').val()
	var bank = $('#bank_id').val();
	  var bank_id=bank.substr(0,bank.indexOf("|"));
	  var bank_name=bank.substr(bank.indexOf("|")+1);
	if(account_number.length < 10){
		$('#account_name').fadeOut(100);
	}else{
		$('#account_name').fadeIn(100).val('FETCHING ACCOUNT NAME...');
			var dataString ='account_number='+ account_number+'&bank_code='+ bank_id;
		  $.ajax({
			  type: "GET",
			  url:verifyAccountNumber_url,
			  data: dataString,
			  dataType: 'json',
			  cache: false,
			  success: function(report){
				  var status = report.status;
				  var data = report.data;
				  if (status==true){
							document.getElementById('account_name').value = data.account_name;
				  }else{
					 $('#account_name').fadeOut(100).val('') 
				  }
			  }
		  });
	}
	
}




function _save_payout(payout_type){
	if (payout_type=='momo'){
		_call_save_momo_payout();
	}else{
		_call_save_bank_payout();
	}
}

function _call_save_momo_payout(){
	var payout_type_id = $('#payout_type_id').val();
	var momo = $('#momo_id').val();
	  var momo_id=momo.substr(0,momo.indexOf("|"));
	  var momo_name=momo.substr(momo.indexOf("|")+1);
	var momo_number = $('#momo_number').val();
			if((payout_type_id=='')||(momo_id=='')||(momo_number=='')){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				if (confirm("Confirm!!\n\n Have you confirm all MoMo DATA?")){
					$('#save-momo-payout-btn').html('SAVING...');
					document.getElementById('save-momo-payout-btn').disabled=true;
					var action='save_momo_payout';
						var dataString ='action='+ action+'&payout_type_id='+ payout_type_id+'&momo_id='+ momo_id+'&momo_name='+ momo_name+'&momo_number='+ momo_number;
						$.ajax({
						type: "POST",
						url: local_url,
						data: dataString,
						cache: false,
						success: function(html){
								$('#success-div').html('<div><i class="fa fa-check"></i></div> PAYOUT SAVED SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
								$('#save-momo-payout-btn').html('<i class="fa fa-save"></i>  SAVE');
								document.getElementById('save-momo-payout-btn').disabled=false;
							}
						});
				}
			}
}


function _call_save_bank_payout(){
	var payout_type_id = $('#payout_type_id').val();
	var bank = $('#bank_id').val();
	  var bank_id=bank.substr(0,bank.indexOf("|"));
	  var bank_name=bank.substr(bank.indexOf("|")+1);
	var account_number = $('#account_number').val();
	var account_name = $('#account_name').val();
		if((payout_type_id=='')||(bank_id=='')||(account_number=='')||(account_name=='')){
		$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Necessary Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				if (confirm("Confirm!!\n\n Have you confirm all BANK DATA?")){
				$('#save-bank-payout-btn').html('SAVING...');
				document.getElementById('save-bank-payout-btn').disabled=true;
				var action='save_bank_payout';
					var dataString ='action='+ action+'&payout_type_id='+ payout_type_id+'&bank_id='+ bank_id+'&bank_name='+ bank_name+'&account_number='+ account_number+'&account_name='+ account_name;
					$.ajax({
					type: "POST",
					url: local_url,
					data: dataString,
					cache: false,
					success: function(html){
							$('#success-div').html('<div><i class="fa fa-check"></i></div> PAYOUT SAVED SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
							$('#save-bank-payout-btn').html('<i class="fa fa-save"></i>  SAVE');
							document.getElementById('save-bank-payout-btn').disabled=false;
						}
					});
				}
			}
}









function _request_for_business_activation(){
	var action ='request_for_business_activation';
			var business_number = $('#business_number').val();
			var up_file = $('#up_note').val();
       		var up_note = $('#up_note').prop('files')[0];
		if((up_file=='')||(business_number=='')){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				if (confirm("Confirm!!\n\n Have you confirmed all DATA?")){
							var form_data = new FormData();                  
							form_data.append('action', action);
							form_data.append('business_number', business_number);
							form_data.append('up_note', up_note);
							form_data.append('up_file', up_file);
							$.ajax({
								url: local_url,
								type: "POST",
								data: form_data,
								contentType: false,
								cache: false,
								processData:false,
								success: function(html){
										$('#success-div').html('<div><i class="fa fa-check"></i></div> REQUEST FOR ACTIVATION SENT SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
										 alert_close();
										_get_activate_project_pane('dashboard');
									}
							});
				}else{
						return false;
				}

		}

}



















function _get_api_key(access_token,div_id){
	if (div_id=='livekey'){
		var x = document.getElementById("livekey");
		  if (x.innerHTML === '<i class="fa fa-plus"></i>') {
			x.innerHTML = '<i class="fa fa-minus"></i>';
		  } else {
			x.innerHTML = '<i class="fa fa-plus"></i></i>';
		  }
			   $('#expand-livekey').toggle('slow');
				var url=getLiveKey_url;
	}else{
		var x = document.getElementById("demokey");
		  if (x.innerHTML === '<i class="fa fa-plus"></i>') {
			x.innerHTML = '<i class="fa fa-minus"></i>';
		  } else {
			x.innerHTML = '<i class="fa fa-plus"></i></i>';
		  }
			   $('#expand-demokey').toggle('slow');
				var url=getDemoKey_url;
	}
	var dataString='';
	  $.ajax({
		  type: "GET",
		  url:url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			if (div_id=='livekey'){
		  document.getElementById('api-live-pry').value = data.primaryKey;
		  document.getElementById('api-live-sec').value = data.secondaryKey;
			}else{
		  document.getElementById('api-demo-pry').value = data.primaryKey;
		  document.getElementById('api-demo-sec').value = data.secondaryKey;
			}
		  }
	  });
}

function _get_api_key_disbusment(access_token,div_id){
	if (div_id=='livekey'){
				var url=getLiveKey_url;
	}else{
			var url=getDemoKey_url;
	}
	var dataString='';
	  $.ajax({
		  type: "GET",
		  url:url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
			if (div_id=='livekey'){
		  document.getElementById('api-live-pry').value = data.primaryKey;
		  document.getElementById('api-live-sec').value = data.secondaryKey;
			}else{
		  document.getElementById('api-demo-pry').value = data.primaryKey;
		  document.getElementById('api-demo-sec').value = data.secondaryKey;
			}
		  }
	  });
}
 
 

function _refresh_api_key(access_token){
				if (confirm("Confirm!!\n\n Are you sure to REFRESH YOUR LIVE KEY?")){
					$('#refresh-api-key-btn').html('REFRESHING...');
					document.getElementById('refresh-api-key-btn').disabled=true;
	var dataString='';
	  $.ajax({
		  type: "GET",
		  url:refreshLiveKey_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  var error = report.error;
			  var data = report.data;
		  document.getElementById('api-live-pry').value = data.primaryKey;
		  document.getElementById('api-live-sec').value = data.secondaryKey;
					$('#refresh-api-key-btn').html('<i class="fa fa-refresh"></i>  REFRESH');
					document.getElementById('refresh-api-key-btn').disabled=false;
					$('#success-div').html('<div><i class="fa fa-check"></i></div> API LIVE KEY REFRESHED SUCCESSFULLY!').fadeIn(500).delay(5000).fadeOut(100);
		  }
	  });
				}else{
					return false;
				}
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

function _switch_to_project(project_id,project_name,username,password){
		$('#search-content').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var action='switch_to_project';
			var dataString ='action='+ action+'&project_id='+ project_id;
			$.ajax({
			type: "POST",
			url: local_url,
			data: dataString,
			cache: false,
			success: function(html){
				_login_and_get_access_token_to_session(username,password);
				$('#search-content').html(html);
				$('#success-div').html('<div><i class="fa fa-check"></i></div> PROJECT SWITCH SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
				$('#project-title-div').html(project_name);
				}
			});
}





































function _getCollectionSortTransactions(access_token,status,startDate,endDate){
			var dataString ='status='+ status+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getCollectionSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
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
				  var transactionTypeNumber = data[i].transactionTypeNumber;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
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
				  
				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+transactionTypeNumber+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#payout-loading').hide();
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
			  var access_token = data.access_token;
				var status='';
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getCollectionSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate)
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
			  var access_token = data.access_token;
				var status='';
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getCollectionSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
		
			}
};



function _getCollectionSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate){
			var dataString ='status='+ status+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getCollectionSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>MOBILE NUMBER</td><td>BALANCE BEFORE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BALANCE AFTER</td><td>STATUS</td><td>NARRATION</td><td>REFERENCE</td></tr>');

			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var transactionTypeNumber = data[i].transactionTypeNumber;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
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
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+transactionTypeNumber+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Collected = <span>'+total_amount+'</span></div></td></tr>');
				$('#startDate').html(display_startDate);
				$('#endDate').html(display_endDate);
			  }
		  }
	  });
}



function getCollectionTransactionByReferrence(access_token){
			var all_search_txt = $('#all_search_txt').val();
			$('.ajax-loader').toggle('slow');

		var dataString ='transactionReferrence='+ all_search_txt;
	  $.ajax({
		  type: "GET",
		  url:getCollectionTransactionByReferrence_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>MOBILE NUMBER</td><td>BALANCE BEFORE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BALANCE AFTER</td><td>STATUS</td><td>NARRATION</td><td>REFERENCE</td></tr>');

			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var transactionTypeNumber = data[i].transactionTypeNumber;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
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
						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+transactionTypeNumber+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
			  }
			  			  		$('.ajax-loader').hide();

		  }
	  });

}




































































function _getDisbursementSortTransactions(access_token,status,startDate,endDate){
			var dataString ='status='+ status+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
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
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var type = data[i].disbursementType;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=total_amount+amount;

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+type+'</td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Disbursed = <span>'+total_amount+'</span></div></td></tr>');
			  }
				$('#payout-loading').hide();
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
			  var access_token = data.access_token;
				var status='';
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getDisbursementSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate)
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
			  var access_token = data.access_token;
				var status='';
			  var startDate = data.startDate;
			  var endDate = data.endDate;
			  var display_startDate = data.display_startDate;
			  var display_endDate = data.display_endDate;
				_getDisbursementSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate)
				}
		});
		
			}
};



function _getDisbursementSortTransactions_by_auto_date_search(access_token,status,startDate,endDate,display_startDate,display_endDate){
			var dataString ='status='+ status+'&startDate='+ startDate+'&endDate='+ endDate;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementSortTransactions_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('.ajax-loader').hide();
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>BALANCE BEFORE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BALANCE AFTER</td><td>STATUS</td><td>PAYOUT TYPE</td><td>NARRATION</td><td>REFERENCE</td></tr>');

			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var type = data[i].disbursementType;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
				  total_amount=total_amount+amount;

						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+type+'</td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
				$('#transaction-table').append('<tr><td colspan="20"><div class="alert alert-success"> <span><i class="fa fa-check"></i></span> The Total Amount Disbursed = <span>'+total_amount+'</span></div></td></tr>');
				$('#startDate').html(display_startDate);
				$('#endDate').html(display_endDate);
			  }
		  }
	  });
}



function getDisbursementTransactionByReferrence(access_token){
			var all_search_txt = $('#all_search_txt').val();
			$('.ajax-loader').toggle('slow');

		var dataString ='transactionReferrence='+ all_search_txt;
	  $.ajax({
		  type: "GET",
		  url:getDisbursementTransactionByReferrence_url,
		  data: dataString,
		  dataType: 'json',
		  headers: {
		  "AccessToken": access_token,
		  },
		  cache: false,
		  success: function(report){
			  		$('#transaction-table').html('<tr style="background:#bdc3c7;"><td>SN</td><td>DATE</td><td>BALANCE BEFORE</td><td>AMOUNT</td><td>SERVICE CHARGE</td><td>BALANCE AFTER</td><td>STATUS</td><td>PAYOUT TYPE</td><td>NARRATION</td><td>REFERENCE</td></tr>');

			  var error = report.error;
			  var data = report.data;
			  if (error==false){
				  var no=0;
				  var total_amount=0;
				for (var i = 0; i < data.length; i++) {
					no++;
				  var trans_date = data[i].transactionDate;
				  var balance_before = data[i].balanceBefore;
				  var amount = data[i].amount;
				  var service_charge = data[i].serviceCharge;
				  var balance_after = data[i].balanceAfter;
				  var status = data[i].status;
				  var type = data[i].disbursementType;
				  var narration = data[i].message;
				  var referrence_key = data[i].transactionReferrence;
				  if (status=='Transfer Successful'){
					  status='SUCCESSFUL';
					  var style='ACTIVE';
				  }else{
					  status='FAILED';
					   var style='INACTIVE'
				  }
						trans_date = new Date(trans_date)
						ToYear=trans_date.getFullYear();
						ToMonth=trans_date.getMonth()+1;
						ToDay=trans_date.getDate();
						hr = ("0" + trans_date.getHours()).slice(-2);
						mini = ("0" + trans_date.getMinutes()).slice(-2);
						sec = ("0" + trans_date.getSeconds()).slice(-2);
						trans_date =ToYear+"-"+ToMonth+"-"+ToDay+" "+hr+":"+mini+":"+sec				  
				  
				$('#transaction-table').append('<tr><td>'+no+'</td><td>'+trans_date+'</td><td>'+balance_before+'</td><td>'+amount+'</td><td>'+service_charge+'</td><td>'+balance_after+'</td><td><button class="btn '+style+'">'+status+'</button></td><td>'+type+'</td><td>'+narration+'</td><td>'+referrence_key+'</td></tr>');
				}
			  }
			  			  		$('.ajax-loader').hide();

		  }
	  });

}








































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










































