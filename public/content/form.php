<?php if($page=='log-in'){?>
<script>
$(document).ready(function() {
		$("#login-info").keydown(function(e){
			if(e.keyCode==13){
					_sign_in();
			}
		});
});
</script>

<div class="detail" id="login-info">
        	<div class="logo-div"><img src="all-images/images/icon.png" title="Dilaac Digital payment Logo" /></div><br clear="all" />
            <h2><i class="fa fa-user-circle"></i> Log-in Here<br /><hr /></h2>

                    <form action="config/code.php" id="loginform" enctype="multipart/form-data" method="post">
            
                        <div class="text-div">
                                <div class="title"><i class="fa fa-envelope"></i> Email Address:</div>
                                  <input name="username" id="username" type="text" class="text_field input" placeholder="Enter Your Email Address" title="Enter Your Email Address" />
                        </div>
            
                        <div class="text-div">
                                <div class="title"><i class="fa fa-lock"></i> Password:</div>
                                  <input name="password" id="password" type="password" class="text_field input" placeholder="Enter Your Passowrd" title="Enter Your Password"/>
                        </div>
                        <div class="text-div">
                               <input name="action" value="login" type="hidden" />
                               <button class="btn" type="button"  title="Login" id="login-btn" onclick="_sign_in()"><i class="fa fa-check"></i> Log-In </button>
                        </div>
                        <div class="alert" style="margin-bottom:5px;">Forget Password? <span onclick=" _view_div('reset-password-info')"> RESET PASSWORD</span>  | <span onclick="_call_login('sign-up')"> SIGN-UP HERE</span></div>
                </form>
</div>
            
            
            
            
        <div class="detail" id="reset-password-info">
            <br /><br /><br /><br />
            <div class="alert alert-success"><span> <i class="fa fa-lock"></i> RESET PASSWORD</span></div>
			<div class="text-div">
                    <div class="title">Provide Email Address:</div>
                      <input id="reset_password_email" type="text" class="text_field" placeholder="Enter Your Email Address" title="Enter Your Email Address" />
			</div>
			<div class="text-div">
                     <button class="btn" type="button"  title="Next" id="reset-pwd-btn" onclick="_proceed_reset_password()"> Proceed <i class="fa fa-long-arrow-right"></i></button>
			</div>
            <div class="alert">Existing User? <span onclick=" _view_div('login-info')">LOG-IN HERE</span> </div>
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









<?php if($page=='sign-up'){?>
<div class="detail" id="login-info">
            <h2><i class="fa fa-user-plus"></i> Sign-Up Here<br /><hr /></h2>

                    <form action="config/code" id="loginform" enctype="multipart/form-data" method="post">
                    
            		<div class="next" id="detail-next">
                        <div class="text-div">
                                <div class="title"><i class="fa fa-user-circle"></i> FullName:</div>
                                  <input id="fullname" type="text" class="text_field" placeholder="Enter Your FullName" title="Enter Your FullName" />
                        </div>
            
                        <div class="text-div">
                                <div class="title"><i class="fa fa-envelope"></i> Email Address:</div>
                                  <input id="email" type="text" class="text_field" placeholder="Enter Your Email Address" title="Enter Your Email Address" />
                        </div>
                        
                        <div class="text-div">
                                <div class="title"><i class="fa fa-phone"></i> Phone Number:</div>
                                  <input id="phone" type="text" class="text_field" placeholder="Enter Your Phone Numbrer" title="Enter Your Phone Numbrer" />
                        </div>
                        <div class="text-div">
                               <button class="btn" type="button"  title="Sign-Up" onclick="_next_panel('password-next')"> PROCEED <i class="fa fa-long-arrow-right"></i></button>
                        </div>
            		</div>
                    
            		<div class="next" id="password-next">
                   <div class="alert alert-success" style="margin-bottom:5px;">CREATE YOUR PASSWORD</div>
                        <div class="text-div">
                                <div class="title"><i class="fa fa-lock"></i> Create Password:</div>
                                  <input id="password" type="password" class="text_field" placeholder="Create Passowrd" title="Create Passowrd"/>
                        </div>
                        <div class="text-div">
                                <div class="title"><i class="fa fa-lock"></i> Confirm Password:</div>
                                  <input id="cpassword" type="password" class="text_field" placeholder="Confirm Passowrd" title="Confirm Passowrd"/>
                        </div>
                        <div class="text-div">
                               <button class="btn dark" type="button"  title="Go Back" onclick="_next_panel('detail-next')"><i class="fa fa-long-arrow-back"></i> Go Back</button>
                               <button class="btn" type="button"  title="Sign-Up" id="login-btn" onclick="_vet_email()"><i class="fa fa-check"></i> Sign-Up </button>
                        </div>
                     </div>
                     
                   <div class="alert" style="margin-bottom:5px;">Existing Client? <span onclick="_call_login('log-in')"> LOG-IN HERE</span></div>
                </form>
            </div>
            
            
<script src="js/superplaceholder.js"></script> 
<script>
		superplaceholder({
			el: email,
				sentences: [ 'Enter Email Address', 'e.g sunaf4real@gmail.com', 'info@pec.com.ng', 'king123@hotmail.com', 'afootech2016@yahoo.com' ],
				options: {
				letterDelay: 80,
				loop: true,
				startOnFocus: false
			}
		});
</script>
            
<?php }?>






