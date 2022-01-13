<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getSubCategory = $commonFunObj->getList("subcategory");
?>
<script>
	function statusChange(cid){
		var sub_category_id = cid;
		 parameters = "sub_category_id="+sub_category_id+"&action=subcategoryStatus";
		$.ajax({  
	          type: "POST",  
	          url: "ajax_status.php", 
	          data: parameters,
	          success: function(response){
	          	//alert(response);
	            if(response == "succ"){
	              showDataC();
	              $('#category').val("");
	              document.getElementById("msg").innerHTML="Update subcategory successfull..."; 
	            }
	           
	          }
        });
	}
	function deleteCategory(cid){
		alert("Are you sure to delete category.");
		var category_id = cid;
		 var parameters = "";
	        parameters = "subcategory_id="+category_id+"&action=subcategoryDel";
	        //alert(parameters);
	        $.ajax({  
	          type: "POST",  
	          url: "ajax_delete.php", 
	          data: parameters,
	          success: function(response){
	            if(response == "succ"){
	              showDataC();
	              $('#category').val("");
	              document.getElementById("msg").innerHTML="Added category successfull..."; 
	            }
	           
	          }
        });
	}
</script>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="59" align="left" valign="middle">Sr.No.</th>
      <th width="752" align="left" valign="middle">Category Name</th>
       <th width="752" align="left" valign="middle">Sub Category Name</th>
      <th width="77" align="left" valign="middle">Status</th>
      <th width="54" align="left" valign="middle">Edit</th>
      <th width="71" align="left" valign="middle">Remove</th>
    </tr>
<?php
if($getSubCategory>1){
	$sn= 1;
	foreach($getSubCategory as $showCategory){
		$subcategoryId = $showCategory['category_id'];
		if($showCategory['display_status']==1){
				$status = "Active";
		}else if($showCategory['display_status']==0){
				$status = "Deactive";
		}
		$getCategoryName = $commonFunObj->getList("category",array("id"=>$subcategoryId));
		?>
		 <tr>
			<td align="left" valign="top"><?=$sn?></td>
			<td align="left" valign="top"><?=$getCategoryName[0]['category_name']?></td>
			<td align="left" valign="top"><?=$showCategory['sub_category']?></td>
			<td align="left" valign="top" onclick="statusChange(<?=$showCategory['id']?>)"><strong><?=$status?></strong></td>
			<td align="left" valign="top"><a href="edit_sub_category.php?scbc=<?=$showCategory['id']?>">Edit</a></td>
			<td align="center" valign="top" onclick="deleteCategory(<?=$showCategory[id]?>)"><a href="#"><img src="images/icon-bin.jpg" alt="" width="25" height="25" 
				border="0" align="absmiddle" /></a></td>
	    </tr>
		<?php
		$sn++;
	}
}

?>
</table>