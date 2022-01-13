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
<!-- slider start -->
<!-- slider end -->
<link rel="stylesheet" href="css/style.css">

<!-- Menu start --------------->
<link href="menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="menu/quickmenu0.js"></script>
<!-- Menu End --------------->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  function validation(){
    var category = document.getElementById('category').value;
     var status = document.getElementById('status').checked;
      if(status == true){
        status=1;
      }
       if(status== false){
          status=0;
       }
      if(category == ""){
        document.getElementById('category_error').innerHTML="Please enter category.";
        return false;
      }else{  
        var parameters = "";
        parameters = "category="+category+"&status="+status+"&action=categoryadd";
        //alert(parameters);
        $.ajax({  
          type: "POST",  
          url: "ajax_register_login.php", 
          data: parameters,
          success: function(response){
            if(response == "succ"){
              showDataC();
              $('#category').val("");
              document.getElementById("msg").innerHTML="Added category successfull..."; 
            }
           
          }
        });
      }  
  }
  function showDataC(){
    $(document).ready(function() {
        var response = '';
        $.ajax({
            type: "GET",
            url: "categoryshow.php",
            dataType: "html",
            success: function(response) {
                $("#showdata").html(response); 
            }
        });

        //alert(response);
    });
  }
   showDataC();
</script>
</head>
<body>
<?php include("include/header.php");?>
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
     
    </ul>
  </nav>
  
<div id="wrap">
  <div class="clear" style="height:5px;"></div>
  <div id="wrap2">
    <h1>Add Category</h1>
    <span id="msg"></span>
    <br>
    <form method="post">
    <div class="form-raw">
      <div class="form-name">Category Name</div>
      <div class="form-txtfld">
        <input type="text" name="category" id="category">
        <br><span id="category_error"></span>
      </div>
    </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>    
    <div class="form-raw">
      <div class="form-name">Active</div>
      <div class="form-txtfld">
        <input type="checkbox" id="status" value="1">
      </div>      
      <div class="clear"></div>
    </div>
        
    <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width:290px;">
        <input type="button" class="btn" value="Submit" onclick="validation()">
      </div>
    </div>
    </form>
  </div>
  <div class="clear">&nbsp;</div>
</div>
<div id="wrap3">
  <div id="showdata"></div>
  <div class="clear">&nbsp;</div>
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