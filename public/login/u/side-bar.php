<div class="side-nav-div animated fadeInLeft animated animated">
	<div class="nav-div active-li" onClick="_get_page('dashboard', 'dashboard')" id="dashboard">
    	<div class="icon"><i class="fa fa-dashboard"></i></div> Dashboard
        <div class="hidden" id="_dashboard"><i class="fa fa-dashboard"></i> Admin Dashboard</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('projects', 'projects')" id="projects">
    	<div class="icon" ><i class="fa fa-th-large"></i></div> My Projects
        <div class="hidden" id="_projects"><i class="fa fa-th-large"></i> My Projects</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('collections', 'collections')" id="collections">
    	<div class="icon"><i class="fa fa-list-ul"></i></div> Collections
        <div class="hidden" id="_collections"><i class="fa fa-list-ul"></i> DDP Collections</div>
    </div>
    
	<div class="nav-div" onClick="_get_page('payout', 'payout')" id="payout">
    	<div class="icon"><i class="fa fa-money"></i></div> PayOut
        <div class="hidden" id="_payout"><i class="fa fa-money"></i> DDP PayOut</div>
    </div>
	<div class="nav-div" onClick="_get_page('paymentlink', 'paymentlink')" id="paymentlink">
    	<div class="icon"><i class="fa fa-money"></i></div> Payment Link
        <div class="hidden" id="_paymentlink"><i class="fa fa-money"></i> DDP paymentlink</div>
    </div>
    
<!--
	<div class="nav-div">
    	<div class="icon"><i class="fa fa-exchange"></i></div> Transfer
    </div>
-->    

	<div class="nav-div" onClick="_get_form('get_project_settings_form')">
    	<div class="icon"><i class="fa fa-gear (alias)"></i></div> Settings
    </div>
<form method="post" action="config/code.php" id="logoutform">
<input type="hidden" name="action" value="logout"/>    
	<div class="nav-div" onclick="document.getElementById('logoutform').submit();">
    	<div class="icon"><i class="fa fa-power-off"></i></div> Log-Out
    </div>
</form>
</div>