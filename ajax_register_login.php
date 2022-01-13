<?php
session_start();

include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$usersObj = new Users();

if(isset($_POST['action']) && $_POST['action']=="login"){
    $email = isset($_POST['email'])?add_slashes($_POST['email']):'';
	$password = isset($_POST['password'])?add_slashes($_POST['password']):'';
	$userData = $usersObj->getList(array("login_count"=>$email),array(),array(),array());
	$countUsersEmail = $usersObj->fieldCount(array('login_count'=>$email));
	$countdisplayStatus = $usersObj->fieldCount(array('login_count'=>$email,'display_status'=>"1"));

	if(empty($email)){
		echo "emptyEmail";
	}elseif(empty($password)){
		echo "emptyPassword";
	}elseif($countUsersEmail == 0){
		echo "emailNotExists";
	}elseif($countdisplayStatus == 0){
		echo "userNotActive";
	}else{
		if(crypt($password,$userData[0]['password']) == $userData[0]['password'])
		{
			$_SESSION['frnt_ss_usr']		 = $userData[0]['user_id'];
			$_SESSION["frnt_first_name"]     = $userData[0]['name'];
			$_SESSION["frnt_usr_email"]		 = $userData[0]['email'];
			
			echo "success";
		}else{
			echo "passwordNotMatch";
		}
		exit();
	}
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="categoryadd"){
  	$category = isset($_POST['category'])?add_slashes($_POST['category']):'';
    $status =  isset($_POST['status'])?add_slashes($_POST['status']):'';
    $paramArray = array(
    	'category_name'=> $category,
    	'display_status'=> $status
    	);

	$insertRecord = $commonFunObj->insertRecord("category",$paramArray);
	if($insertRecord){
		echo"succ";
	}
 exit();
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="categorySubadd"){
	$category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
    $sub_category =  isset($_POST['sub_category'])?add_slashes($_POST['sub_category']):'';
    $status =  isset($_POST['status'])?add_slashes($_POST['status']):'';
    
    $paramArray = array(
    	'category_id'=> $category_id,
    	'sub_category'=> $sub_category,
    	'display_status'=> $status
    	);

	$insertRecord = $commonFunObj->insertRecord("subcategory",$paramArray);
	if($insertRecord){
		echo"succ";
	}
 exit();
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=="productadd"){
	$category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
    $sub_category_id =  isset($_POST['subcategory_id'])?add_slashes($_POST['subcategory_id']):'';
    $product_name =  isset($_POST['product_name'])?add_slashes($_POST['product_name']):'';
    $sort_description =  isset($_POST['sort_description'])?add_slashes($_POST['sort_description']):'';
    $content =  isset($_POST['content'])?add_slashes($_POST['content']):'';
    $product_image =  isset($_POST['product_image'])?add_slashes($_POST['product_image']):'';
    $attributes_heading_1 =  isset($_POST['attributes_heading_1'])?add_slashes($_POST['attributes_heading_1']):'';
    $attributes_description_1 =  isset($_POST['attributes_description_1'])?add_slashes($_POST['attributes_description_1']):'';
    $attributes_title_1 =  isset($_POST['attributes_title_1'])?add_slashes($_POST['attributes_title_1']):'';
    $upload_pdf_heading_1 =  isset($_POST['upload_pdf_heading_1'])?add_slashes($_POST['upload_pdf_heading_1']):'';
    
    $upload_pdf_image_1 =  isset($_POST['upload_pdf_image_1'])?add_slashes($_POST['upload_pdf_image_1']):'';
    
    $status =  isset($_POST['status'])?add_slashes($_POST['status']):'';
    
    $paramArray = array(
    	'category_id'=> $category_id,
    	'sub_category_id'=> $sub_category_id,
    	'product_name'=> $product_name,
    	'sort_description'=> $sort_description,
    	'content'=> $content,
    	'product_image'=> $product_image,
    	'sort_description'=> $attributes_heading_1,
    	'title'=> $attributes_description_1,
    	'heading'=> $attributes_title_1,
    	'description'=> $upload_pdf_heading_1,
    	'upload_pdf_heading'=> $upload_pdf_image_1,
    	'upload_pdf_image'=> $status
    	
    	);

	$insertRecord = $commonFunObj->insertRecord("product",$paramArray);
	if($insertRecord){
		echo"succ";
	}
 exit();
}
if(isset($_POST['req_action']) && $_POST['req_action']=='edit-profile')
{
	$login_user_id = $_SESSION['frnt_ss_usr'];
    $old_password = isset($_POST['oldpassword'])?add_slashes($_POST['oldpassword']):'';
    $new_password = isset($_POST['newpassword'])?add_slashes($_POST['newpassword']):'';
    $confirm_password = isset($_POST['confirmpassword'])?add_slashes($_POST['confirmpassword']):'';
    $user_id = $_SESSION['frnt_ss_usr'];
    if(!empty($user_id)){
        //$user_count = $usersObj->fieldCountForEdit(array('user_id'=>$user_id));
        $userData = $usersObj->getList(array("user_id"=>$user_id),array(),array(),array()); 
    }   
    
    if(crypt($old_password,$userData[0]['password']) != $userData[0]['password']){
        //$err_msg = "Old Password is incorrect.";
        $err_msg = "err";
    }elseif($new_password!='' && $confirm_password!='' && $new_password!=$confirm_password){
        $err_msg = "Password and confirm password must be same !";
        $err_msg;

    }
    else
    {   
        //$user_param = array('first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'phone_number'=>$phone_number);

        if($new_password!=''){
            $rendomPassword = randomPassword();

            $encoded_password = crypt($new_password,$rendomPassword);

            $user_param['password'] = $encoded_password;
        }
        
        $updt = $usersObj->updateUserDetail($user_param,$login_user_id);   
        if($updt){
           // $db->redirect($wwwroot."profile?act=updtss");
        	  echo "succ";
        }
    }
    
}
?>