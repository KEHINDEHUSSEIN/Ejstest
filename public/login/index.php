<?php include '../config/connection.php'?>
<?php
if($suserid!=''){
?>
    <script>
	window.parent(location="a/");
	</script>
<?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php include 'meta.php'?>
<title>Administrative Login <?php echo $thename?></title>
<meta name="keywords" content="DDP - Dilaac Digital Payment Service" />
<meta name="description" content="Administrative Login <?php echo $thename?>"/>
</head>
<body>
<?php include 'header.php'?>
<div class="slide-parent-div animated fadeIn animated animated">
        <div class="slide-div">
            <div class="div-in">
                <div class="text-div animated fadeInLeft animated animated">
        <?php $page='log-in';?>
              <?php include 'content/content-page.php'?> 
                </div>
                
                <div class="pix-div animated fadeInLeft animated animated">
                    <a href="<?php echo $website?>" title="Dilaac Digital Payment Service">
                    <div class="logo-div" data-aos="flip-left" data-aos-duration="1500"><img src="all-images/images/logo.png" alt="Dilaac Digital payment logo"/></div></a>
                </div>
            </div>
        
        </div>
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

    <script src="js/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>

</body>
</html>



