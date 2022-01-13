<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);
}
$commonFunObj = new CommonFunctions();
$getCategory = $commonFunObj->getList("category");

$sub_category_id = $_REQUEST['scbc'];
if(isset($sub_category_id)){
  $getsubCategory = $commonFunObj->getList("subcategory",array("id"=>$sub_category_id));
  $subCateoryName = $getsubCategory[0]['sub_category'];
  $category_id = $getsubCategory[0]['category_id'];
 $statuss = $getsubCategory[0]['display_status'];

}
if(isset($_POST['action']) && $_POST['action']=="Edit"){
    $category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
    $sub_category = isset($_POST['sub_category'])?add_slashes($_POST['sub_category']):'';
    $status = isset($_POST['status'])?add_slashes($_POST['status']):'';
    $paramArray = array(
      'category_id'=>$category_id,
      'sub_category'=>$sub_category,
      'display_status'=>$status
      );
    //print_r($paramArray); exit();
    if($paramArray){
      $commonFunObj->updateRecord("subcategory","id",$sub_category_id,$paramArray);
      header("location:".$wwwroot."add-sub-category.php?act=esucc");
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
    var category_id = document.getElementById('category_id').value;
    var sub_category = document.getElementById('sub_category').value;
     var status = document.getElementById('status').checked;
      if(status == true){
         document.getElementById('status_value').value="1";
      }
       if(status== false){
         document.getElementById('status_value').value="0";
       }
      if(sub_category == ""){
        document.getElementById('sub_category_error').innerHTML="Please enter  subcategory.";
        return false;
      
  }
}
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
     <!--  <li><a href="#">CCTV</a>
          <ul>
          	<li><a href="product-brand.php">Add Brand</a></li>
          	<li><a href="cctv.php">Add Product</a></li>
          </ul>
      </li> -->
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
    <input type="hidden" name="status" id="status_value" value="">
      <input type="hidden" name="action" value="Edit">
      
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
        <select id="category_id" name="category_id">
             <?php
              if($getCategory>0){
                foreach($getCategory as $showCategory){
                ?>
                  <option value="<?=$showCategory['id']?>" <?php if($category_id==$showCategory['id']){ echo"selected";} ?>><?=$showCategory['category_name']?></option>  
                <?php
              }
            }
             ?>
        </select>
      </div>
    </div>
      <div class="clear"></div>

    <div class="form-raw">
      <div class="form-name">Add Sub Category</div>
      <div class="form-txtfld">
        <input type="text" id="sub_category" name="sub_category" value="<?=$subCateoryName?>" autocomplete="off">
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
         <input type="checkbox" id="status" <?php if($statuss==1){ echo"checked";} ?>>
      </div>      
      <div class="clear"></div>
    </div>
        
    <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width:290px;">
        <input type="submit" class="btn" value="Submit"  onclick="return validation()">
      </div>
    </div>
  </div>
</form>
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