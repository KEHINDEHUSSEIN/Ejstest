//////////////////////////////10/7/2021////////////////////////// by Afolabi Oluwagbnega Sunday
$(document).ready(function() {
	function trim(s) {
            return s.replace( /^\s*/, "" ).replace( /\s*$/, "" );
    }
});
//////////////////////////////////////////////////////////////////////////////////////////////////
$(window).scroll(function() { 
  var scrollheight = $(window).scrollTop();
  	if (scrollheight >= 100) {
		$("#back2Top").fadeIn(300).css("display", "block");
	} else {
		$('#back2Top').fadeOut();
	}
});
function _back_to_top(){
		event.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function scrolltodiv(divid, margintop, linkid){
	$('html, body').animate({
	scrollTop: $("#"+divid).offset().top - margintop}, "slow");
}
//////////////////////////////////////////////////////////////////////////////////////////////////





function _open_menu(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('#live-chat-div').animate({'margin-left':'-100%'},400);
	   $('#menu-list-div').animate({'margin-left':'0'},400);
}

function _open_live_chat(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('#menu-list-div').animate({'margin-left':'-100%'},400);
	   $('#live-chat-div').animate({'margin-left':'0'},400);
}

function _close_side_nav(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'-100%'},200);
	   $('#menu-list-div,#live-chat-div').animate({'margin-left':'-100%'},400);
}

function _open_li(ids){
		 $('#'+ids+'-sub-li').toggle('slow');
}




function _call_login(page){
			var action ='call_login';
		$('#get-more-div').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&page='+ page;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){$('#get-more-div').html(html);}
			});
}


///////////////////////close all panel//////////////////////////////
function alert_close(){
		$('#get-more-div, .fly-out-advert').html('').fadeOut(500);
}

	
function _view_div(ids){
				  $('#login-info, #reset-password-info').css("display", "none");
				  $('#'+ids).fadeIn(300).css("display", "block");
}


function _next_panel(div){
		if(div=='password-next'){
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
		
				if((fullname=='')||(phone=='')||(email=='')||($('#email').val().indexOf('@')<=0)){
						$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Fields To Continue').fadeIn(500).delay(5000).fadeOut(100);
					}else{
						  $('.next').css("display", "none");
						  $('#'+div).fadeIn(300).css("display", "block");
				}
		}else{
				  $('.next').css("display", "none");
				  $('#'+div).fadeIn(300).css("display", "block");
		}
}



function _vet_email(){
			var password = $('#password').val();
			var cpassword = $('#cpassword').val();
		if((password=='')||(cpassword=='')||(password!=cpassword)){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> ACCESS DENIED!<br><span>Check The Password And Try Again</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
					var email = $('#email').val();
					var action ='vet_email';
			var dataString ='action='+ action+'&email='+ email;
			$.ajax({
				type: "POST",
				url: "config/code.php",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var scheck = data.check;
					if(scheck==1){
							$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Email Not Accepted<br /><span>Please change the email to continue</span>').fadeIn(500).delay(5000).fadeOut(100);
					}else{
							_sign_up();
					}
				}
			});
		}
}

function _sign_up(){
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var password = $('#password').val();
			$('#login-info').html('<div class="ajax-loader">PROCESSING...<br><img src="all-images/images/ajax-loader.gif"/></div>');
			var action ='verify_email';
			var dataString ='action='+ action+'&fullname='+ fullname+'&email='+ email+'&phone='+ phone+'&password='+ password;
				$.ajax({
				type: "POST",
				url: "config/code.php",
				data: dataString,
				cache: false,
				success: function(html){
					$('#login-info').html(html);
					}
				});
}

function _resend_signup_otp(user_id){
				$('#resend_otp').html('SENDING...');
			var action='resend_signup_otp';
			var dataString ='action='+ action+'&user_id='+ user_id;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){
					$('#success-div').html('<div><i class="fa fa-check"></i></div> OTP SENT<br /><span>Check your email inbox or spam</span>').fadeIn(500).delay(5000).fadeOut(100);
				$('#resend_otp').html('RESEND OTP');
				}
			});
}



function _finish_signup(user_id){
			var otp = $('#otp').val();
		if((otp=='')){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill OTP Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
					$('#finish_signup_btn').html('<img src="all-images/images/wait.gif" width="30px"/>');
					document.getElementById('finish_signup_btn').disabled=true;
			var action ='finish_signup';
			var dataString ='action='+ action+'&user_id='+ user_id+'&otp='+ otp;
			$.ajax({
				type: "POST",
				url: "config/code.php",
				data: dataString,
				dataType: 'json',
				cache: false,
				success: function(data){
					var scheck = data.check;
					if(scheck==1){
							_sign_up_finish();
					}else{
					$('#not-success-div').html('<div><i class="fa fa-close"></i></div> INVALID OTP<br /><span>Check the OTP and try again</span>').fadeIn(500).delay(5000).fadeOut(100);
					$('#finish_signup_btn').html('<i class="fa fa-check"></i> VERIFY ');
					document.getElementById('finish_signup_btn').disabled=false;
					}
				}
			});
		}
}

function _sign_up_finish(){
			$('#login-info').html('<div class="ajax-loader">PROCESSING...<br><img src="all-images/images/ajax-loader.gif"/></div>');
			var action ='sign_up_finish';
			var dataString ='action='+ action;
				$.ajax({
				type: "POST",
				url: "config/code.php",
				data: dataString,
				cache: false,
				success: function(html){
					$('#login-info').html(html);
					}
				});
}


	








function _sign_in(){ 
$('.success-div').hide()
			var username = $('#username').val();
			var password = $('#password').val();
			if((username!='')&&(password!='')){
				user_login(username,password)
			}else{
				$('#warning-div').fadeIn(500).delay(5000).fadeOut(100);
			}
};




///////////////////// user login ///////////////////////////////////////////
function user_login(username,password){
	 var action='login_check';
	 
	//////////////// get btn text ////////////////
	var btn_text=$('#login-btn').html();
	$('#login-btn').html('Authenticating...');
	document.getElementById('login-btn').disabled=true;
	////////////////////////////////////////////////	
	 
var dataString ='action='+ action+'&username='+ username + '&password='+ password;
	$('#login-btn').html('Authenticating...');
	$.ajax({
	type: "POST",
	url: "config/code.php",
	data: dataString,
	dataType: 'json',
	cache: false,
	success: function(data){
		$('#login-btn').html(btn_text);
		document.getElementById('login-btn').disabled=false;

 	var scheck = data.check;
	if(scheck==1){
			$('#loginform').submit();
	}else if(scheck==2){
			$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Account Suspended<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
	}else if(scheck==3){
			$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Account Under Review<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
	}else{
		$('#not-success-div').fadeIn(500).delay(5000).fadeOut(100);}
		$('#login-btn').html('<i class="fa fa-sign-in"></i> Log-In');
	}
	});
}












function _proceed_reset_password(){
			var email = $('#reset_password_email').val();
			if((email=='')||(email.indexOf('@')<=0)){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Enter Your Email Address<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
			//////////////// get btn text ////////////////
			var btn_text=$('#reset-pwd-btn').html();
			$('#reset-pwd-btn').html('PROCESSING...');
			document.getElementById('reset-pwd-btn').disabled=true;
			////////////////////////////////////////////////	
			
			var action='proceed_reset_password';
			var dataString ='action='+ action+'&email='+ email;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			success: function(data){
					var scheck = data.check;
					if(scheck==0){/// invalid email
						$('#not-success-div').html('<div><i class="fa fa-close"></i></div> INVALID  EMAIL ADDRESS<br /><span>Check the email and try again</span>').fadeIn(500).delay(5000).fadeOut(100);
					}else if(scheck==1){ /// user Active
						_reset_password(email);
					}else if(scheck==2){ /// user inactive
					$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Account Inactive<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
					}else if(scheck==3){ /// user suspended
					$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Account Suspended<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
					}else{ /// user pending
					$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Account Under Review<br /><span>Contact the admin for help</span>').fadeIn(500).delay(5000).fadeOut(100);
					}
						$('#reset-pwd-btn').html(btn_text);
						document.getElementById('reset-pwd-btn').disabled=false;

			}
		});
			}
}



function _reset_password(email){
			var action='reset_password';
		$('#reset-password-info').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&email='+ email;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){$('#reset-password-info').html(html);}
			});
}



function _finish_reset_password(email){
			var otp = $('#cotp').val();
			var password = $('#cpass1').val();
			var password1 = $('#cpass2').val();
			
			if((otp=='')||(password=='')||(password1=='')){
				$('#warning-div').html('<div><i class="fa fa-warning (alias)"></i></div> Please Fill All Fields<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
			}else{
				
					if(password!=password1){
						$('#not-success-div').html('<div><i class="fa fa-close"></i></div> Password NOT Match<br /><span>Check the password and try again</span>').fadeIn(500).delay(5000).fadeOut(100);
					}else{
			//////////////// get btn text ////////////////
					var btn_text=$('#finish-reset-btn').html();
					$('#finish-reset-btn').html('PROCESSING...');
					document.getElementById('finish-reset-btn').disabled=true;
			////////////////////////////////////////////////	
				var action='finish_reset_password';
				var dataString ='action='+ action+'&email='+ email+'&otp='+ otp+'&password='+ password;
					$.ajax({
					type: "POST",
					url: "config/code.php",
					data: dataString,
					cache: false,
					dataType: 'json',
					cache: false,
					success: function(data){
					var scheck = data.check;
					if(scheck==1){
						_password_reset_completed(email);
					}else{
						$('#not-success-div').html('<div><i class="fa fa-close"></i></div> INVALID OTP<br /><span>Check the OTP and try again</span>').fadeIn(500).delay(5000).fadeOut(100);
					$('#finish-reset-btn').html(btn_text);
					document.getElementById('finish-reset-btn').disabled=false;
					}
					}
				});
					}
			}
}

function _password_reset_completed(email){
			var action='password_reset_completed';
		$('#reset-password-info').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
			var dataString ='action='+ action+'&email='+ email;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){$('#reset-password-info').html(html);}
			});
}



	   

function _resend_otp(ids,email){
				var btn_text=$('#'+ids).html();
				$('#'+ids).html('SENDING...');
			var action='resend_otp';
			var dataString ='action='+ action+'&email='+ email;
			$.ajax({
			type: "POST",
			url: "config/code.php",
			data: dataString,
			cache: false,
			success: function(html){
					$('#success-div').html('<div><i class="fa fa-check"></i></div> OTP SENT<br /><span>Check your email inbox or spam</span>').fadeIn(500).delay(5000).fadeOut(100);
					$('#'+ids).html(btn_text);
				}
			});
}


