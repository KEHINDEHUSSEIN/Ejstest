<div class="side-nav-div animated fadeInLeft animated animated">
	<div class="nav-div active-li" onClick="_get_page('dashboard', 'dashboard')" id="dashboard">
    	<div class="icon"><i class="fa fa-dashboard"></i></div> Dashboard
        <div class="hidden" id="_dashboard"><i class="fa fa-dashboard"></i> Admin Dashboard</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('users', 'users')" id="users">
    	<div class="icon"><i class="fa fa-users"></i></div> Administrators
        <div class="hidden" id="_users"><i class="fa fa-users"></i> DDP Administrators</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('projects', 'projects')" id="projects">
    	<div class="icon" ><i class="fa fa-th-large"></i></div> Projects
        <div class="hidden" id="_projects"><i class="fa fa-th-large"></i> Projects</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('collections', 'collections')" id="collections">
    	<div class="icon"><i class="fa fa-list-ul"></i></div> Collections
        <div class="hidden" id="_collections"><i class="fa fa-list-ul"></i> DDP Collections</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('payout', 'payout')" id="payout">
    	<div class="icon"><i class="fa fa-money"></i></div> PayOut
        <div class="hidden" id="_payout"><i class="fa fa-money"></i> DDP PayOut</div>
    </div>
    

	<div class="nav-div" onClick="_get_page('transfer', 'transfer')" id="transfer">
    	<div class="icon"><i class="fa fa-exchange"></i></div> Transfer
        <div class="hidden" id="_transfer"><i class="fa fa-exchange"></i> DDP Transfer</div>
    </div>
    

	<div class="nav-div" onClick="_get_page('app_settings', 'app_settings')" id="app_settings">
    	<div class="icon"><i class="fa fa-gear (alias)"></i></div> Settings
        <div class="hidden" id="_app_settings"><i class="fa fa-gear (alias)"></i> DDP Settings</div>
    </div>
<form method="post" action="config/code.php" id="logoutform">
<input type="hidden" name="action" value="logout"/>    
	<div class="nav-div" onclick="document.getElementById('logoutform').submit();">
    	<div class="icon"><i class="fa fa-power-off"></i></div> Log-Out
    </div>
</form>
</div>