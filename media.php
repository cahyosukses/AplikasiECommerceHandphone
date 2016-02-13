<?php 
  error_reporting(0);
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Selpy Cell Ciamis</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="iecss.css" />
<![endif]-->
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>

<div id="main_container">

	<div id="header">

        <div id="logo">
            <a href="index.php"><img src="images/logo.png" alt="" title="" border="0" width="182" height="85" /></a>
	    </div>
		
    </div>
    
   <div id="main_content"> 
   
            <div id="menu_tab">
                    <ul class="menu">
                         <?php include "menu.php"; ?>
                    </ul>

            </div><!-- end of menu tab -->
            
    <div class="crumb_navigation">
    Anda sedang berada di: <?php include "breadcrumb.php";?>
    </div>        
    
   <div class="left_content">
		<?php include "kiri.php";?> 
   </div><!-- end of left content --> 



   <div class="center_content">
   <?php include "tengah.php";?> 
   </div><!-- end of center content -->



 <div class="right_content">
	<?php include "kanan.php";?> 
   </div><!-- end of right content -->   


            
   </div><!-- end of main content -->
   
   
   
   <div class="footer">
   <?php include "footer.php";?> 

   </div>                 


</div>
<!-- end of main_container -->
</body>
</html>