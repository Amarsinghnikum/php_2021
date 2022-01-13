<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getProduct = $commonFunObj->getList("product");
?>
<script>
	function statusChange(pid){
		var product_id = pid;
	 parameters = "product_id="+product_id+"&action=productStatus";
		$.ajax({  
	          type: "POST",  
	          url: "ajax_status.php", 
	          data: parameters,
	          success: function(response){
	          	//alert(response);
	            if(response == "succ"){
	              showDataC();
	             
	              document.getElementById("msg").innerHTML="Update product status successfull..."; 
	            }
	           
	          }
        });
	}
	function deleteCategory(pid){
		alert("Are you sure delete product.");
		var productId = pid;
		 var parameters = "";
	        parameters = "productId="+productId+"&action=productDel";
	        //alert(parameters);
	        $.ajax({  
	          type: "POST",  
	          url: "ajax_delete.php", 
	          data: parameters,
	          success: function(response){
	            if(response == "succ"){
	              showDataC();
	              
	            }
	           
	          }
        });
	}
</script>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="53" align="left" valign="middle">Sr.No.</th>
      <th width="153" align="left" valign="middle">Select Category</th>
      <th width="71" align="left" valign="middle"> Select Sub Category</th>
     <th width="71" align="left" valign="middle"> Product Name</th>
     
      <th width="408" align="left" valign="middle">Short Description</th>
      <th width=" " align="left" valign="middle">Full Description</th>
      <th width="49" align="left" valign="middle">Status</th>
      
      <th width="49" align="left" valign="middle">Edit</th>
      <th width="61" align="left" valign="middle">Remove</th>
    </tr>
<?php
if($getProduct>0){
	$sn= 1;
	foreach($getProduct as $showProduct){
		$productId = $showProduct['id'];
		$category_id = $showProduct['category_id'];
		$subcategory_id = $showProduct['sub_category_id'];
		
		$getCategoryName = $commonFunObj->getList("category",array("id"=>$category_id));
		$getsubCategoryName = $commonFunObj->getList("product_cat_subcat",array("product_id"=>$productId),array("category_id"=>$category_id));
		if($showProduct['display_status']==1){
				$status = "Active";
		}else if($showProduct['display_status']==0){
				$status = "Deactive";
		}
		?>
		 <tr>
		      <td align="left" valign="top"><?=$sn?></td>
		      <td align="left" valign="top"><?=$getCategoryName[0]['category_name']?></td>
		      <td align="left" valign="top">
		      	<?php if(sizeof($getsubCategoryName>0)){
		      	foreach($getsubCategoryName as $showSubCatData){
		      			$subcategoryId = $showSubCatData['sub_category_id'];
		      			$getSubData = $commonFunObj->getList("subcategory",array('id'=>$subcategoryId));
		      			echo $getSubData['0']['sub_category']."&nbsp;&nbsp;";
		      		}
		      	} ?>
		      </td>
		      <td align="left" valign="top"><?=$showProduct['product_name']?></td>
		      <td align="left" valign="top"><?=$showProduct['sort_description']?></td>
		      <td align="left" valign="top"><?=$showProduct['content']?></td>
		      
		      <td align="left" valign="top" onclick="statusChange(<?=$showProduct[id]?>)"><strong><?=$status?></strong></td>
		      <td align="left" valign="top"><a href="edit_Product.php?pid=<?=$showProduct[id]?>">Edit</a></td>
		      <td align="center" valign="top" onclick="deleteCategory(<?=$showProduct[id]?>)"><a href="#"><img src="images/icon-bin.jpg" alt="" width="25" height="25" border="0" align="absmiddle" /></a></td>
	    </tr>
		<?php
		$sn++;
	}
}

?>
</table>