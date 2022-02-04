
			<?php
				 $user_array=$callclass->_get_user_detail($conn, $users_id);
							  $u_array = json_decode($user_array, true);
								$users_id= $u_array[0]['user_id'];
								$fullname= $u_array[0]['fullname'];
								$mobile= $u_array[0]['mobile'];
								$email= $u_array[0]['email'];
								$passport= $u_array[0]['passport'];
								$otp= $u_array[0]['otp'];
								$reg_date= $u_array[0]['reg_date'];
								$last_login= $u_array[0]['last_login'];
				?>
				


        <div class="user-account-div">
		<div class="title"><i class="fa fa-user-circle"></i> PERSONAL DETAILS
           <button class="action-btn" type="button" onclick="_get_form('change-user-password-form')"><i class="fa fa-lock"></i> CHANGE PASSWORD </button>
        </div>
                <div class="_profile-div">
                    <label>
                    <div class="_profile-pix"><img src="../sa/uploaded_files/client_passport/<?php echo $user_passport; ?>" id="passportimg3"/></div>
                    <?php if ($user_id==$users_id){?>
                    <input type="file" id="passport" accept=".jpg"  onchange="Test.UpdatePreview(this);" style="display:none;"/>
                    <?php }?>
                    </label>				
                </div>
                <div class="_profile-div">
                    <div class="span"> FULLNAME:</div>
                      <input id="fullname" type="text" class="text_field" placeholder="FULLNAME" title="FULLNAME" value="<?php echo $fullname; ?>"/>
                    <div class="span"> EMAIL ADDRESS:</div>
                      <input id="email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS" value="<?php echo $email; ?>"/>
                    <div class="span"> PHONE NUMBER:</div>
                      <input id="phoneno" type="text" class="text_field" placeholder="PHONE NUMBER" title="PHONE NUMBER" value="<?php echo $mobile; ?>"/>
                   
                   <div class="sub-div">
                    <div class="span">DATE OF REGISTRATION:</div>
                      <input type="text" readonly="readonly" class="text_field" placeholder="DATE OF REGISTRATION:" title="DATE OF REGISTRATION:" value="<?php echo $reg_date; ?>"/>
                    </div>
                   <div class="sub-div">
                    <div class="span"> LAST LOGIN DATE:</div>
                      <input type="text" class="text_field" readonly="readonly" placeholder="Phone Number" title="Mobile Number" value="<?php echo $last_login; ?>"/>
                    </div>
                </div>

                    <div class="btn-div">
                        <button class="action-btn" type="button" id="update-user-btn" onclick="_update_user_profile('<?php echo $users_id; ?>');"> UPDATE PROFILE <i class="fa fa-check"></i></button>
                    </div>
            </div>
