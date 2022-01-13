<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);
}
$commonFunObj = new CommonFunctions();
$category_id = $_REQUEST['cid'];
if(isset($category_id)){
  $getCategory = $commonFunObj->getList("category",array("id"=>$category_id));
  $CateoryName = $getCategory[0]['category_name'];
  $status = $getCategory[0]['display_status'];
}
if(isset($_POST['action']) && $_POST['action']=="Edit"){
    $category = isset($_POST['category'])?add_slashes($_POST['category']):'';
    $status = isset($_POST['status'])?add_slashes($_POST['status']):'';
    $paramArray = array(
      'category_name'=>$category,
      'display_status'=>$status
      );
    // print_r($paramArray); exit();
    if($paramArray){
      $commonFunObj->updateRecord("category","id",$category_id,$paramArray);
      header("location:".$wwwroot."add-category.php?act=esucc");
    }
    
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
        document.getElementById('status_value').value="1";
      }
       if(status== false){
          document.getElementById('status_value').value="0";
       }
      if(category == ""){
        document.getElementById('category_error').innerHTML="Please enter category.";
        return false;
      }
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
      <input type="hidden" name="status" id="status_value" value="">
      <input type="hidden" name="action" value="Edit">
      
    <div class="form-raw">
      <div class="form-name">Category Name</div>
      <div class="form-txtfld">
        <input type="text" name="category" id="category" value="<?=$CateoryName?>">
        <br><span id="category_error"></span>
      </div>
    </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>    
    <div class="form-raw">
      <div class="form-name">Active</div>
      <div class="form-txtfld">
        <input type="checkbox" id="status" <?php if($status==1){ echo"checked";} ?>>
      </div>      
      <div class="clear"></div>
    </div>
        
    <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width:290px;">
        <input type="submit" class="btn" value="Submit" onclick="return validation()">
      </div>
    </div>
    </form>
  </div>
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