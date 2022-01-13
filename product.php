<?php
session_start();
include_once "management/includes/pro_api_db.php";

if(!isset($_SESSION['frnt_ss_usr'])){
 header("location:".$wwwroot);
}
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getCategory = $commonFunObj->getList("category",array('display_status'=>1));

$getSubCategory = $commonFunObj->getList("subcategory",array('display_status'=>1));

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

$(document).ready(function($){
    var _content = $('textarea[name=content]').get(0);

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

   function validation(){
    var category_id = document.getElementById('category_id').value;
    var product_name = document.getElementById('product_name').value;
    var sort_description = document.getElementById('sort_description').value;
    var product_image = document.getElementById('product_image');
    var content = document.getElementById('content').value;
    var attributes_heading_1 = document.getElementById('attributes_heading_1').value;
    var attributes_description_1 = document.getElementById('attributes_description_1').value;
    var attributes_title_1 = document.getElementById('attributes_title_1').value;
    var upload_pdf_heading_1 = document.getElementById('upload_pdf_heading_1').value;
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
       
        if(sort_description ==" "){
         document.getElementById('sort_description_error').innerHTML="please enter sort desrciption";
           return false;
      }
      if(attributes_title_1==" "){
        document.getElementById('attributes_title_error').innerHTML="please enter title";
          return false;
      }
       if(upload_pdf_heading_1 ==" "){
         document.getElementById('upload_pdf_heading_error').innerHTML="please enter pdf heading";
            return false;
      }//else{  
  //       var parameters = "";
  //       parameters = "category_id="+category_id+"&subcategory_id="+subcategory_id+"&product_name="+product_name+"&sort_description="+sort_description+"&content="+content+"&product_image="+product_image+"&attributes_heading_1="+attributes_heading_1+"&attributes_description_1="+attributes_description_1+"&attributes_title_1="+attributes_title_1+"&upload_pdf_heading_1="+upload_pdf_heading_1+"&upload_pdf_image_1="+upload_pdf_image_1+"&status="+status+"&action=productadd";
  //      // alert(parameters);
  //       $.ajax({  
  //         type: "POST",  
  //         url: "ajax_register_login.php", 
  //         data: parameters,
  //         success: function(response){
  //          // alert(response)
  //           if(response == "succ"){
  //             showDataC();
  //             $('#product_name').val("");
  //             $('#sort_description').val("");
              
  //             document.getElementById("msg").innerHTML="Added category successfull..."; 
  //           }
           
  //         }
  //       });
  //     }  
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

        //alert(response);
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
  CategoriesChange();
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
  if(name == 'attributes'){         
      if(document.getElementById('attributes_value_div_pdf_heading_'+id).style.display == "block"){
      decr1 = id-1;
      document.getElementById('attributes_value_div_pdf_heading_'+id).style.display = "none";
      // document.getElementById('newBox_3_'+decr1).style.display = "none"; 
      document.getElementById('cancel_3_'+decr1).style.display = "block";   
      return false;
    }
  }
}

  </script>

<script>
  $(document).ready(function(){
    $("#product_form").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'productSave.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData:false,
            success: function(data) {
              alert(data);
                $("#product_form")[0].reset();
                document.getElementById("msg").innerHTML="Added product successfull...";
                showDataC();
            }
        });

    });

});
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

      <!--    
      <li><a href="#">CCTV</a>
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
    <h1>Add Product</h1>
     <span id="msg"><?php if($_REQUEST['act']=='esucc'){
        echo"product update successfull...";
     }?></span>
    <br>
    <form id="product_form" name="product_form" enctype="multipart/form-data" method="post">
     <input type="hidden" name="status" id="status_value" value="">
    <div class="form-raw">
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
         <select id="category_id" onchange="CategoriesChange()" name="category_id">
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
        <br><br><span id="category_id_error"></span>
      </div>
    </div>
      <div class="clear"></div>


        <div class="form-raw">
      <div class="form-name">Select Sub Category</div>
      <div id="showSubcat"></div>
    </div>
      <div class="clear"></div>
    
    
    
    <div class="form-raw">
      <div class="form-name">Product Name</div>
      <div class="form-txtfld">
        <input type="text" id="product_name" name="product_name">
        <br><br><span id="product_name_error"></span>
      </div>
    </div>
    
    <div class="form-name">Product Image1</div>
    <div class="form-txtfld">
      <input type="file" id="product_image"  onchange="checkPhoto(this)" name="product_image">
      <div class="form-name" id="photoLabel"> Image Size ( Width=560px, Height=390px ) (Product page)</div>
    </div>
  </div>
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Short Description</div>
    <div class="form-txtfld">
      <textarea id="sort_description" name="sort_description"></textarea>
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
    <br><br><div id="attributes_title_error"></div>
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Features</h1>
    <br>  
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Content</div>
    <div class="form-txtfld" style="width:780px;">
      <textarea name="content" id="content"></textarea>
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
<br><br>
<div id="upload_pdf_heading_error"></div>
  
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">Active</div>
    <div class="form-txtfld">
      <input type="checkbox" id="status">
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
<div id="wrap2">
 <div id="showdata"></div>
  
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