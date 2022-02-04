//////////////////////////////13/8/2019////////////////////////// by Afolabi Oluwagbnega Sunday
	
$(document).ready(function() {
	function trim(s) {
            return s.replace( /^\s*/, "" ).replace( /\s*$/, "" );
        }
$("#login-info").keydown(function(e){
	if(e.keyCode==13){
		_sign_in();
	}
});
});
	
	
	
	
function _view_div(ids){
				  $('#login-info, #reset-password-info').css("display", "none");
				  $('#'+ids).fadeIn(300).css("display", "block");
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
					//$('#success-div').html('<div><i class="fa fa-check"></i></div> LOGIN SUCCESSFUL!').fadeIn(500).delay(5000).fadeOut(100);
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

