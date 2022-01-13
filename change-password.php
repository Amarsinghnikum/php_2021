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
<title>Admin - Indo Roots</title>
<link rel="stylesheet" href="css/style.css">

<!-- Menu start --------------->
<link href="menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="menu/quickmenu0.js"></script>
<!-- Menu End --------------->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  function changepassword()
{
  //alert("hello");
  var current_pass = document.getElementById("current_pass").value;
  var new_pass = document.getElementById("new_pass").value;
  var confirm_pass = document.getElementById("confirm_pass").value;
  if(current_pass==""){
   
    document.getElementById("current_pass_error").innerHTML="Please enter current password";
    return false;
  }
  if(new_pass==""){
   
    document.getElementById("new_pass_error").innerHTML="Please enter new password";
    return false;
  }
  if(confirm_pass==""){
    document.getElementById("confirm_pass_error").innerHTML="Please enter confirm password";
    return false;
  }
  if(new_pass==confirm_pass==false)
  {
        document.getElementById("confirm_pass").innerHTML="Confirm password not match";
    return false;
  }

  var parameters = "";
    parameters ="&confirmpassword="+confirm_pass+"&newpassword="+new_pass+"&oldpassword="+current_pass+"&req_action=edit-profile";
    //alert(parameters);
    $.ajax({  
      type: "POST",  
      url: "ajax_register_login.php", 
      data: parameters,
      success: function(response){
        //alert(response);
        if(response=="succ"){
          //window.location.href="profile";
         
          $("#succ_mess").html("Your Password Successfully Change!");
          document.getElementById("current_pass").value =  "";
          document.getElementById("new_pass").value =  "";
          document.getElementById("confirm_pass").value =  "";
          //document.getElementById("password").value = "";
          //document.getElementById("cpassword").value =  "";
        }else{
        
          $("#succ_mess").html("Old Password is incorrect.");
          document.getElementById("current_pass").value =  "";
          document.getElementById("new_pass").value =  "";
          document.getElementById("confirm_pass").value =  "";
        }
      }
    });
}
</script>
</head>
<body>
<?php include("include/header.php") ?>
  <nav>
    <ul id="qm0" class="qmmc" >
      <li><a href="admin.php">Dashboard</a></li>
      <li><a href="#">Product</a>
          <ul>
            <li><a href="add-category.php">Add Category</a></li>
            <li><a href="add-sub-category.php">Add  Sub Category</a></li>
            
            <li><a href="product.php">Add Product</a></li>
          </ul>
      </li>        
     <!--  <li><a href="#">CCTV</a>
          <ul>
          	<li><a href="product-brand.php">Add Brand</a></li>
          	<li><a href="cctv.php">Add Product</a></li>
          </ul>
      </li> -->
    </ul>
  </nav>
  
<div id="wrap" >
  <section class="bodymain" style="min-height:580px;">
    <aside class="middle-container">
      <div class="admin-inr"><br>

		<div class="form-outer" style="margin-left:320px; width:500px;">
		          <h1>Change Password</h1>
              <span id="succ_mess"></span>
		          <div class="contact-row">
		            <div class="name">Current Password</div>
		            <div class="txtfld-box">
		              <input type="text" id="current_pass">
		            </div>
		            <div class="req-field" id="current_pass_error">  </div>
		          </div>
		          <div class="clear"></div>
		          <div class="contact-row">
		            <div class="name">New Password</div>
		            <div class="txtfld-box">
		              <input type="text" id="new_pass">
		            </div>
                <div class="req-field" id="new_pass_error">  </div>
		          </div>
		          <div class="clear"></div>
		          <div class="contact-row">
		            <div class="name">Confirm Password</div>
		            <div class="txtfld-box">
		              <input type="password" id="confirm_pass">
		            </div>
                <div class="req-field" id="confirm_pass_error">  </div>
		          </div>
		          <div class="clear">&nbsp;</div>
		          <div class="contact-row">
		            <div class="name" style="float:right; width:1px;">&nbsp;</div>
		            <div style="background:none; border:none; float:left;">
		              <input type="button" class="btn" value="Change Password" onclick="changepassword()">
		              <br>
		            </div>
		          </div>
		        </div>
		        <div class="clear">&nbsp;</div>
		        
        <div class="clear"></div>
      </div>
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