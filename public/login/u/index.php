<?php include '../../config/connection.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<?php include 'config/session-validation.php'?>
<title>Administrator Portal | <?php echo $thename;?></title>
</head>
<body>
<?php include 'header.php'?>
<?php include 'side-bar.php'?>

<div class="content-div">
<?php $callclass->_admin_title_pane($project_name);?>
    <div id="page-content">
		<?php $view_content='dashboard';?>
        <?php require_once 'content/content-page.php'?>
    </div>

      
      <div class="side-div-right animated fadeInRight animated animated">
            <div class="matrix-div" data-aos="fade-left" data-aos-duration="2000">
                <div class="matrix-in">
                    <div class="matrix-title">Welcome Back!</div> <div class="text"><span><?php echo ucwords(strtolower($user_name)); ?></span></div>
                </div>
            </div>
            
            <div class="matrix-div" data-aos="fade-left" data-aos-duration="1600">
                <div class="matrix-in">
                    <div class="matrix-title">Available Balance</div> 
                    <?php if (($projectcount>0) && ($project_status!='P')){?>
                    <span id="project_currency_side">--</span><b id="available_balance">--</b><br />
                    <?php }else{?>
                <div class="alert"><span><i class="fa fa-warning"></i></span> Wallet Empty!</div>
                    <?php }?>
                    
                    <button class="btn" onClick="_get_form('request_for_payout_form')">Request For PayOut</button>
                    <button class="btn active" onClick="_get_form('get_service_charge_form')" title="SERVICE CHARGES">Charges</button>
                    
                </div>
            </div>
          
            <div class="matrix-div animated zoomIn animated animated">
                <div class="matrix-in">
                    <div class="matrix-title">Transaction Matrix</div> 
                    <div id="chart-for-pie">
                    <?php if (($projectcount>0) && ($project_status!='P')){?>
                        <div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>
                    <?php }else{?>
                <div class="alert"><span><i class="fa fa-warning"></i></span> Matrix Empty!</div>
                    <?php }?>
                    </div>
                </div>
            </div>
            
      </div>
      
            

</div>




</body>
</html>
