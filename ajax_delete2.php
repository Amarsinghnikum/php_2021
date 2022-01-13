<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();


	 $id = $_REQUEST['id'];
	$commonFunObj->deleteRecord("upload_pdf","id",$id);
echo"succ";
	exit();

?>