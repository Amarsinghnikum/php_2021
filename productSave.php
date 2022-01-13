<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
 
if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!=""){
	$category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
    $subcategory_id =  $_REQUEST['subcategory_id'];
    $product_name =  isset($_POST['product_name'])?add_slashes($_POST['product_name']):'';
    $sort_description =  isset($_POST['sort_description'])?add_slashes($_POST['sort_description']):'';
    $product_image =  isset($_POST['product_image'])?add_slashes($_POST['product_image']):'';

    $content =  isset($_POST['content'])?add_slashes($_POST['content']):'';

    $upload_pdf_heading_1 =  isset($_POST['upload_pdf_heading_1'])?add_slashes($_POST['upload_pdf_heading_1']):'';
    $upload_pdf_image_1 =  isset($_POST['upload_pdf_image_1'])?add_slashes($_POST['upload_pdf_image_1']):'';
    $status =  isset($_POST['status'])?add_slashes($_POST['status']):'';

    $img = "product_image";
        if($_FILES[$img]["size"] >1 && $_FILES[$img]["name"]!=""){  
            $imagesize = getimagesize($_FILES[$img]["tmp_name"]);
            $image_mime_type_array = array('image/gif','image/jpeg','image/png');
            if ( ( ($_FILES[$img]['type']=="image/gif") || ($_FILES[$img]['type']=="image/pjpeg") || ($_FILES[$img]['type']=="image/jpeg") || ($_FILES[$img]['type']=="image/png") ) && in_array($imagesize['mime'],$image_mime_type_array ) ){
                if(!preg_match("/(.+)\.(.*?)\Z/", $_FILES[$img]["name"], $r)){}
                $filesize = ceil(filesize($_FILES[$img]['tmp_name'])/1024);

                $tget = "./product_image/";
                if(move_uploaded_file($_FILES[$img]['tmp_name'], $tget.$_FILES[$img]['name'])){
                    $product_image = $_FILES[$img]['name'];
                }
            }
           
    }
        $i=0;
    foreach($subcategory_id as $subId){
            $subCatId .= $subId.",";
    }
   
    $paramArray = array(
    	'category_id'=> $category_id,
    	'product_name'=> $product_name,
    	'sort_description'=> $sort_description,
    	'product_image'=> $product_image,
        'content'=> $content,
    	'display_status'=> $status
    	);

    
   $insertRecord = $commonFunObj->insertRecord("product",$paramArray);
    if($insertRecord){ 
        for($i=1;$i<=10;$i++){
        $heading =  isset($_POST['attributes_heading_'.$i])?add_slashes($_POST['attributes_heading_'.$i]):'';
        $description =  isset($_POST['attributes_description_'.$i])?add_slashes($_POST['attributes_description_'.$i]):'';
        $title =  isset($_POST['attributes_title_'.$i])?add_slashes($_POST['attributes_title_'.$i]):'';
        if($title!=''){
            $insertPackageDuration = $db->siri_query($db,"INSERT INTO product_description SET product_id='".$insertRecord."',heading='".$heading."',description='".$description."',title='".$title."'");
        }
    }
  }
  if($insertRecord){
        for($i=1;$i<=3;$i++){
        $pdf_heading  =  isset($_POST['upload_pdf_heading_'.$i])?add_slashes($_POST['upload_pdf_heading_'.$i]):'';
        $pdf_image =  isset($_POST['upload_pdf_image_'.$i])?add_slashes($_POST['upload_pdf_image_'.$i]):'';
        $pdf_image = $_FILES['upload_pdf_image_'.$i]['name'];
        
        if($pdf_heading!=''){
            $insertPackageDuration = $db->siri_query($db,"INSERT INTO upload_pdf SET product_id='".$insertRecord."',pdf_heading='".$pdf_heading."',pdf_image='".$pdf_image."'");
        }
    }
  }
  if($insertRecord){
    foreach($subcategory_id as $SubId){
        $sub_category_id = $SubId;
    
     $paramArrayS = array(
        'product_id'=>$insertRecord,
        'category_id'=>$category_id,
        'sub_category_id'=>$sub_category_id
        );

        $insert = $commonFunObj->insertRecord("product_cat_subcat",$paramArrayS);
    }
        if($insert){
             echo"succ";
        }
  }
}
?>