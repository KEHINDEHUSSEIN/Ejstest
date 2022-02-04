<?php include '../../config/connection.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<?php include 'config/session-validation.php'?>
<title>Administrator Portal | <?php echo $thename;?></title>

				<?php if ($admin_token==''){?>
					<script>
						$(document).ready(function() {
								_login_and_get_admin_token_to_session('<?php echo $super_admin_username; ?>','<?php echo $super_admin_password; ?>');
						});
					</script>
				<?php }?>
</head>
<body>
<?php include 'header.php'?>
<?php include 'side-bar.php'?>

<div class="content-div">
<?php $callclass->_super_admin_title_pane($thename);?>
    <div id="page-content">
		<?php $view_content='dashboard';?>
        <?php require_once 'content/content-page.php'?>
    </div>

      
      <div class="side-div-right animated fadeInRight animated animated">
            
            <div class="matrix-div animated zoomIn animated animated">
                <div class="matrix-in">
                    <div class="matrix-title">Collection Matrix</div> 
                    <div id="collection-matrix">
                        <div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>
                    </div>
                </div>
            </div>
          
            <div class="matrix-div animated zoomIn animated animated">
                <div class="matrix-in">
                    <div class="matrix-title">Payout Matrix</div> 
                    <div id="payout-matrix">
                        <div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>
                    </div>
                </div>
            </div>
      </div>
      
            

</div>
</body>
</html>
