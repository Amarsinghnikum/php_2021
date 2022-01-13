<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);
}
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getCategory = $commonFunObj->getList("category");
$product_id = $_REQUEST['pid'];
if(isset($product_id)){
  $getProduct = $commonFunObj->getList("product",array("id"=>$product_id));
  $getSubcatProduct = $commonFunObj->getList("product_cat_subcat",array("product_id"=>$product_id));
  $category_id = $getProduct[0]['category_id'];
  
  $product_name = $getProduct[0]['product_name'];
 
  $sort_description = $getProduct[0]['sort_description'];
  $content = $getProduct[0]['content'];
  $status = $getProduct[0]['display_status'];
   
    $ProductDescriptionCount = $commonFunObj->rowCount("product_description",array("product_id"=>$product_id));
    $getProductDescription = $commonFunObj->getList("product_description",array("product_id"=>$product_id));
     $title = $getProductDescription[0]['title'];
     $heading = $getProductDescription[0]['heading'];
     $description = $getProductDescription[0]['description'];
     $pdfheading = $getProductDescription[0]['pdfheading'];
     $pdfimage = $getProductDescription[0]['pdfimage']['name'];

     $product_image = $getProduct[0]['product_image']; 
      $UploadPDFCount = $commonFunObj->rowCount("upload_pdf",array("product_id"=>$product_id));
      $getUploadPDF = $commonFunObj->getList("upload_pdf",array("product_id"=>$product_id));  
                
}
if(isset($_POST['action']) && $_POST['action']=="Edit"){
   $category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
    $subcategory_id =  $_REQUEST['subcategory_id'];
    $product_name =  isset($_POST['product_name'])?add_slashes($_POST['product_name']):'';
    $sort_description =  isset($_POST['sort_description'])?add_slashes($_POST['sort_description']):'';
    $content =  $_REQUEST['description'];
    $product_image =  isset($_POST['product_image'])?add_slashes($_POST['product_image']):'';
    // $upload_pdf_heading_1 =  isset($_POST['upload_pdf_heading_1'])?add_slashes($_POST['upload_pdf_heading_1']):'';
    // $upload_pdf_image_1 =  isset($_POST['upload_pdf_image_1'])?add_slashes($_POST['upload_pdf_image_1']):'';  

    $status =  isset($_POST['status'])?add_slashes($_POST['status']):'';
    $title11  = $_POST["title11"];
    $heading11 = $_POST["heading11"];
    $description11 = $_POST["description11"];
    $pdfheading11  = $_POST['pdfheading11'];
    $pdfimage11  = $_POST['pdfimage11'];

    for($i=1;$i<=10;$i++){
      $heading =  $_POST['attributes_heading_'.$i];
      if($heading){
      $description =  $_POST['attributes_description_'.$i];
      $title =  $_POST['attributes_title_'.$i];
      $insertPackageDuration = $db->siri_query($db,"INSERT INTO product_description SET product_id='".$product_id."',heading='".$heading."',
          description='".$description."',title='".$title."'");
      }
  }
    //   if($heading11[0]!=''){
    //   foreach($heading11 as $key=>$val){
    //     $title11t = $title11[$key];
    //     $heading11t = $heading11[$key];
    //     $description11t = $description11[$key];
    //     if(isset($title11t)){
    //      $insertPackageDuration = $db->siri_query($db,"INSERT INTO product_description SET product_id='".$product_id."',heading='".$heading11t."',
    //      description='".$description11t."',title='".$title11t."'");
    //     }
    //   }
    //  }
    //  print_r($pdfheading11); 
    //  echo count($pdfheading11); die();
    for($i=1;$i<=10;$i++){
      $pdfheading =  $_POST['upload_pdf_heading_'.$i];
      if($pdfheading){
      $pdfimage = $_FILES['upload_pdf_image_'.$i]['name'];
      $insertPackageDuration = $db->siri_query($db,"INSERT INTO upload_pdf SET product_id='".$product_id."',pdf_heading='".$pdfheading."',
      pdf_image='".$pdfimage."'");
      }
  }
      // if($pdfheading11[0]!=''){
      //     foreach($pdfheading11 as $key=>$val){
      //       $pdfheading11t = $pdfheading11[$key];
      //       $image11t = $_FILES['image11']['name'][$key];
      //       if(isset($pdfheading11t)){
      //       $insertPackageDuration = $db->siri_query($db,"INSERT INTO upload_pdf SET product_id='".$product_id."', pdf_heading='".$pdfheading11t."', 
      //       pdf_image='".$image11t."'");
      //     }
      //    }
      //  }

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

    if(empty($product_image)){
       $product_image = $getProduct[0]['product_image'];
    }


    $paramArray = array(
      'category_id'=> $category_id,
      'product_name'=> $product_name,
      'sort_description'=> $sort_description,
      'content'=> $content,
      'product_image'=> $product_image,
      'display_status'=> $status
      );
    //print_r($paramArray); exit();
   $insertUpdate = $commonFunObj->updateRecord("product","id",$product_id,$paramArray);
   // if($insertUpdate){ 
        foreach ($getProductDescription as $showproDec) {
        $i = $showproDec['id'];   
        $heading =  isset($_POST['attributes_heading_'.$i])?add_slashes($_POST['attributes_heading_'.$i]):'';
        $description =  isset($_POST['attributes_description_'.$i])?add_slashes($_POST['attributes_description_'.$i]):'';
        $title =  isset($_POST['attributes_title_'.$i])?add_slashes($_POST['attributes_title_'.$i]):'';
        if($title!=''){
            $insertPackageDuration = $db->siri_query($db,"UPDATE  product_description SET heading='".$heading."',description='".$description."',title='".$title."' WHERE  id='".$i."'");
        }
    }
//  }
 // if($insertUpdate){
       foreach ($getUploadPDF as $showproPDF) {
        $i = $showproPDF['id']; 
        $pdf_heading  =  isset($_POST['upload_pdf_heading_'.$i])?add_slashes($_POST['upload_pdf_heading_'.$i]):'';
        $pdf_image = $_FILES['upload_pdf_image_'.$i]['name'];      
      if($pdf_image!=''){      
         $targetfolder = "./PDF/";
         $targetfolder = $targetfolder.$_FILES['upload_pdf_image_'.$i]['name'];
        
         move_uploaded_file($_FILES['upload_pdf_image_'.$i]['tmp_name'], $targetfolder);       
            $insertPackageDuration = $db->siri_query($db,"UPDATE upload_pdf SET pdf_heading='".$pdf_heading."',pdf_image='".$pdf_image."' WHERE  id='".$i."'");
        }else{
          $insertPackageDuration = $db->siri_query($db,"UPDATE upload_pdf SET pdf_heading='".$pdf_heading."' WHERE  id='".$i."'");
        }
      }
//  }
//  if($insertUpdate){
    if(sizeof($subcategory_id)>0){
      
     $commonFunObj->deleteRecord("product_cat_subcat","product_id",$product_id);
      foreach($subcategory_id as $showsubCategory){
        $sub_category_id = $showsubCategory;
        $paramArrayS = array(
          'product_id'=>$product_id,
          'category_id'=>$category_id,
          'sub_category_id'=>$sub_category_id
          );

          $insert = $commonFunObj->insertRecord("product_cat_subcat",$paramArrayS);
      }
    }
   header("location:".$wwwroot."product.php?act=esucc");
 // }
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
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 
function del_more_recordsss(id){
  // if(name == 'attributes'){         
  //     if(document.getElementById('attributes_value_div_'+id).style.display == "block"){
  //     decr1 = id-1;
  //     document.getElementById('attributes_value_div_'+id).style.display = "none";
  //     document.getElementById('attributes_heading_div_'+id).style.display = "none";
  //      document.getElementById('newBox_2_'+decr1).style.display = "none"; 
  //     document.getElementById('cancel_2_'+decr1).style.display = "block";   
  //     return false;
  //   }
  // }
  //alert(id);
  $.ajax({  
          type: "POST",  
          url: "ajax_delete1.php", 
          data: {id:id},
          success: function(response){
            window.location.reload();
           //alert(response);
          }
        });
}

  function add_more_record_pdf(add,val){
  if(val == 2){
    for(var i=1; i<=3;i++){
    add_incr = i+1;
    add_decr = i-1;
      if(document.getElementById('attributes_value_div_pdf_heading_'+i).style.display == "none"){
        document.getElementById('newBox_3_'+i).style.display = "none";
        document.getElementById('attributes_value_div_pdf_heading_'+i).style.display = "block";

        document.getElementById('newBox_3_'+i).style.display = "block";
        document.getElementById('cancel_3_'+i).style.display = "block";
        document.getElementById('cancel_3_'+add_decr).style.display = "none";
        return false;
      }
    }
  }
}
function del_more_record_pdf(name,id){
  // if(name == 'attributes'){         
  //     if(document.getElementById('attributes_value_div_pdf_heading_'+id).style.display == "block"){
  //     decr1 = id-1;
  //     document.getElementById('attributes_value_div_pdf_heading_'+id).style.display = "none";
  //      document.getElementById('newBox_3_'+decr1).style.display = "none"; 
  //     document.getElementById('cancel_3_'+decr1).style.display = "block";   
  //     return false;
  //   }
  // }
//alert(id);
 $.ajax({  
        type: "POST",  
        url: "ajax_delete2.php", 
        data: {id:id},
        success: function(response){
          window.location.reload();
         //alert(response);
        }
    });
}


$(document).ready(function($){
    var _content = $('textarea[name=description]').get(0);
    var basePath = "http://localhost/PHP-Test/";
    var editor = CKEDITOR.replace( _content,{
        height: 400,
        filebrowserBrowseUrl : basePath + 'kcfinder/browse.php?type=files',
        filebrowserImageBrowseUrl : basePath + 'kcfinder/browse.php?type=images',
        filebrowserFlashBrowseUrl : basePath + 'kcfinder/browse.php?type=flash',
        filebrowserUploadUrl : basePath + 'kcfinder/upload.php?type=files',
        filebrowserImageUploadUrl : basePath + 'kcfinder/upload.php?type=images',
        filebrowserFlashUploadUrl : basePath + 'kcfinder/upload.php?type=flash',
    on:{
      instanceReady: function() {
          this.document.appendStyleSheet('<?=$wwwroot?>css/style.css');
        },
    },
  contentsCss :['<?=$wwwroot?>css/style.css'],
    });
  editor.config.allowedContent = true;
  editor.config.removeFormatAttributes = '';
});
</script>
 <script>
   function validation(){

    var category_id = document.getElementById('category_id').value;
    var product_name = document.getElementById('product_name').value;
    var sort_description = document.getElementById('sort_description').value;
    var product_image = document.getElementById('product_image');
    var status = document.getElementById('status').checked;
    
    if(category_id ==" "){
         document.getElementById('category_id_error').innerHTML="please select category";
         return false;
      }
     if(product_name ==""){
         document.getElementById('product_name_error').innerHTML="please enter product name";
         return false;
      }
      
      if(status == true){
        document.getElementById('status_value').value="1";
      }
       if(status== false){
          document.getElementById('status_value').value="0";
       }
       
        if(sort_description ==""){
         document.getElementById('sort_description_error').innerHTML="please enter sort desrciption";
            return false;
      }
       if(upload_pdf_heading_1 ==" "){
         document.getElementById('upload_pdf_heading_error').innerHTML="please enter pdf heading";
            return false;
      }  
  }
  function showDataC(){
    $(document).ready(function() {
        var response = '';
        $.ajax({
            type: "GET",
            url: "ajaxproductshow.php",
            dataType: "html",
            success: function(response) {
                $("#showdata").html(response); 
            }
        });
    });
  }
   showDataC();
   
  function CategoriesChange(){

    $(document).ready(function() {
    var category_id = document.getElementById("category_id").value;
    var parameters="category_id="+category_id+"&action=getSubCategory";
     $.ajax({  
          type: "POST",  
          url: "subCategoryResult.php", 
          data: parameters,
          success: function(response) {
                $("#showSubcat").html(response); 
            }
        });
     });
  }
  //CategoriesChange();
</script>
<script type="text/javascript">
   function add_more_record1(add,val){
  if(val == 2){
    for(var i=1; i<=10;i++){
    add_incr = i+1;
    add_decr = i-1;
      if(document.getElementById('attributes_value_div_'+i).style.display == "none"){
        document.getElementById('newBox_2_'+i).style.display = "none";
        document.getElementById('attributes_value_div_'+i).style.display = "block";
        document.getElementById('attributes_heading_div_'+i).style.display = "block";

        document.getElementById('newBox_2_'+i).style.display = "block";
       // document.getElementById('newBox_2_'+add_incr).style.display = "block";
        document.getElementById('cancel_2_'+i).style.display = "block";
        document.getElementById('cancel_2_'+add_decr).style.display = "none";
        return false;
      }
    }
  }
}
function del_more_record1(name,id){
  if(name == 'attributes'){         
      if(document.getElementById('attributes_value_div_'+id).style.display == "block"){
      decr1 = id-1;
      document.getElementById('attributes_value_div_'+id).style.display = "none";
      document.getElementById('attributes_heading_div_'+id).style.display = "none";
       document.getElementById('newBox_2_'+decr1).style.display = "none"; 
      document.getElementById('cancel_2_'+decr1).style.display = "block";   
      return false;
    }
  }
}
</script>
</head>
<body>
  <?php include("include/header.php"); ?>
<nav>
  <ul id="qm0" class="qmmc">
    <li><a href="admin.php">Dashboard</a></li>
      
<li><a href="#" class="qmactive">Product</a>
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
    <h1>Add Product</h1>
     <span id="msg"></span>
    <br>
    <form id="product_form" name="product_form" enctype="multipart/form-data" method="post">
     <input type="hidden" name="status" id="status_value" value="">
     <input type="hidden" name="action" id="action" value="Edit">
    <div class="form-raw">
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
         <select id="category_id" onchange="CategoriesChange()" name="category_id">
             <option value=" ">Select Option</option>
             <?php
              if($getCategory>0){
                foreach($getCategory as $showCategory){
                ?>
                  <option value="<?=$showCategory['id']?>" <?php if($showCategory['id']==$category_id){ echo"selected";} ?>><?=$showCategory['category_name']?></option>  
                <?php
              }
            }
             ?>
        </select>
        <br><br><span id="category_id_error"></span>
      </div>
    </div>
      <div class="clear"></div>

        <div class="form-raw">
      <div class="form-name">Select Sub Category</div>
      <div id="showSubcat">
        <?php
        $getSubCategory = $commonFunObj->getList("subcategory", array("category_id"=>$category_id));
       foreach($getSubcatProduct as $key=>$val){
        $subcategory[$key] = $val['sub_category_id'];
       }
        ?>
            <div class="form-txtfld">
              <select multiple style="height: 100px;" id="subcategory_id" name="subcategory_id[]" >
                  
                   <?php
                    if($getSubCategory>0){
                      foreach($getSubCategory as $key=>$showsubCategory){
                      ?>
                        <option value="<?=$showsubCategory['id']?>" <?php if(in_array($showsubCategory['id'],$subcategory)){echo "Selected=='selected'";} ?>><?=$showsubCategory['sub_category']?></option>  
                      <?php
                    }
                  }
                   ?>
              </select>
              
            </div>
       <?php
        //}
      ?>
      </div>
    </div>
      <div class="clear"></div>
    
    <div class="form-raw">
      <div class="form-name">Product Name</div>
      <div class="form-txtfld">
        <input type="text" id="product_name" name="product_name" value="<?=$product_name?>">
        <br><br><span id="product_name_error"></span>
      </div>
    </div>
    
    <div class="form-name">Product Image1</div>
    <div class="form-txtfld">
      <input type="file" id="product_image"  onchange="checkPhoto(this)" name="product_image"><div><?=$product_image ?></div>
      <div class="form-name" id="photoLabel"> Image Size (Product page)</div>
    </div>
  </div>
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Short Description</div>
    <div class="form-txtfld">
      <textarea id="sort_description" name="sort_description"><?=$sort_description?></textarea>
      <br><br><br><br><br><br><br><br><span id="sort_description_error"></span>
    </div>
  </div>
  
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Description</h1>
  <br>  
     <?php for($i=1;$i<=10;$i++){ ?>
  <div class="form-raw" id="attributes_value_div_<?=$i?>" <?php if($i==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>
      <div class="form-name">Title <?=$i?></div>
      <div class="form-txtfld">
        <input type="text" id="attributes_title_<?=$i?>" name="attributes_title_<?=$i?>" autocomplete="off">
      </div>
    </div>
  <div class="form-raw" id="attributes_heading_div_<?=$i?>" <?php if($i==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_heading_<?=$i?>" name="attributes_heading_<?=$i?>" placeholder="heading"></div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_description_<?=$i?>" name="attributes_description_<?=$i?>" placeholder="desciption"></div>
      <?php  if($i!=1){ ?>
      <div class="collom" id="cancel_2_<?=$i?>" style="display:block;">
        <a href="javascript:void(0);" onclick="return del_more_record('attributes','<?=$i?>');"><img src="images/delete.gif" alt=""></a>
      </div>
    <?php } ?>
  </div>
  <div class="form-raw"  id="newBox_2_<?=$i?>" <?php if($i!=1){ echo"style='display:none;'";} ?> >
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="javascript:void(0);" onclick="return add_more_record('<?=$i?>',2);">Add More +</a></div>
  </div>
  
    <?php } ?>
    <br>

    <!-- <div class="form-raw">
      <div class="form-name">Title 10</div>
      <div class="form-txtfld">
        <input type="text" name="title11[]" multiple="" value="">
      </div>
    </div>

  <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" multiple="" placeholder="Heading" name="heading11[]" value=""></div>
      <div class="form-txtfld txtfld50"><input type="text" multiple="" placeholder="Desciption" name="description11[]" value=""></div>
  </div>
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;">
        <a href="javascript:void(0)" class="add-more-form">Add More +</a></div>
        <div class="paste-new-forms"></div> -->

     <?php $j=1;
      foreach($getProductDescription as $showproDec){
        $i = $showproDec['id'];
       ?>
  <div class="form-raw" id="attributes_value_div_<?=$i?>">
      <div class="form-name">Title <?=$j?></div>
      <div class="form-txtfld">
        <input type="text" id="attributes_title_<?=$i?>" name="attributes_title_<?=$i?>" autocomplete="off" value="<?=$showproDec['title']?>">
      </div>
    </div>
  <div class="form-raw" id="attributes_heading_div_<?=$i?>">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_heading_<?=$i?>" name="attributes_heading_<?=$i?>" placeholder="heading" value="<?=$showproDec['heading']?>"></div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_description_<?=$i?>" name="attributes_description_<?=$i?>" placeholder="desciption" value="<?=$showproDec['description']?>"></div>
      <div class="collom" id="cancel_3_<?=$j?>" style="display:block;">
        <a href="javascript:void(0);" id="add-more-form" onclick="del_more_recordsss(<?=$i?>)"><img src="images/delete.gif" alt=""></a>       
      </div>
  </div>

    <?php $j++; } ?>
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Features</h1>
    <br>  
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Content</div>
    <div class="form-txtfld" style="width:780px;">
      <textarea  name="description" id="description"><?=$content?></textarea>
    </div>
  </div>
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Upload PDF</h1>
    <br> 
    
    <?php for($j=1;$j<=3;$j++){ ?>
    <div class="form-raw" id="attributes_value_div_pdf_heading_<?=$j?>" <?php if($j==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" id="upload_pdf_heading_<?=$j?>" name="upload_pdf_heading_<?=$j?>" placeholder="PDF heading"></div>
      <div class="form-txtfld txtfld50"><input type="file" name="upload_pdf_image_<?=$j?>" id="upload_pdf_image_<?=$j?>" placeholder="desciption"></div>
      <?php  if($j!=1){ ?>
        <div class="collom" id="cancel_3_<?=$j?>" style="display:block;">
        <a href="javascript:void(0);" onclick="return del_more_record_pdf('attributes','<?=$j?>');"><img src="images/delete.gif" alt=""></a>
      </div>
      <?php }?>
  </div>

  <div class="form-raw"  id="newBox_3_<?=$j?>" <?php if($j!=1){ echo"style='display:none;'";} ?>>
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="javascript:void(0);" onclick="return add_more_record_pdf('<?=$j?>',2);">Add More +</a></div>
  </div>

  <?php } ?>
    <!-- <div class="form-raw">
        <div class="form-name">&nbsp;</div>
        <div class="form-txtfld txtfld50">        
    <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading" name="pdfheading11[]" multiple value="" ></div>
</div>
  <div class="form-txtfld txtfld50"><input type="file" placeholder="description" name="image11[]" multiple value=""></div>
  </div>
  <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="javascript:void(0)" class="add-more-form2">Add More +</a></div>
<div class="paste-new-forms2"></div>
  </div>  -->

<?php $j=1;
foreach($getUploadPDF as $shoepdf){ 
    $j = $shoepdf['id'];
  ?>
<div class="form-raw" id="attributes_value_div_pdf_heading_<?=$j?>">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" id="upload_pdf_heading_<?=$j?>" name="upload_pdf_heading_<?=$j?>" placeholder="PDF heading" value="<?=$shoepdf['pdf_heading']?>" required></div>
      <div class="form-txtfld txtfld50"><input type="file" id="upload_pdf_image_<?=$j?>" name="upload_pdf_image_<?=$j?>" placeholder="desciption" ><div><?=$shoepdf['pdf_image']?></div>
      <div class="collom" id="cancel_3_<?=$j?>" style="display:block; float:right;">
        <a href="javascript:void(0);" id="add-more-form2" onclick="return del_more_record_pdf('attributes','<?=$j?>');"><img src="images/delete.gif" alt=""></a>
      </div>
    </div>
  </div>

<?php } ?>
<div id="upload_pdf_heading_error"></div>  
  
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">Active</div>
    <div class="form-txtfld">
      <input type="checkbox" id="status" <?php if($status==1){ echo"checked";} ?>>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">&nbsp;</div>
    <div class="form-txtfld">
      <input type="submit" class="btn" value="Submit" onclick="return validation()">
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
      <a href="https://www.akswebsoft.com/" target="_blank" style="float:right;"> <img src="images/akslogo.png" alt="AKS Websoft Consulting Pvt. Ltd." title="AKS Websoft Consulting Pvt. Ltd."></a>
      <div class="clear"></div>
    </div>
  </footer>
</footer>
</body>
</html>
<script>
      
      function checkPhoto(target) {
          if(target.files[0].type.indexOf("image") == -1) {
              document.getElementById("photoLabel").innerHTML = "File not supported";
              return false;
          }
          var imgWidth = $('#product_image').width();
           var imgHeight = $('#product_image').height();
           if(imgWidth > 560 || imgHeight > 390){
           document.getElementById("photoLabel").innerHTML = "Image Size is large";
          }
          document.getElementById("photoLabel").innerHTML = "";
          return true;
      }
</script>

<script>
    $(document).ready(function(){

    $(document).on('click','.remove', function(){
        $(this).closest('#more-form').remove();
    });

        $(document).on('click', '.add-more-form', function(){
            $('.paste-new-forms').append('<div id="more-form"><div class="form-raw" style="display:block;">\
      <div class="form-name">Title 1</div>\
      <div class="form-txtfld">\
        <input type="text" name="title11[]" multiple style="display:block;">\
      </div>\
    </div>\
  <div class="form-raw">\
      <div class="form-name">&nbsp;</div>\
      <div class="form-txtfld txtfld50"><input type="text" placeholder="Heading" name="heading11[]" multiple style="display:block;" ></div>\
      <div class="form-txtfld txtfld50"><input type="text" placeholder="Desciption" name="description11[]" multiple style="display:block;"></div>\
      <a href="javascript:void(0)" class="remove"><img src="images/delete.gif" alt=""></a>\
  </div>\
        </div></div>');
        });
    });
</script>
<!--*********************************************************************************************-->

<script>
    $(document).ready(function(){

    $(document).on('click','.remove', function(){
        $(this).closest('#more-form2').remove();
    });

        $(document).on('click', '.add-more-form2', function(){
            $('.paste-new-forms2').append('<div id="more-form2"><div class="form-raw" style="display:block;">\
        <div class="form-name">&nbsp;</div>\
        <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading" name="pdfheading11[]" multiple style="display:block;"></div>\
        <div class="form-txtfld txtfld50"><input type="file" placeholder="desciption" name="image11[]" multiplestyle="display:block;"></div>\
        <a href="javascript:void(0)" class="remove"><img src="images/delete.gif" alt=""></a>\
  </div></div>');
        });
    });
</script>
<script>
   function add_more_record(add,val){
  if(val == 2){
    for(var i=1; i<=10;i++){
    add_incr = i+1;
    add_decr = i-1;
      if(document.getElementById('attributes_value_div_'+i).style.display == "none"){
        document.getElementById('newBox_2_'+i).style.display = "none";
        document.getElementById('attributes_value_div_'+i).style.display = "block";
        document.getElementById('attributes_heading_div_'+i).style.display = "block";

        document.getElementById('newBox_2_'+i).style.display = "block";
       // document.getElementById('newBox_2_'+add_incr).style.display = "block";
        document.getElementById('cancel_2_'+i).style.display = "block";
        document.getElementById('cancel_2_'+add_decr).style.display = "none";
        return false;
      }
    }
  }
}
function del_more_record(name,id){
  if(name == 'attributes'){         
      if(document.getElementById('attributes_value_div_'+id).style.display == "block"){
      decr1 = id-1;
      document.getElementById('attributes_value_div_'+id).style.display = "none";
      document.getElementById('attributes_heading_div_'+id).style.display = "none";
       document.getElementById('newBox_2_'+decr1).style.display = "none"; 
      document.getElementById('cancel_2_'+decr1).style.display = "block";   
      return false;
    }
  }
}
</script>
<!--*****************************************************************************************-->