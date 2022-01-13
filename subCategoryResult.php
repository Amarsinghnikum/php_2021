<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();

  $category_id = isset($_POST['category_id'])?add_slashes($_POST['category_id']):'';
  $getSubCategory = $commonFunObj->getList("subcategory", array("category_id"=>$category_id,'display_status'=>1));

  ?>
      <div class="form-txtfld">
        <select multiple style="height: 100px;" id="subcategory_id" name="subcategory_id[]" >
            
             <?php
              if($getSubCategory>0){
                foreach($getSubCategory as $showsubCategory){
                ?>
                  <option value="<?=$showsubCategory['id']?>" ><?=$showsubCategory['sub_category']?></option>  
                <?php
              }
            }
             ?>
        </select>
        
      </div>
 <?php
  //}
?>
