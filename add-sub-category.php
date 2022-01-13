<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);
}

include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getCategory = $commonFunObj->getList("category",array('display_status'=>1));

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
    var category_id = document.getElementById('category_id').value;
    var sub_category = document.getElementById('sub_category').value;
     var status = document.getElementById('status').checked;
      if(status == true){
        status=1;
      }
       if(status== false){
          status=0;
       }
       if(category_id == " "){
        document.getElementById('category_id_error').innerHTML="Select  category.";
        return false;
      }
      if(sub_category == ""){
        document.getElementById('sub_category_error').innerHTML="Enter  subcategory.";
        return false;
      }else{  
        var parameters = "";
        parameters = "category_id="+category_id+"&sub_category="+sub_category+"&status="+status+"&action=categorySubadd";
          //alert(parameters);
        $.ajax({  
          type: "POST",  
          url: "ajax_register_login.php", 
          data: parameters,
          success: function(response){
            if(response == "succ"){
              showDataC();
              $('#sub_category').val("");
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
            url: "ajaxsubcategoryshow.php",
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
<?php include("include/header.php"); ?>
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
    <h1>Add Sub Category</h1>
    <span id="msg"></span>
    <br>

<div class="form-raw">
  <form method="post">
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
        <select id="category_id">
             <option value=" ">Select Option</option>
             <?php
              if($getCategory>0){
                foreach($getCategory as $showCategory){
                ?>
                  <option value="<?=$showCategory['id']?>"><?=$showCategory['category_name']?></option>  
                <?php
              }
            }
             ?>
        </select>
        <br><br>
        <span id="category_id_error"></span>
      </div>
    </div>
      <div class="clear"></div>

    <div class="form-raw">
      <div class="form-name">Add Sub Category</div>
      <div class="form-txtfld">
        <input type="text" id="sub_category" autocomplete="off">
        <br><br>
        <span id="sub_category_error"></span>
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
        <input type="button" class="btn" value="Submit"  onclick="validation()">
      </div>
    </div>
  </div>
</form>
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