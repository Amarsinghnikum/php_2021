<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Brilliance GPS Tracking</title>

<link rel="stylesheet" href="css/style.css">
<!--[if lt IE 9]>
<script type="text/javascript" src="html5.js"></script>
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="pngfix1.js"></script>
<![endif]-->
<!-- Menu start --------------->
<link href="menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="menu/quickmenu0.js"></script>
<!-- Menu End --------------->
</head>
<body>
  <?php include("include/header.php") ?>
  <nav>
    <ul id="qm0" class="qmmc" >
      <li><a href="admin.php" class="qmactive">Dashboard</a></li>            
      <li><a href="#">Product</a>
          <ul>
          	<li><a href="add-category.php">Add Category</a></li>
            <li><a href="add-sub-category.php">Add  Sub Category</a></li>
          	
          	<li><a href="product.php">Add Product</a></li>
          </ul>
      </li>      
      <!-- <li><a href="#">CCTV</a>
          <ul>
          	<li><a href="product-brand.php">Add Brand</a></li>
          	<li><a href="cctv.php">Add Product</a></li>
          </ul>
      </li> -->
      
      
    </ul>
  </nav>
  
<div id="wrap">
  <section class="bodymain" style="min-height:540px;">
    <aside class="middle-container"> 
     <div class="clear" style="height:5px;"></div>
      <h1 style="margin:50px 0 0 270px; font-size:35px; color:#e85116;">Welcome To Admin Panel</h1>
      
      </aside>
    <div class="clear"></div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </section>
</div>
<div class="clear"></div>
<footer>
  <footer class="whitefoter">
    <div class="whitefooter-cont">
      <div style="float:left;">Copyright © Brilliance GPS Tracking. All Rights Reserved.</div>      
           <a href="https://www.akswebsoft.com/" target="_blank" style="float:right;">
                <img src="images/akslogo.png" alt="AKS Websoft Consulting Pvt. Ltd." title="AKS Websoft Consulting Pvt. Ltd."></a>
      
      <div class="clear"></div>
    </div>
  </footer>
</footer>
</body>
</html>