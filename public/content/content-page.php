<?php if($action=='call_login'){?>
   <div class="close" title="Close" onclick="alert_close();"><i class="fa fa-close"></i> Close</div>


<div class="login-div">
    <div class="left-div animated fadeInRight">
    	<div class="in-div">
            <div class="pix-div animated fadeInLeft animated animated">
                <div class="logo-div"><img src="all-images/images/logo1.png" alt="Dilaac Digital payment logo"/></div>
        	</div>
     </div>
    </div>
    <div class="right-div animated fadeInLeft">
    	<div class="in-div">
              <?php include 'form.php'?> 
        </div>
        
        <div class="footer">
        <div class="footer-in">
        &copy; Copy Right Reserved 2021 - <?php echo date('Y');?><br /> <span> <?php echo $thename?></span>
        </div>
        </div>   
         
    </div>

</div>

<?php }?>


<?php if ($action=='verify_email'){?>
		<div class="verify-otp-div">
        	<div class="icon animated bounceInDown"><img src="all-images/images/email.jpeg" alt="DDP OTP" /></div>
            <h2>Verify Your Email</h2>
        	<p>We've sent an verification OTP to<br /><strong><?php echo $email;?></strong></p>
                        <div class="text-div">
                         <input id="otp" type="text" class="text_field" placeholder="Enter OTP" title="Enter OTP" />
                          <button class="btn" type="button"  id="finish_signup_btn" title="Verify Email" onclick="_finish_signup('<?php echo $user_id;?>')"><i class="fa fa-check"></i> VERIFY </button>
                        </div>
                   <div class="alert alert-success">Yet to receive OTP?  <span id="resend_otp" onclick="_resend_signup_otp('<?php echo $user_id;?>')">RESENT OTP</span></div>
          </div>

<?php } ?>


<?php if ($action=='sign_up_finish'){?>
 		<div class="verify-otp-div success">
        	<div class="icon  animated fadeIn"><img src="all-images/images/success.gif" alt="Sign up sucessful" /></div>
            <h2>Sign-Up Successful!</h2>
                        <div class="text-div">
                          <button class="btn" type="button"  title="Okay" onclick="_call_login('log-in')"> <i class="fa fa-check"></i> LOG-IN </button>
                        </div>
          </div>
<?php } ?>





































<?php if ($action=='reset_password'){?>
            <div class="alert alert-success">An <span>OTP</span> has been sent to your email address (<span><?php echo $email; ?></span>).</div>
			<div class="text-div">
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Enter OTP:</div>
                      <input id="cotp" type="text" class="text_field" placeholder="Enter OTP" title="Enter OTP"/>
			</div>
            <div class="alert" style="margin-bottom:0px;"><span>OTP</span> not received? <span id="resend" onclick="_resend_otp('resend','<?php echo $email; ?>')"><i class="fa fa-send"></i> RESEND OTP</span></div>
			<div class="text-div">
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Create Password:</div>
                      <input id="cpass1" type="password" class="text_field" placeholder="Create Password" title="Create Password"/>
			</div>
			<div class="text-div">
                    <div class="title"><i class="fa fa-ellipsis-h"></i> Confirm Password:</div>
                      <input id="cpass2" type="password" class="text_field" placeholder="Confirm Password" title="Confirm Password"/>
			</div>
			<div class="text-div">
                     <button class="btn" type="button"  title="Reset" id="finish-reset-btn" onclick="_finish_reset_password('<?php echo $email; ?>')"><i class="fa fa-check"></i> Reset Password </button>
			</div>

<?php } ?>









<?php if ($action=='password_reset_completed'){?>
    <br /><br /><br /><br /><br />
            <div class="alert alert-success"><i class="fa fa-check"></i> PASSWORD RESET SUCCESSFUL!</div>
			<div class="text-div">
             <button class="btn" type="button"  title="Log-In" onclick=" _view_div('login-info')"><i class="fa fa-check"></i> Log-In </button>
			</div>

<?php } ?>

