<?php if($page=='log-in'){?>
                    <div class="text" id="login-info">
                        <p><i class="fa fa-user-circle"></i> ADMINISTRATIVE LOG-IN <hr /></p><br clear="all" />
                    <form action="config/code" id="loginform" enctype="multipart/form-data" method="post">
            
                                <div class="title"><i class="fa fa-envelope"></i> Email Address:</div>
                                  <input name="username" id="username" type="text" class="text_field" placeholder="Enter Your Email Address" title="Enter Your Email Address" />
            
                                <div class="title"><i class="fa fa-lock"></i> Password:</div>
                                  <input name="password" id="password" type="password" class="text_field" placeholder="Enter Your Passowrd" title="Enter Your Password"/>
                               <input name="action" value="login" type="hidden" />
                               <button class="btn" type="button"  title="Login" id="login-btn" onClick="_sign_in()"><i class="fa fa-check"></i> Log-In </button>
                        <div class="alert" style="margin-bottom:5px;">Forget Password? <span onClick=" _view_div('reset-password-info')"> RESET PASSWORD</span></div>
                </form>
                    </div>
                    
                    
                    
            <div class="text" id="reset-password-info">
                    <br />
                    <p><i class="fa fa-lock"></i> RESET PASSWORD <hr /></p><br clear="all" />
                    <div class="title">Provide Email Address:</div>
                    <input id="reset_password_email" type="text" class="text_field" placeholder="Enter Your Email Address" title="Enter Your Email Address" />
                    <button class="btn" type="button"  title="Next" id="reset-pwd-btn" onClick="_proceed_reset_password()"> Proceed <i class="fa fa-long-arrow-right"></i></button>
                    <div class="alert">Existing User? <span onClick=" _view_div('login-info')">LOG-IN HERE</span> </div>
            </div>
                    
            
<script src="js/superplaceholder.js"></script> 
<script>
		superplaceholder({
			el: username,
				sentences: [ 'Enter Email Address', 'e.g sunaf4real@gmail.com', 'info@pec.com.ng', 'king123@hotmail.com', 'afootech2016@yahoo.com' ],
				options: {
				letterDelay: 80,
				loop: true,
				startOnFocus: false
			}
		});
</script>
            
<?php }?>




<?php if ($action=='reset_password'){?>
            <div class="alert alert-success">An <span>OTP</span> has been sent to your email address (<span><?php echo $email; ?></span>).</div>
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Enter OTP:</div>
                      <input id="cotp" type="text" class="text_field" placeholder="Enter OTP" title="Enter OTP"/>
                    <div class="alert" style="margin-bottom:0px;"><span>OTP</span> not received? <span id="resend" onclick="_resend_otp('resend','<?php echo $email; ?>')"><i class="fa fa-send"></i> RESEND OTP</span></div>
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Create Password:</div>
                      <input id="cpass1" type="password" class="text_field" placeholder="Create Password" title="Create Password"/>
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Confirm Password:</div>
                      <input id="cpass2" type="password" class="text_field" placeholder="Confirm Password" title="Confirm Password"/>
                     <button class="btn" type="button"  title="Reset" id="finish-reset-btn" onclick="_finish_reset_password('<?php echo $email; ?>')"><i class="fa fa-check"></i> Reset Password </button>
			</div>

<?php } ?>

<?php if ($action=='password_reset_completed'){
	?><br /><br /><br /><br /><br />
            <div class="alert alert-success"><i class="fa fa-check"></i> PASSWORD RESET SUCCESSFUL!</div>
             <button class="btn" type="button"  title="Log-In" onclick=" _view_div('login-info')"><i class="fa fa-check"></i> Log-In </button>

<?php } ?>






  

