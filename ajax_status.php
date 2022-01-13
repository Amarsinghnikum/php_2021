<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();


if(isset($_POST['action']) && $_POST['action']=="categoryStatus"){
	$category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
	$getCategory = $commonFunObj->getList("category",array("id"=>$category_id));
	if($getCategory[0]['display_status']==1){
		$status = 0;
	}else if($getCategory[0]['display_status']==0){
		$status = 1; 
	}
	$commonFunObj->updateRecord("category","id",$category_id,array("display_status"=>$status));
	echo "succ";
exit();
}
if(isset($_POST['action']) && $_POST['action']=="subcategoryStatus"){
	$sub_category_id = isset($_POST['sub_category_id'])?add_slashes($_POST['sub_category_id']):'';
	$getsubCategory = $commonFunObj->getList("subcategory",array("id"=>$sub_category_id));
	if($getsubCategory[0]['display_status']==1){
		$status = 0;
	}else if($getsubCategory[0]['display_status']==0){
		$status = 1; 
	}
	$commonFunObj->updateRecord("subcategory","id",$sub_category_id,array("display_status"=>$status));
	echo "succ";
exit();
}
if(isset($_POST['action']) && $_POST['action']=="productStatus"){
	$product_id = isset($_POST['product_id'])?add_slashes($_POST['product_id']):'';
	$getproduct = $commonFunObj->getList("product",array("id"=>$product_id));
	if($getproduct[0]['display_status']==1){
		$status = 0;
	}else if($getproduct[0]['display_status']==0){
		$status = 1; 
	}
	$commonFunObj->updateRecord("product","id",$product_id,array("display_status"=>$status));
	echo "succ";
exit();
}