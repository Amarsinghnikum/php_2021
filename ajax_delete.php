<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();


if(isset($_POST['action']) && $_POST['action']=="categoryDel"){
	 $category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';

	$commonFunObj->deleteRecord("category","id",$category_id);
	echo"succ";
	exit();
}

if(isset($_POST['action']) && $_POST['action']=="subcategoryDel"){
	 $subcategory_id = isset($_POST['subcategory_id'])?add_slashes($_POST['subcategory_id']):'';

	$commonFunObj->deleteRecord("subcategory","id",$subcategory_id);
	echo"succ";
	exit();
}
if(isset($_POST['action']) && $_POST['action']=="productDel"){
	 $productId = isset($_POST['productId'])?add_slashes($_POST['productId']):'';

	$commonFunObj->deleteRecord("product","id",$productId);
	$commonFunObj->deleteRecord("product_description","product_id",$productId);
	$commonFunObj->deleteRecord("upload_pdf","product_id",$productId);
	$commonFunObj->deleteRecord("product_cat_subcat","product_id",$productId);
	echo"succ";
	exit();
}
?>