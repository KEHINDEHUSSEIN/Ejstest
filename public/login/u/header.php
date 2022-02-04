<?php  include 'alert.php'?>
<div class="header-div animated fadeInDown animated animated">
	<div class="header-div-in">
        <div class="menu-div" title="Open Menu" onclick="_open_menu()" id="menu-div"><i class="fa fa-navicon (alias)"></i></div>
    	<div class="logo-div"><img src="all-images/images/logo.png" alt="Dilaac logo" /></div>
        
        <div class="header-nav-div" data-aos="fade-right" data-aos-duration="1500">
        <li class="active-li" id="sdashboard"  onClick="_get_page('dashboard', 'dashboard')"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li id="sprojects" onClick="_get_page('projects', 'projects')"><i class="fa fa-th-large"></i> My Projects <div><?php echo $projectcount; ?></div></li>
        </div>
        
        
            <div class="header-profile-pix-div"
            title="User Account
            <?php echo $user_name; ?> 
            User ID: <?php echo $user_id; ?>" onclick="_toggle_profile_pix_div()">
            <img src="../sa/uploaded_files/client_passport/<?php echo $user_passport; ?>" id="passportimg1"/>
            
            <div class="toggle-profile-div">
            <div class="toggle-profile-pix-div">
            <img src="../sa/uploaded_files/client_passport/<?php echo $user_passport; ?>" id="passportimg2"/>
            </div>
            
            <div class="toggle-profile-name"><?php echo $user_name; ?> </div>
            <div class="toggle-profile-others">User ID: <?php echo $user_id; ?> <br /><?php echo $user_mobile; ?> </div>
            <form method="post" action="config/code" name="logoutform">
            <input type="hidden" name="action" value="logout"/>
            <button class="logout-btn" type="submit"><i class="fa fa-sign-out"></i> Log-Out</button>
            </form>
            <button class="logout-btn" type="button" onclick="_get_users_profile('<?php echo $user_id; ?>','myprofile');"><i class="fa fa-user"></i> Profile</button>
                    <div class="hidden" id="_myprofile"><i class="fa fa-user-circle"></i> Merchant Profile</div>
            <br clear="all" />
            </div>
            </div>
            
            
            
            
            
            <div class="notification" onClick="_get_page('system_alert', 'system_alert')">
            <i class="fa fa-bell-o"></i>
            </div>
            <!------>
            <span id="_system_alert" style="display:none;"><i class="fa fa-bell-o"></i> System Alert</span>
            <!------>  
            
            <?php if ($projectcount>0){?>
                <div class="project-status">
                <?php if ($project_status=='A'){ ?>
                    <div class="status" onclick="_get_project_status('closed')"><div class="signal animated fadeInRight animated animated"></div> <div class="text animated fadeInLeft animated animated">LIVE</div></div>
                <?php } elseif ($project_status=='S'){?>
                    <div class="status close" onclick="_get_project_status('live')"><div class="text animated fadeInRight animated animated">CLOSED</div> <div class="signal animated fadeInLeft animated animated"></div></div>
                <?php }else{?>
                    <div class="status close"><div class="text animated fadeInRight animated animated">ACTIVATE PROJECT</div></div>
                <?php }?>
                </div>
            <?php }?>
            
       </div>
</div>