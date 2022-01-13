<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();


	 $id = $_REQUEST['id'];
	$commonFunObj->deleteRecord("product_description","id",$id);
echo"succ";
	exit();

?>