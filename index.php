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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  function validation(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
       var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,4})+$/;  
        if(email!=""){
          if (filter.test(email)== false) {  
              document.getElementById('email_error').innerHTML='Please provide a valid email address';  
              email.focus;  
              return false;  
          }  
    }
      if(email == ""){
        document.getElementById('email_error').innerHTML="Please enter email id.";
        return false;
      }else if(password == ""){
        document.getElementById('password_error').innerHTML="Please enter password.";
        return false;
      }else{  
        var parameters = "";
        parameters = "email="+email+"&password="+password+"&action=login";
        //alert(parameters);
        $.ajax({  
          type: "POST",  
          url: "ajax_register_login.php", 
          data: parameters,
          success: function(response){
             alert(response);
            if(response == "success"){
              window.location.href="admin.php";
            }
          }
        });
      }  
  }
</script>
</head>
<body>
<header>
  <div id="wrap">
    <div class="logo"><img src="images/logo.png" border="0"></div>
    
    <div class="admintxt">Admin panel</div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</header>
<div class="clear"></div>
<div class="bodycont">
  <form method="post">
  <div id="wrap2" style="min-height:530px;">
    <div class="login-cont">
      <h1 class="loginhd">Login Here</h1>
      <div class="login-row">
        <div class="loginname">Email</div>
        <div class="admintxtfld-box">
          <input type="text" name="email" id="email">
          <span id="email_error"></span>
        </div>        
        <div class="clear"></div>
      </div>
<!--       <div class="loginreq-field">* This Field Required </div> -->
      
      <div class="login-row">
        <div class="loginname">Password</div>
        <div class="admintxtfld-box">
          <input type="password" name="password" id="password">
          <span id="password_error"></span>
        </div>
        <div class="clear"></div>
      </div>
      
      <div class="clear"></div>
      <div class="contact-row" style="width:325px;">
        <div style="background:none; border:none; margin-top:15px;">
        <!-- <a href="#" style="text-decoration:none;"> -->
          <input type="button" class="btn" value="Login" onclick="validation()">
          <!-- </a><br> -->
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  </form>
  <div class="clear"></div>
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